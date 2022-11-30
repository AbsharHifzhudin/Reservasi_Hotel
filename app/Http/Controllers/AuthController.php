<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
     {
        $validator = validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'birthdate' => 'required',
            'gender' => 'required|string'
            
        ]);

        if ($validator->fails()){
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message'=> $validator->errors()
            ],402);
        }

        $validated = $validator->getData();

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Data Created Successfully',
            'data' => $user 
        ]);

     }

    public function login(Request $request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData(); 

        $user = User::where('email', $validated['email'])->get()->first();

        if (!$user) {
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'User not found'
            ], 401);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'Password not match'
            ], 401);
        }

        $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Login success',
            'data' => [
                'token' => $token
            ]
        ], 200);
    }
    

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Logout success'
        ], 200);
    }
}
