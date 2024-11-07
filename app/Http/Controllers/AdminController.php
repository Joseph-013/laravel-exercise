<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // get all cards for all roles
        $cards = CardResource::collection(Card::all())->toArray($request);
        return Inertia::render('AdminPages/Dashboard', [
            'cards' => $cards,
        ]);
    }

    public function index_bin(Request $request)
    {
        // get all trashed cards
        $cards = CardResource::collection(
            Card::onlyTrashed()->get()
        )->toArray($request);
        return Inertia::render('AdminPages/DeletedCards', [
            'cards' => $cards,
        ]);
    }
}
