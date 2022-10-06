<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class SessionsController extends Controller
{
    //login view
    public function create()
    {
        //echo Auth::token_name();
        echo csrf_token();   
        return view('sessions.login');
    }


    //authorize user from the database
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials)) {
            // if ($user->email_verified_at == null) {

            //     Mail::send('auth.verification', ['user' => $user], function ($mail) use ($user) {
            //         $mail->to($user->email);
            //         $mail->subject('Account Verification');
            //     });
            //     $message = "Your Email is not verified! Check your inbox";
            //     $response = [
            //         'error' => $message,
            //     ];
            //     return response() -> json($response, 401);
            //} else {
                $message = 'Great! You have Successfully LoggedIn';
                $response = [
                    'message' => $message,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ];
                return response()->json([
                    $response
                ], 200);
            //}
        }
        $error = "Invalid Credentials";
        $response = [
            'error' => $error
        ];
        return  response()->json($response,401);
    }

    //logout user

    public function destroy()
    {
        $message = "Logout";
        $response = [
            'message' => $message
        ];
        return  response()->json($response);
    }
    }

