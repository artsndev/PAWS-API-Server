<?php

namespace App\Http\Controllers\API\Vet;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function download(string $id) {
        $appointment = Appointment::with([
            'schedule' => function ($query) {
                $query->withTrashed();
            },
            'user',
            'pet',
            'result'
        ])->withTrashed()->where('id', $id)->latest()->get();
        $pdf = Pdf::loadView('pdf.report', [
            'appointment' => $appointment
        ]);
        return $pdf->download('Reports PDF.pdf');
    }
}
