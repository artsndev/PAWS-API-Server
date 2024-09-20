<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function credits()
    {
        $data = [
            'title' => 'Pet Veterinarian Appointment System',
            'client' => 'PAWSSIBLE Solutions',
            'message' => 'API Server is live!'
        ];
        return response()->json($data,200);
    }
}
