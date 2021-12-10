<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorebookRequest;
// use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatebookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $books = DB::table('books')->when('categories')->latest()->paginate(10);
        $books = Book::with('categories')->latest()->paginate(10);

        return view('books.index', ['books' => $books]);
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
    public function store(Request $request)
    {
        $newBook = new Book;
        $newBook->title = $request->get('title');
        $newBook->description = $request->get('description');
        $newBook->author = $request->get('author');
        $newBook->publisher = $request->get('publisher');
        $newBook->price = $request->get('price');
        $newBook->stock = $request->get('stock');

        $newBook->status = $request->get('save_action');

        $cover = $request->file('cover');

        if ($cover) {
            $cover_path = $cover->store('book-covers', 'public');

            $newBook->cover = $cover_path;
        }

        $newBook->slug = Str::slug($request->get('title'));

        $newBook->created_by = Auth::user()->id;

        // $newBook->categories()->attach($request->get('categories'));

        $newBook->save();
        $newBook->categories()->attach($request->get('categories'));
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
    public function edit(Book $book)
    {
        $book->id;
        // $book = Book::findOrFail($id);
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebookRequest  $request
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->title = $request->get('title');
        $book->slug = $request->get('slug');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->stock = $request->get('stock');
        $book->price = $request->get('price');
        $newCover = $request->file('cover');

        if ($newCover) {
            if ($book->cover && file_exists(storage_path('app/public/' . $book->cover))) {
                Storage::delete('public/' . $book->cover);
            }
            $newCoverPath = $newCover->store('books-cover', 'public');

            $book->cover = $newCoverPath;
        }

        $book->updated_by = Auth::user()->id;
        $book->status = $request->get('status');
        $book->categories()->sync($request->get('categories'));
        $book->save();

        return redirect()->route('books.edit', [$book->id])->with('status', 'Book successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        $book->id;
        $book->delete();

        return redirect()->route('books.index', [$book->id])->with('status', 'Book move to trash');
    }
}
