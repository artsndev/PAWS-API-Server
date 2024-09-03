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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
