<?php namespace Maxic\DleAuth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class Authenticate {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::getDefaultDriver() == 'dleauth') {
            if (!$this->auth->check()) {

                if (isset($_SESSION) && isset($_SESSION['dle_user_id']) && isset($_SESSION['dle_password']) &&
                    $_SESSION['dle_user_id'] > 0 && !empty($_SESSION['dle_password'])) {
                    // Manual authenticate
                    \Session::flash('dle_session_auth', true);
                    Auth::attempt(['user_id' => $_SESSION['dle_user_id'], 'password' => $_SESSION['dle_password']]);
                }
            } else {
                // Check, if user in DLE cms logged out
                if (isset($_SESSION) && isset($_SESSION['dle_user_id']) && isset($_SESSION['dle_password']) &&
                    $_SESSION['dle_user_id'] != $this->auth->user()->getAuthIdentifier() && empty($_SESSION['dle_password'])) {
                    Auth::logout();
                }
            }
        }


        return $next($request);
    }

}
