<?php

namespace Http\App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'applications';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
        'abonent_id',
        'images',
        'price',
        'locationP',//'locationC',
        'phone',
        'email',
        'show_phone',
        'show_mail',
        'categoryP',
        'categoryC',
        'approved'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function client(){
        return $this->belongsTo(Abonent::class,'abonent_id');
    }

    public function location(){
        return $this->belongsTo(Location::class,'locationP');
    }

//    public function location_child(){
//        return $this->belongsTo(Location::class,'locationC');
//    }

    public function category(){
        return $this->belongsTo(Category::class,'categoryP');
    }

    public function subCategory(){
        return $this->belongsTo(Category::class,'categoryC');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
