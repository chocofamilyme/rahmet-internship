<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;

use App\UserVerification;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;



class VerificationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api')->only(['resend', 'show']);
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? response()->json(['message' => 'Email Verified'])
                        : response()->json(['message' => 'Email Not Verified']);
    }
    
    public function verify(Request $request)
    {
        $user_verification = UserVerification::where('hash_code', $request['hash'])->first();
        
        if ($user_verification) {

            $user = User::find($user_verification->user_id);
            
            // $user->update(['email_verified_at' => Carbon::now()]);

            $user->email_verified_at = Carbon::now();    

            $user->save();

            $user->userVerification()->delete();

            return response()->json(['message' => 'Email verified']);

        }else{

            return response()->json([
                'message' => 'Woops, try to resend verification email',
                "resend_url" => 'localhost:8000/api/email/resend'
                ]);

        }

    }


    public function resend(Request $request)
    {

        $user = Auth::user();


        if ($user->hasVerifiedEmail()) {

            return response()->json(['message' =>'User Already Have Verified Email!'], 422);

        }

        $user_verification = UserVerification::where('user_id', $user->id);
        $user_verification->delete();

        event(new UserRegistered($request->user()));

        
        return response()->json(['message' =>'The Notification Has Been Resubmitted']);
    }
}
