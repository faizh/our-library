<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function list_report() {
        $txds = TransactionDetail::getListBooksLoan();

        return view('reports.list', compact('txds'));
    }

    function chart_report() {
        $tx_pie = Transaction::getDataForPieChart();
        $tx_bar = Transaction::getDataForBarChart();

        $labels = array();
        $values = array();
        foreach ($tx_bar as $tx) {
            $labels[] = $tx->BookName;
            $values[] = $tx->loan;
        }

        return view('reports.chart', compact('tx_pie', 'tx_bar', 'labels', 'values'));
    }
}
