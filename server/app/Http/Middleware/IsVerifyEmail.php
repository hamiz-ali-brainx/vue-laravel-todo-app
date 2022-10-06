<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\UserVerify;
use App\Models\User;




class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $message = "User Doesn't Exists";
            $response = [
                'error' => $message,
            ];
            return response()->json($response, 401);
        } else if (!($user->is_email_verified)) {

            $token = Str::random(64);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
            ]);
            Mail::send('auth.verification', ['token' => $token], function ($mail) use ($user) {
                $mail->to($user->email);
                $mail->subject('Account Verification');
            });

            $message = "Your Email is not verified! Check your inbox";
            $response = [
                'error' => $message,
            ];
            return response()->json($response, 401);
        }

        return $next($request);
    }
}
