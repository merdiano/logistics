<?php

namespace App;

use Logistics\Common\Models\BaseUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends BaseUser implements AuthorizableContract, JWTSubject
{
    use  Authorizable;
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
