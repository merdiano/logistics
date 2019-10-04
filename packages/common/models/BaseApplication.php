<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 21:01
 */
namespace Logistics\Common\Models;

class BaseApplication extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'applications';

    public function bids(){
        return $this->hasMany(BaseBid::class);
    }

    public function owner(){
        return $this->belongsTo(BaseUser::class,'owner_id');
    }

    public function account(){
        return $this->belongsTo(BaseAccount::class);
    }

    public function winner(){
        return $this->hasOneThrough(BaseAccount::class,BaseBid::class,'winning_bid_id');
    }

    public function pickup_location(){
        return $this->belongsTo(BaseLocation::class,'pickup_location_id');
    }

    public function destination_location(){
        return $this->belongsTo(BaseLocation::class,'destination_location_id');
    }
}