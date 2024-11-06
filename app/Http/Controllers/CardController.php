<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CardController extends Controller
{
    public function index(Request $request)
    {
        // $cards = Auth::user()->cards->makeHidden(['user_id', 'created_at', 'updated_at', 'deleted_at']);
        $cards = CardResource::collection(Auth::user()->cards)->toArray($request);
        return Inertia::render('AuthPages/Dashboard', [
            'cards' => $cards,
            'notificaiton' => null,
        ]);
    }
    public function index_bin(Request $request)
    {
        // $cards = Auth::user()->cards->makeHidden(['user_id', 'created_at', 'updated_at', 'deleted_at']);
        $cards = CardResource::collection(Auth::user()->cards)->toArray($request);
        return Inertia::render('AuthPages/Dashboard', [
            'cards' => $cards,
            'notificaiton' => null,
        ]);
    }
    //store, create, update, destroy
    public function store(Request $request)
    {
        dd($request->all());
        //
    }
    public function update(CardRequest $request)
    {
        dd($request->validated());
        // dd($request->all());
    }
    public function destroy($id)
    {
        // soft delete
        dd("delete: $id");
    }
    public function forget($id)
    {
        //
        dd("forget: $id");
    }
}
