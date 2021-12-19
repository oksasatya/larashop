<?php

namespace App\Http\Controllers;

use App\Models\book_order;
use App\Http\Requests\Storebook_orderRequest;
use App\Http\Requests\Updatebook_orderRequest;

class BookOrderController extends Controller
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
     * @param  \App\Http\Requests\Storebook_orderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebook_orderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\book_order  $book_order
     * @return \Illuminate\Http\Response
     */
    public function show(book_order $book_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\book_order  $book_order
     * @return \Illuminate\Http\Response
     */
    public function edit(book_order $book_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebook_orderRequest  $request
     * @param  \App\Models\book_order  $book_order
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebook_orderRequest $request, book_order $book_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\book_order  $book_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(book_order $book_order)
    {
        //
    }
}
