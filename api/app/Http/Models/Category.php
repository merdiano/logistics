<?php

namespace Http\App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name_tm','name_ru','icon'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getTree()
    {
        $category = self::orderBy('lft')->get();
        if ($category->count()) {
            foreach ($category as $k => $category_item) {
                $category_item->children = collect([]);
                foreach ($category as $i => $category_subitem) {
                    if ($category_subitem->parent_id == $category_item->id) {
                        $category_item->children->push($category_subitem);
                        // remove the subitem for the first level
                        $category = $category->reject(function ($item) use ($category_subitem) {
                            return $item->id == $category_subitem->id;
                        });
                    }
                }
            }
        }
        return $category;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function announcements(){
        return $this->hasMany(Application::class);
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id');
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
