<?php

namespace App\Http\Controllers;

use App\Models\book_category_table;
use App\Http\Requests\Storebook_category_tableRequest;
use App\Http\Requests\Updatebook_category_tableRequest;

class BookCategoryTableController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storebook_category_tableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebook_category_tableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book_category_table  $book_category_table
     * @return \Illuminate\Http\Response
     */
    public function show(book_category_table $book_category_table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book_category_table  $book_category_table
     * @return \Illuminate\Http\Response
     */
    public function edit(book_category_table $book_category_table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebook_category_tableRequest  $request
     * @param  \App\Models\book_category_table  $book_category_table
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebook_category_tableRequest $request, book_category_table $book_category_table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_category_table  $book_category_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(book_category_table $book_category_table)
    {
        //
    }
}
