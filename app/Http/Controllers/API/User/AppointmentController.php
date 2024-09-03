<?php

namespace App\Http\Controllers\API\User;

use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'purpose_of_appointment' => 'required',
                'session_of_appointment' => 'required',
                'appointment_time' => 'required|date_format:Y-m-d H:i|unique:appointments,appointment_time',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'errors' => $validator->errors(),
                ];
                return response()->json($response, 200);
            }

            $appointment = Appointment::create([
                'user_id' => Auth::user()->id,
                'veterinarian_id' => $request->input('veterinarian_id'),
                'pet_id' => $request->input('pet_id'),
                'schedule_id' => $request->input('schedule_id'),
                'purpose_of_appointment' => $request->input('purpose_of_appointment'),
                'session_of_appointment' => $request->input('session_of_appointment'),
                'status' => $request->input('status'),
                'appointment_time' => $request->input('appointment_time')
            ]);
            $schedule = Schedule::findOrFail($request->input('schedule_id'));
            if (!$schedule) {
                $response = [
                    'success' => false,
                    'message' => 'Schedule not found.',
                ];
                return response()->json($response, 404);
            }
            $schedule->delete();
            $response = [
                'success' => true,
                'data' => [
                    'appointment' => $appointment,
                ],
                'message' => "User Appointment successfully",
            ];
            // Send an Email to Doctor when appointment is created
            // $mail = Mail::to($appointment->doctor->email)->send(new AppointmentMail($appointment));
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
            $appointment = Appointment::with([
                'veterinarian',
                'queue' => function ($query) {
                    $query->withTrashed();
                }
            ])->withTrashed()->latest()->find($id);
            if (!$appointment) {
                $response = [
                    'success' => false,
                    'message' => 'Appointment Not Found'
                ];
                return response()->json($response, 403);
            }
            $response = [
                'success' => true,
                'message' => 'Appointments Found',
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
