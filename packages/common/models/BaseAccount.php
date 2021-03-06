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
    protected $guarded = ['id'];
    protected $fillable = ['name','avatar','about','user_id','locations'];
    protected $casts = ['locations' => 'array'];
    public function applications(){
        return $this->hasMany(BaseApplication::class,'application_id');
    }

    public function bidded_applications(){
        return $this->hasManyThrough(BaseApplication::class, BaseBid::class);
    }

    public function user(){
        return $this->belongsTo(BaseUser::class,'user_id');
    }
}