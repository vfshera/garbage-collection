<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generatePdf(){
        $reportType = "Pdf";
        $orders = Order::all();

        $pdf = PDF::loadView('pdf.order-report' , compact('reportType','orders'));

        return $pdf->download(date('d-m-Y-H-i-s', strtotime(now())) . ".pdf");

        

        // return view('pdf.order-report' , compact('reportType','orders'));
    }
}