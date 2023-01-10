<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);

        if($validator->fails()){
           return response()->json([
               'status' => false,
               'message' => 'validation error',
               'errors' =>  $validator->errors()
           ], 401);  

        }
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;

        $success['name'] =  $user->name;

        return response()->json([
           'success' => 'true',
           'message' => 'data save sucessfylly',
           'data' => $success
        ]);

    }

    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;


            return response()->json([
                'success' => 'true',
                'message' => 'User Login sucessfylly',
                'data' => $success
            ]);

        } 

        else{ 

            return response()->json([
                'status' => 'false',
                'errors' =>  'Unauthorised'
            ]);  

        } 

    }
}
