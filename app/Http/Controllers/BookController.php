<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorebookRequest;
use App\Http\Requests\UpdatebookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebookRequest $request)
    {
        $newBook = new Book;
        $newBook->title = $request->get('title');
        $newBook->description = $request->get('description');
        $newBook->author = $request->get('author');
        $newBook->publisher = $request->get('price');
        $newBook->stock = $request->get('stock');

        $newBook->status = $request->get('save_action');

        $cover = $request->file('cover');

        if ($cover) {
            $cover_path = $cover->store('book-covers', 'public');

            $newBook->cover = $cover_path;
        }

        $newBook->slug = Str::slug($request->get('title'));
        $newBook = Auth::user()->id;

        $newBook->save();

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('books.create')->with('status', 'books succesfully create');
        } else {
            return redirect()->route('books.create')->with('status', 'Book save as draft');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebookRequest  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebookRequest $request, book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        //
    }
}
