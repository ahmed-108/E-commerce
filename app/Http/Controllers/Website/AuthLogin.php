<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\Comments;
use App\Http\Models\user_login;
use App\Traits\General_Traits;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthLogin extends BaseController
{
use General_Traits;

    public function Login(Request $request){
        ## validation ##
        try {

            $rules=[
                'email'=>   "required| exists:user_login,email",
                'password'=>    "required"
            ];
            $validator = Validator::make($request->all(),$rules);
            if ($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            /// login
            $credentials=$request->only(['email','password']);
            $token = auth('user_api')->attempt($credentials);
            if(!$token){
                return $this->returnError('E1001','error in the password');
            }else{
                //return
                $admin= Auth::guard('user_api')->user();
                $admin->Token=$token;
                return $this->returnData( 'User',$admin,'login success');
            }
        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function logout(Request $request){

        try {
            $token=$request->header('auth-token');
            if($token){
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('Logout successfully');
            }else{
                return $this->returnError('E500', 'Token invalid');
            }
        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'username'=>"required",
            'email'=>   "required| unique:user_login,email",
            'password'=>    "required"
        ]);

        if ($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = user_login::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return $this->returnData('User',$user,'Register done');
    }
    public function postcomments(Request $request){
        try {
            $token=$request->header('auth-token');
            if($token){
                $rules=[
                    'comment'=> 'required',
                    "user_id"=>"required",
                    "product_id"=>"required"
                ];
                $validator= Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return $this->returnError("4003", "Please ensure enter the data");
                }
                Comments::create([
                    'comment'=>$request-> comment,
                    'rating'=>$request->rating,
                    'user_id'=>$request-> user_id,
                    'product_id'=>$request->product_id
                ]);
                return $this->returnSuccessMessage("The comment has been added");

            }else{
                return $this->returnError('E500', 'Please Enter Token');
            }
        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


}
