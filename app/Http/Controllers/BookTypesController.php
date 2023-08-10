<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookTypes = BookType::all();

        return view('book-types.index', compact('bookTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        BookType::create([
            'BookType'  => $request->name
        ]);

        return redirect()->route('book-types.index');
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
        $bookType = BookType::find($id);

        return view('book-types.edit', compact('bookType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookType = BookType::find($id);

        $bookType->BookType = $request->name;
        $bookType->save();

        return redirect()->route('book-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookType = BookType::find($id);

        $bookType->delete();

        return redirect()->route('book-types.index');
    }
}
