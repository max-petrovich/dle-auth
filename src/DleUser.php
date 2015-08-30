<?php namespace Maxic\DleAuth;

use Illuminate\Auth\GenericUser;

class DleUser extends GenericUser {
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->attributes['user_id'];
    }

    public function getRememberToken()
    {
        return false;
    }

    public function setRememberToken($value)
    {
        return false;
    }

    public function getRememberTokenName()
    {
        return false;
    }

    public function hasRole($role) {
        return $this->user_group === (int)$role;
    }
}