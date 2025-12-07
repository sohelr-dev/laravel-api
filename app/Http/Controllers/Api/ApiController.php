<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ApiController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);
        $user = User::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $user
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('api')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'data' => $user,
                    'token' => $token
                ]);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Password does not match'
                ], 401);
            }
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Email does not exist'
            ], 401);
        }
    }

    public function logout(){                
        // auth()->user()->currentAccessToken()->delete();
        auth()->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully'
        ]);
    }
}
