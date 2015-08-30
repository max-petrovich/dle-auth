<?php namespace Maxic\DleAuth\Commands;

use Illuminate\Contracts\Bus\SelfHandling;

class DleLogoutUser implements SelfHandling {

    public function handle()
    {
        // Cookie
        setcookie('dle_user_id', null, -1, '/');
        setcookie('dle_password', null, -1, '/');
        setcookie('dle_name', null, -1, '/');
        setcookie('dle_skin', null, -1, '/');
        setcookie('dle_newpm', null, -1, '/');
        setcookie('dle_hash', null, -1, '/');
        setcookie(session_name(), null, -1, '/');
        // Session
        $_SESSION['dle_user_id'] = 0;
        $_SESSION['dle_password'] = '';
    }
}