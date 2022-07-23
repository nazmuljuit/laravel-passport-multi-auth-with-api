<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Hash;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function userDashboard()
    {
        $users = User::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function adminDashboard()
    {
        //dd('dddd');
        $users = Admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function userLogin(Request $request)
    {
    	//dd('sdjfksjlkj');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);
            
            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
    #admin login
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);
            
            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp',['admin'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function adminLogout(Request $request)
    {
        $accessToken = auth()->user('admin-api')->token();
        $token= $request->user('admin-api')->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);

    }

    public function userLogout(Request $request)
    {
        $accessToken = auth()->user('user-api')->token();
        $token= $request->user('user-api')->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);

    }
}