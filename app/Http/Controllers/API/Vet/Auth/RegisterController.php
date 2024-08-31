<?php

namespace App\Http\Controllers\API\Vet\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Veterinarian;
use Illuminate\Support\Facades\Auth;
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
                'email' => 'required|unique:veterinarians|email',
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
                return response()->json($response, 200);
            }
            $vet = Veterinarian::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            $vetToken = JWTAuth::fromUser($vet);
            // $mail = Mail::to($vet['email'])->send(new WelcomeMail($vet));
            $response = [
                'success' => true,
                'data' => [
                    'vetToken' => $vetToken,
                    'vet_info' => $vet,
                ],
                'message' => "vet registered successfully",
                'mail_message' => 'Mail sent successfully',
            ];
            Auth::login($vet);
            return response()->json($response, 201)->header('Authorization', 'Bearer ' . $vetToken);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
}
