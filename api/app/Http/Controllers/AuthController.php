<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/27/2019
 * Time: 0:04
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Logistics\Common\Models\BaseAccount;

class AuthController extends Controller
{

    public function register(Request $request){
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();
            $account = new BaseAccount();
            $account->name = $user->name;
            $account->user_id = $user->id;

            DB::commit();
            //return successful response
            return response()->json(['user' => $user, 'message' => 'REGISTERED'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'phone' => 'required|numeric',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['phone', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}