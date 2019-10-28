<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 21:01
 */
namespace Logistics\Common\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseApplication extends \Illuminate\Database\Eloquent\Model
{
//    use SoftDeletes;
    protected $table = 'applications';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $hidden = [];
    protected $dates = ['bidding_ends_at'];
    protected $guarded = ['id'];
    protected $fillable = ['owner_id','account_id','description','approved','winning_bid_id',
        'bidding_ends_at','estimated_cost','estimated_time','estimated_time_unit','image',
        'pickup_location_id','pickup_address','destination_address','destination_location_id',];

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
        return $this->belongsTo(BaseLocation::class,'pickup_location_id')
            ->select('id','title_tk','title_ru');
    }

    public function destination_location(){
        return $this->belongsTo(BaseLocation::class,'destination_location_id')
            ->select('id','title_tk','title_ru');
    }

    public function scopeBiddable($query){
        return $query->where('approved',1)
            ->with('pickup_location')
            ->with('destination_location')
            ->whereDate('bidding_ends_at','>=',Carbon::today());
    }

    public function scopeMine($query, $app_id = false){
        $query->where('owner_id',auth()->id());
        if($app_id)
            $query->where('id',$app_id);
    }
}