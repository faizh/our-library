<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('book')
                ->where('CreatedBy', Auth::id())
                ->get();

        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id'   => 'required'
        ]);

        /** stock checking */
        $book_stock = Book::find($request->book_id)->Stock;

        if ( $book_stock == 0) {
            return redirect()->route('books.index')->with(array(
                'status'    => false,
                'msg'       => 'Unavailable stock'
            ));
        }

        /** check existing cart, prioritize update than insert if have the same book id */
        $exist_cart = Cart::where('BookId', $request->book_id)
                            ->where('CreatedBy', Auth::id())
                            ->first();

        if ( !empty($exist_cart) ) {
            if ( $book_stock <= $exist_cart->qty ) { /** additional checking with existing cart stock */
                return redirect()->route('books.index')->with(array(
                    'status'    => false,
                    'msg'       => 'Unavailable stock'
                ));
            }

            $exist_cart->qty = $exist_cart->qty + 1;
            $exist_cart->save();
        } else {
            Cart::create([
                'BookId'        => $request->book_id,
                'qty'           => 1, /** default qty : 1 */
                'CreatedBy'     => Auth::id(),
            ]);
        }

        return redirect()->route('books.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $request->validate([
            'cart_id'   => 'required',
            'qty'       => 'required'
        ]);

        $cart_id    = $request->cart_id;
        $qty        = $request->qty;

        /** stock checking */
        $cart       = Cart::find($cart_id);
        $book_stock = Book::find($cart->BookId)->Stock;

        if ( $book_stock <= $qty ) { /** additional checking with existing cart stock */
            return response()->json([
                'status'    => false,
                'msg'       => 'Unavailable Stock!',
                'qty'       => $cart->qty
            ]);
        }

        $cart->qty = $qty;
        $cart->save();

        return response()->json([
            'status'    => true,
            'msg'       => 'Stock Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::find($id)->delete();

        return redirect()->route('carts.index');
    }
}
