<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;
use App\Role;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api')->only(['user', 'logout']);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all(); 
        $data['password'] = bcrypt($data['password']); 
        $user = User::create($data);

        $user->roles()->attach(Role::client());

        event(new UserRegistered($user));
        
        $token = $user->createToken($data['email'])->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {


        $credentials = [
            'email' => $request->json('email'),
            'password' =>$request->json('password')
        ];

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken($request->email)->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
 

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
