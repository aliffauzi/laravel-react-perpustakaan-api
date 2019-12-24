<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
class BooksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:books|max:30',
            'description' => 'required|max:100',
            'penerbit' => 'required|max:30',
            'tanggal_terbit' => 'required|date',
            'stock' => 'required|integer'
        ]);

        $book = new Book;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->penerbit = $request->penerbit;
        $book->tanggal_terbit = $request->tanggal_terbit;
        $book->stock = $request->stock;
        $book->save();

        return redirect()->route('books.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'description' => 'required|max:100',
            'penerbit' => 'required|max:30',
            'tanggal_terbit' => 'required|date',
            'stock' => 'required|integer'
        ]);

        $book->update($request->all());
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}