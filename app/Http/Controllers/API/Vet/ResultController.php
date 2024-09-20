<?php

namespace App\Http\Controllers\API\Vet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = Result::where('veterinarian_id', Auth::user()->id)->latest()->get();
            if(!$result) {
                $response = [
                    'success' => false,
                    'message' => 'Not Found',
                ];
                return response()->json($response, 403);
            }
            $response = [
                'success' => true,
                'data' => $result,
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
                'physical_exam' => 'required',
                'treatment_plan' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
                return response()->json($response, 200);
            }
            $result = Result::create([
                'veterinarian_id' => Auth::user()->id,
                'appointment_id' => $request->input('appointment_id'),
                'physical_exam' => $request->input('physical_exam'),
                'treatment_plan' => $request->input('treatment_plan'),
            ]);
            $response = [
                'success' => true,
                'data' => [
                    'result_info' => $result,
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
