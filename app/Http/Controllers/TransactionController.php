<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Roles;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public const FINE_MAX = 120000;
    public const FINE_PER_DAY = 10000;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == Roles::getRoleAdministrator()) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('CreatedBy', Auth::id())->get();
        }

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts = Cart::with('books')
                    ->where('CreatedBy', Auth::id())
                    ->get();
        
        return view('transactions.create', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carts = Cart::where('CreatedBy', Auth::id())
                    ->get();

        /** stock checking */
        foreach ($carts as $cart) {
            $cart       = Cart::find($cart->id);
            $book_stock = Book::find($cart->BookId)->Stock;

            if ( $book_stock <= $cart->qty ) {
                return redirect()->route('transactions.create');
            }
        }
        
        $transaction_id = Transaction::create([
            'TransDate' => date('Y-m-d'),
            'CreatedBy' => Auth::id()
        ])->id;

        foreach ($carts as $cart) {
            TransactionDetail::create([
                'TransId'       => $transaction_id,
                'BookId'        => $cart->BookId,
                'Qty'           => $cart->qty
            ]);

            $book = Book::find($cart->BookId);
            $book->Stock = $book->Stock - $cart->qty;
            $book->save();
        }

        /** emptying cart */
        Cart::where('CreatedBy', Auth::id())
            ->delete();

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('user')
                        ->where('id', $id)
                        ->first();

        $transaction_details = TransactionDetail::with('book')
                                ->where('TransId', $id)
                                ->get();
        
        return view('transactions.view', compact('transaction', 'transaction_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    function return(int $transaction_id) {
        $trx = Transaction::find($transaction_id);
        $trx_detail = TransactionDetail::with('book')
                        ->where('TransId', $transaction_id)
                        ->get();

        $loan_date      = new DateTime($trx->TransDate);
        $return_date    = new Datetime(date('Y-m-d'));

        $fine_days      = $return_date->diff($loan_date)->format("%a") - 1;
        $fine_days      = $fine_days < 0 ? 0 : $fine_days;
        $fine_total     = 0;
        foreach ($trx_detail as $t) {
            $fine = $fine_days * TransactionController::FINE_PER_DAY;

            if ($fine > TransactionController::FINE_MAX) {
                $fine = TransactionController::FINE_MAX;
            }

            $fine = $fine * $t->qty;

            $td = TransactionDetail::find($t->id);
            $td->ReturnDate = date('Y-m-d');
            $td->FineDays = $fine_days;
            $td->Fine = $fine;
            $td->save();

            $book = Book::find($t->BookId);
            $book->Stock = $book->Stock + $t->Qty;
            $book->save();

            $fine_total += $fine;
        }

        $trx->FineTotal = $fine_total;
        $trx->save();

        return redirect()->route('transactions.index');
    }
}
