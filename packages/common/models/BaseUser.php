<?php
namespace Logistics\Common\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 20:45
 */

class BaseUser extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'phone', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function applications(){
        return $this->hasMany(BaseApplication::class);
    }

    public function bidded_applications(){
        $this->hasManyThrough(BaseApplication::class, BaseBid::class);
    }
}