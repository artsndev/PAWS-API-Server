<?php

namespace App\Http\Controllers\API\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Register new User.
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
                return response()->json($response, 200);
            }
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            $userToken = JWTAuth::fromUser($user);
            // $mail = Mail::to($user['email'])->send(new WelcomeMail($user));
            $response = [
                'success' => true,
                'data' => [
                    'userToken' => $userToken,
                    'user_info' => $user,
                ],
                'message' => "User registered successfully",
                'mail_message' => 'Mail sent successfully',
            ];
            Auth::login($user);
            return response()->json($response, 201)->header('Authorization', 'Bearer ' . $userToken);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
}
