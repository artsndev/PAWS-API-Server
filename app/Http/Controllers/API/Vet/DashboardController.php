<?php

namespace App\Http\Controllers\API\Vet;

use App\Models\Queue;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Authorizes the users account in api.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function auth(Request $request)
    {
        return $request->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::get()->count();
            $available_schedule = Schedule::where('veterinarian_id', Auth::user()->id)->get()->count();
            $taken_schedule = Schedule::onlyTrashed()->where('veterinarian_id', Auth::user()->id)->get()->count();
            $appointment = Appointment::where('veterinarian_id', Auth::user()->id)->get()->count();
            $queue = Queue::get()->count();
            $queued = Queue::onlyTrashed()->get()->count();
            $response = [
                'data' => [
                    'user_count' => $user,
                    'available_schedule_count' => $available_schedule,
                    'taken_schedule_count' => $taken_schedule,
                    'appointment_count' => $appointment,
                    'queue_count' => $queue,
                    'queued_count' => $queued,
                ]
            ];
            return response()->json($response,200);
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
