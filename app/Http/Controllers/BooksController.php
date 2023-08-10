<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookType;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('bookType')->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookTypes = BookType::all();

        return view('books.create', compact('bookTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category'  => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
        ]);

        Book::create([
            'BookTypeId'  => $request->category,
            'BookName'      => $request->name,
            'Description'   => $request->description,
            'Publisher'     => $request->publisher,
            'Year'          => $request->year,
            'Stock'          => $request->stock,
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('bookType')->where('id', $id)->first();

        return view('books.view', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('bookType')->where('id', $id)->first();
        $bookTypes = BookType::all();

        return view('books.edit', compact('book', 'bookTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category'  => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
        ]);

        $data = [
            'BookTypeId'  => $request->category,
            'BookName'      => $request->name,
            'Description'   => $request->description,
            'Publisher'     => $request->publisher,
            'Year'          => $request->year,
            'Stock'          => $request->stock,
        ];

        Book::find($id)->update($data);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::find($id)->delete();

        return redirect()->route('books.index');
    }
}
