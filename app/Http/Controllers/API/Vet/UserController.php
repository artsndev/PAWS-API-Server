<?php

namespace App\Http\Controllers\API\Vet;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::latest()->get();
            $data = [
                'success' => true,
                'data' => $user,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $errors = [
                'message' => $e->getMessage(),
            ];
            return response()->json($errors, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            if(!$user) {
                $data = [
                    'message' => 'User not found',
                ];
                return response()->json($data, 404);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users|email',
            ]);
            if ($validator->fails()) {
                $data = [
                    'success' => false,
                    'error' => $validator->errors(),
                ];
                return response()->json($data, 400);
            }
            $user->update([
                'name'=> $request->input('name'),
                'email' => $request->input('email'),
            ]);
            $result = [
                'success' => true,
                'message' => 'Updated Successfully',
                'data' => $user,
            ];
            return response()->json($result, 200);
        } catch (\Exception $e) {
            $errors = [
                'message' => $e->getMessage(),
            ];
            return response()->json($errors, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                $data = [
                    'success' => true,
                    'message' => 'User was successfully destroyed.',
                    'deleted_user' => $user,
                ];
                return response()->json($data, 202);
            }
            $data = [
                'success' => false,
                'message' => 'Users doesn\'t  Exists',
            ];
            return response()->json($data, 404);
        } catch (\Exception $e) {
            $errors = [
                'message' => $e->getMessage(),
            ];
            return response()->json($errors, 500);
        }
    }
}
