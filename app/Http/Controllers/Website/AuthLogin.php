<?php

namespace App\Http\Controllers\Website;

use App\Http\Models\users;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthLogin extends BaseController
{


    public function viewLogin(){
        return view('Website.login');
    }
    public function afterlogin(){
        return "you are login";
    }
    public function validlogin(Request $request){
        $rules=[
            'email'=>'required',
            'password'=> 'required'
        ];
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails()){
            return "error";
        }
        if(auth()->guard('user')->attempt($request->except('_token'))){
            return redirect()->intended('/user');
        }else{
            return  back()->withInput($request->only('email'));
        }
    }

    public function logout(Request $request) {
        auth()->guard('user')->logout();
        return redirect()->intended('/userLogin');
    }
}
