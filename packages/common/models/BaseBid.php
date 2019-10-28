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
    protected $guarded = ['id'];
    protected $fillable = ['owner_id','account_id','winner','proposed_cost','estimated_time','estimated_time_unit','comment','application_id'];

    public function application(){
        return $this->belongsTo(BaseApplication::class,'application_id');
    }

    public function account(){
        return $this->belongsTo(BaseAccount::class,'account_id');
    }

    public function user(){
        return $this->belongsTo(BaseUser::class,'owner_id');
    }
}