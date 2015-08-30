<?php namespace Maxic\DleAuth\Handlers\Events;

use Bus;

class UserAuth {

    public function onUserLogout() {
        Bus::dispatch(
            new \Maxic\DleAuth\Commands\DleLogoutUser()
        );
    }

    /*public function onUserLogin($credentials) {
        Bus::dispatch(
            new \Maxic\DleAuth\Commands\DleLoginUser($credentials)
        );
    }*/

    public function subscribe($events)
    {
        //$events->listen('auth.attempt', 'Maxic\DleAuth\Handlers\Events\UserAuth@onUserLogin');
        $events->listen('auth.logout', 'Maxic\DleAuth\Handlers\Events\UserAuth@onUserLogout');
    }
}
