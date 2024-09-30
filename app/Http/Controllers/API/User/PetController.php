<?php

namespace App\Http\Controllers\API\User;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pet = Pet::where('user_id', Auth::user()->id)->latest()->get();
            $response = [
                'data' => $pet,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'breed' => 'required',
                'species' => 'required',
                'age' => 'required',
                'sex' => 'required',
                'color' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
                return response()->json($response, 200);
            }
            $pet = Pet::create([
                'user_id' => Auth::user()->id,
                'name' => $request->input('name'),
                'breed' => $request->input('breed'),
                'species' => $request->input('species'),
                'age' => $request->input('age'),
                'sex' => $request->input('sex'),
                'color' => $request->input('color'),
            ]);
            $response = [
                'success' => true,
                'data' => [
                    'pet_info' => $pet,
                ],
                'message' => "New Pet added successfully",
            ];
            return response()->json($response, 201);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pet = Pet::find($id);
            if (!$pet) {
                $response = [
                    'success' => false,
                    'message' => 'Pet Not Found'
                ];
                return response()->json($response, 403);
            }
            $response = [
                'success' => true,
                'message' => 'Pets Found',
                'data' => $pet,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $errors = [
                'message' => $e->getMessage(),
            ];
            return response()->json($errors, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pet = Pet::find($id);
            if(!$pet) {
                $data = [
                    'message' => 'pet not found',
                ];
                return response()->json($data, 404);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'breed' => 'required',
                'species' => 'required',
                'age' => 'required',
                'sex' => 'required',
                'color' => 'required',
            ]);
            if ($validator->fails()) {
                $data = [
                    'success' => false,
                    'error' => $validator->errors(),
                ];
                return response()->json($data, 200);
            }
            $pet->update([
                'user_id' => Auth::user()->id,
                'name' => $request->input('name'),
                'breed' => $request->input('breed'),
                'species' => $request->input('species'),
                'age' => $request->input('age'),
                'sex' => $request->input('sex'),
                'color' => $request->input('color'),
            ]);
            $result = [
                'success' => true,
                'message' => 'Updated Successfully',
                'data' => $pet,
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
            $pet = Pet::find($id);
            if ($pet) {
                $pet->delete();
                $data = [
                    'success' => true,
                    'message' => 'pet was successfully destroyed.',
                    'deleted_pet' => $pet,
                ];
                return response()->json($data, 202);
            }
            $data = [
                'success' => false,
                'message' => 'pets doesn\'t  Exists',
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
