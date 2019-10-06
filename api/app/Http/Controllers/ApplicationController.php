<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/3/2019
 * Time: 19:37
 */

namespace App\Http\Controllers;


use Carbon\Carbon;
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
        $app = BaseApplication::with('bids')
            ->with('pickup_location')
            ->with('destination_location')
            ->with('account')
            ->with('winner')
            ->find($application_id);
        if($app)
            return response()->json(['application' => $app]);
        else
            return rescue()->json(['message'=>'not found'],404);
    }

    public function store(Request $request){
        //todo validation
        try{

            if($request->get('id')){
                $application = BaseApplication::mine($request->get('id'))->firstOrFail();
            }
            else
            {
                $application = new BaseApplication();
                $application->owner_id = auth()->id();
                $application->account_id = auth()->account->id;
            }

            $application->bidding_ends_at = Carbon::parse($request->get('bidding_ends_at'));
            $application->title = $request->get('title');
            $application->description = $request->get('description');
            $application->estimated_cost = $request->get('estimated_cost');
            $application->pickup_location_id = $request->get('pickup_location_id');
            $application->pickup_address = $request->get('pickup_address');
            $application->destination_address = $request->get('destination_address');
            $application->destination_location_id = $request->get('destination_location_id');
            $application->save();
            return response()->json(['application_id' => $application->id, 'message' => 'stored'], 201);
        }catch (Exception $exception){
            Log::error($exception);
            return response()->json(['message' => 'Application store Failed!'], 409);
        }
    }

    public function remove($app_id){
        $app = BaseApplication::mine($app_id)->firstOrFail();
        if($app->delete()){
            return response()->json(['message' => 'deleted'],202);
        }
        return response()->json(['message'=>'unsuccesful'],404);

    }

}