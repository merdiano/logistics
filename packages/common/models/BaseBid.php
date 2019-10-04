<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 21:02
 */
namespace Logistics\Common\Models;
class BaseBid extends \Illuminate\Database\Eloquent\Model
{

    protected $table = "bids";

    public function application(){
        return $this->belongsTo(BaseApplication::class);
    }

    public function account(){
        return $this->belongsTo(BaseAccount::class);
    }

    public function user(){
        return $this->belongsTo(BaseUser::class);
    }
}