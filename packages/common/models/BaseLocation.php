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
}