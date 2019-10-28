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

            $has_time = $application->bidding_ends_at->gte(Carbon::now());

            if($application->approved && $has_time){
                if($request->has('bid_id')){
                    $bid = BaseBid::findOrFail($request->get('bid_id'));
                }
                else {
                    $bid = new BaseBid();
                    $bid->owner_id = auth()->id();
                    $bid->account_id = auth()->user()->account_id;
                    $bid->application_id = $app_id;
                }

                $bid->proposed_cost = $request->get('proposed_cost');
                $bid->estimated_time = $request->get('estimated_time');
                $bid->estimated_time_unit = $request->get('estimated_time_unit');
                $bid->comment = $request->get('comment');
                $bid->save();

                return response()->json([
                    'message' => 'stored'], 201);
            }

        }
        catch (\Exception $e){
            Log::error($e);

        }
        return response()->json(['error' => 'Bid store Failed!'], 409);
    }

}