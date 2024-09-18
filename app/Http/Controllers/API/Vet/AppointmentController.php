<?php

namespace App\Http\Controllers\API\Vet;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $appointment = Appointment::with([
                'schedule' => function ($query) {
                    $query->withTrashed();
                },
                'user',
                'pet',
                'result'
            ])->withTrashed()->where('veterinarian_id', Auth::user()->id)->latest()->get();
            if(!$appointment) {
                $response = [
                    'success' => false,
                    'message' => 'Not Found',
                ];
                return response()->json($response, 403);
            }
            $response = [
                'success' => true,
                'data' => $appointment,
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
