<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Client;
use Hash;
use Auth;

class RegisterController extends Controller
{
    public function userRegister(Request $request)
    {
        $register = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if ($register->fails()) {
            $responseArr['error'] = true;
            $responseArr['message'] = $register->errors();
            return $responseArr;
        }
        if($request->password == $request->confirm_password){
            try {
                $register = User::insert([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'phone' => $request['phone'],
                    'email' =>  $request['email']
                ]);

                $responseArr['error'] = false;
                $responseArr['message'] = 'User Resistered Successfully.';
                return response()->json($responseArr);
    
            } catch (Exception $e) {
                $responseArr['error'] = true;
                $responseArr['message'] = 'Something went wrong. Please try again';
                $responseArr['data'] = $e->getMessage();
                return response()->json($responseArr);
            }
        }else{
            $responseArr['error'] = true;
            $responseArr['message'] = "Confirm Password Doesn't Matched";
            return response()->json($responseArr);
        }
        

        
    }
    public function clientRegister(Request $request)
    {
        $register = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:clients',
        ]);

        if ($register->fails()) {
            $responseArr['error'] = true;
            $responseArr['message'] = $register->errors();
            return $responseArr;
        }
        if($request->password == $request->confirm_password){
            try {
                $register = Client::insert([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'phone' => $request['phone'],
                    'email' =>  $request['email']
                ]);

                $responseArr['error'] = false;
                $responseArr['message'] = 'Admin Resistered Successfully.';
                return response()->json($responseArr);
    
            } catch (Exception $e) {
                $responseArr['error'] = true;
                $responseArr['message'] = 'Something went wrong. Please try again';
                $responseArr['data'] = $e->getMessage();
                return response()->json($responseArr);
            }
        }else{
            $responseArr['error'] = true;
            $responseArr['message'] = "Confirm Password Doesn't Matched";
            return response()->json($responseArr);
        }
        

        
    }
}
