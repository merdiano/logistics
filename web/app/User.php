<?php

namespace App;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Logistics\Common\Models\BaseUser;
use Illuminate\Foundation\Auth\Access\Authorizable;
class User extends BaseUser implements AuthorizableContract
{
    use  CanResetPassword, Notifiable, Authorizable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
