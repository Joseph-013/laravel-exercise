<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    //store, create, update, destroy
    public function store(Request $request, $id)
    {
        //
        dd($request->all());
    }
    public function update(Request $request, $id)
    {
        dd($request->all());
    }
    public function destroy(Request $request, $id)
    {
        // soft delete
        dd($request->all());
    }
    public function forget(Request $request, $id)
    {
        //
        dd($request->all());
    }
}
