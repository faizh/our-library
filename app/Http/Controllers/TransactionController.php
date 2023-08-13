<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('CreatedBy', Auth::id())->get();

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
                'Qty'           => $cart->qty,
                'ReturnDate'    => date('Y-m-d', strtotime(date('Y-m-d') . "+1 days"))
            ]);
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
}
