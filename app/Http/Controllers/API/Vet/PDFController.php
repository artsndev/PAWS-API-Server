<?php

namespace App\Http\Controllers\API\Vet;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function download() {
        $pdf = Pdf::loadView('pdf.report', );
        return $pdf->download();
    }
}
