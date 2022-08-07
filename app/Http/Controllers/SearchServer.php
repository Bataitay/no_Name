<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        dd($request->category_id);
        return view('Backend.Products.index', compact('Products'));
    }
}
