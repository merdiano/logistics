<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/3/2019
 * Time: 19:38
 */

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Logistics\Common\Models\BaseApplication;
use Logistics\Common\Models\BaseBid;

class BidController extends Controller
{
    public function get_bids($app_id){

        return BaseBid::where('application_id',$app_id)->paginate(10);
    }

    public function make_bid(Request $request){
        $this->validate($request,[
            'application_id' => 'required|numeric',
            'proposed_cost' =>'required|numeric',
            'estimated_time'=>'required|numeric',
            'estimated_time_unit'=>'required',
            'comment'=>'max:255'
        ]);

        try{
            $app_id = $request->get('application_id');
            $application = BaseApplication::findOrFail($app_id);

            $has_time = $application->biding_ends_at->lte(Carbon::now());

            if($application->approved && $has_time){
                if($request->has('bid_id')){
                    $bid = BaseBid::findOrFail($request->get('bid_id'));
                }
            }

        }
        catch (\Exception $e){
            Log::error($e);
        }
    }

}