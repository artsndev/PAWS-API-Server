<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnauthenticatedController extends Controller
{
    /**
     * Sends Unauthorized Message for Unauthenticated Users
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function unauth(Request $request)
    {
        if (! $request->user()) {
            $data = [
                'success' => false,
                'server-status' => '401',
                'message' => 'You\'re Unauthenticated. 😜',
                'error' => 'Invalid token. Please provide a proper token.'
            ];
            return response()->json($data, 200);
        }
    }
}
