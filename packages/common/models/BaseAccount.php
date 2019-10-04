<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 21:01
 */
namespace Logistics\Common\Models;
class BaseAccount extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'accounts';

    public function applications(){
        return $this->hasMany(BaseApplication::class);
    }

    public function bidded_applications(){
        $this->hasManyThrough(BaseApplication::class, BaseBid::class);
    }
}