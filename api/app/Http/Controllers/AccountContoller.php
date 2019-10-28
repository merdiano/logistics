<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 10/6/2019
 * Time: 23:36
 */

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Logistics\Common\Models\BaseAccount;

class AccountContoller extends Controller
{
    public function get(){
        return BaseAccount::findOrFail(auth()->user()->account_id);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>'max:255',
            'about'=>'max:255'
        ]);
        try{
            $account = BaseAccount::where('user_id',Auth::id())->first();
            $account->name = $request->get('name');
            $account->about = $request->get('about');
            $account->locations = $request->get('locations');
            $account->save();
            return $request->json(['message'=>'updated'],201);
        }
        catch (\Exception $ex){
            Log::error($ex);
            return $request->json(['error'=>'Account update failed'],409);
        }
            //t+s-p=130
    }
}