<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class passportAuthController extends Controller
{
    /**
     * @param Request $request
     * handle user registration request
     */
    public function registerUserExample(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ]);
        $user= User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $access_token_example = $user->createToken('PassportExample')->access_token;
        //return the access token we generated in the above step
        return response()->json(['token'=>$access_token_example],200);
    }

    /**
     * @param Request $request
     * login user to our application
     */
    public function loginUserExample(Request $request){
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            //generate the token for the user
            $user_login_token= auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }

    /**
     * this method returns authenticated user details
     */
    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}
