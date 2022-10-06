<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;






class RegistrationController extends Controller
{


    // return registration view
    public function registration()
    {

        return view('auth.registration');
    }


    // post user to the database
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:10',
        ]);

        $data = $request->all();


        $user = $this->create($data);
        $token = Str::random(64);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        Mail::send('auth.verification', ['token' => $token], function ($mail) use ($user) {
            $mail->to($user->email);
            $mail->subject('Account Verification');
        });
        $message = "Registration Successfull. Check your inbox for email verification";
        $response = [
            'message' => $message,
        ];
        return response()->json(
            $response,
            200

        );
    }


    public function verification($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';
        // $user = Auth::user();
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->save();
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }




        return redirect('http://localhost:5173/login')->with('message', $message);
    }

    //create user
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
