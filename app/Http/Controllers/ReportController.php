<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function list_report() {
        return view('reports.list');
    }

    function chart_report() {
        $tx = Transaction::getDataForChart();

        return view('reports.chart', compact('tx'));
    }
}
