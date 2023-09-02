<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use App\Models\User;
use App\Models\Mentor;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use FFI\Exception;
use InvalidArgumentException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userLogin(Request $request, $user_type)
    {
        $model = $this->resolve_user_type($user_type);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()],301);
        }


        try {
            $user = $model::whereEmail($request->email)->first();

            if(!isset($user->id) || !Hash::check($request->password, $user->password)){
                $data = 'Invalid Login Credentials';
                $code = 401;

            }else{

        
                $token = $user->createToken('authToken', [$user_type])->accessToken;
                $code = 200;
                $data = [
                    'token' => $token,
                ];
                
            }
        } catch (Exception $e) {
            $data = ['error' => $e->getMessage()];
        }
        return response()->json($data, $code);

    }


    public function userLogout(Request $request,$user_type)
    {
        
        $user = Auth::guard($user_type)->user()->token();
        $user->revoke();
        return Response(['status'=>200,'message'=>$user_type.' logout successful!'],200);

    }

    function resolve_user_type(string $user_type) 
    {
        return match ($user_type) {
            'student'=> User::class,
            'mentor'=> Mentor::class,
            'marketer'=> Marketer::class,
            default => throw new InvalidArgumentException()
        };
    }




}
