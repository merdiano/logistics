<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/28/2019
 * Time: 0:11
 */

namespace App\Http\Controllers;


use Logistics\Common\Models\BaseLocation;

class LocationController extends Controller
{
    public function index(){
        return BaseLocation::where('depth',1)->with('children')->get();
    }
}