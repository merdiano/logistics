<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/2/2019
 * Time: 20:58
 */
namespace Logistics\Common\Models;
class BaseLocation extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable =['lft','rgt','depth','parent_id','title_ru','title_tk'];
    protected $table = 'locations';
    protected $guarded = ['id'];

    public function parent(){
        return $this->belongsTo(BaseLocation::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(BaseLocation::class,'parent_id');
    }

    public function destination_apps(){
        return $this->hasMany(BaseApplication::class,'destination_location_id');
    }

    public function pickup_apps(){
        return $this->hasMany(BaseApplication::class,'pickup_location_id');
    }
}