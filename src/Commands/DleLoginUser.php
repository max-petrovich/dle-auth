<?php namespace Maxic\DleAuth\Commands;

use Illuminate\Contracts\Bus\SelfHandling;

class DleLoginUser implements SelfHandling {


    protected $credentials;

    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    public function handle()
    {
        $_SESSION['dle_user_id'] = $this->credentials->getAuthIdentifier();
        $_SESSION['dle_password'] = $this->credentials->getAuthPassword();
    }
}