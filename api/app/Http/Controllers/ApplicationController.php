<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/3/2019
 * Time: 19:37
 */

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Logistics\Common\Models\BaseApplication;

class ApplicationController extends Controller
{

    public function getAvailableApplications(){
        return BaseApplication::biddable()->paginate(20);
    }

    public function getMyApplications(){
        return BaseApplication::mine()->paginate(20);
    }

    public function get($application_id){
        return BaseApplication::find($application_id);
    }

    public function store(Request $request){
        try{
            BaseApplication::create([

            ]);
        }catch (Exception $exception){
            Log::error($exception);
        }
    }

    public function remove(){

    }

}