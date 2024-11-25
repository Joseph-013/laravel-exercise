<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Laravel\Facades\Image;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $cards = CardResource::collection(Auth::user()->cards)->toArray($request);
        return Inertia::render('AuthPages/Dashboard', [
            'cards' => $cards,
        ]);
    }

    public function index_bin(Request $request)
    {
        $cards = CardResource::collection(
            Card::where('user_id', Auth::id())->onlyTrashed()->get()
        )->toArray($request);
        return Inertia::render('AuthPages/DeletedCards', [
            'cards' => $cards,
        ]);
    }

    public function store(CardRequest $request)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['profile_picture_file'])) {
            $file = $request->file('profile_picture_file');

            // $image = Image::make($file);
            $image = Image::read(file_get_contents($file));
            $image->cover(500, 500, 'center');


            $newFilename = uniqid() . '.' . $file->getClientOriginalExtension();
            $image->save(Storage::disk('public')->path($newFilename));
            $validatedData['profile_picture'] = $newFilename;
        }

        Card::create([
            'user_id' => $validatedData['user_id'] ?? Auth::id(),
            'profile_picture' => $validatedData['profile_picture'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'title' => $validatedData['title'],
            'id_code' => $validatedData['id_code'],
            'contact' => $validatedData['contact'],
            'blood_type' => $validatedData['blood_type'],
        ]);

        session()->flash('toast', 'Success');

        return redirect()->back();
    }

    public function update(CardRequest $request)
    {
        $validatedData = $request->validated();

        $originalCard = Card::find($validatedData['id']);

        if (isset($validatedData['profile_picture_file'])) {
            $file = $request->file('profile_picture_file');

            if ($originalCard->profile_picture != 'default.jpeg') {
                Storage::disk('public')->delete($originalCard->profile_picture);
            }

            $image = Image::read(file_get_contents($file));
            $image->cover(500, 500, 'center');


            $newFilename = uniqid() . '.' . $file->getClientOriginalExtension();
            $image->save(Storage::disk('public')->path($newFilename));
            $validatedData['profile_picture'] = $newFilename;
        }


        $originalCard->update([
            'profile_picture' => $validatedData['profile_picture'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'title' => $validatedData['title'],
            'id_code' => $validatedData['id_code'],
            'contact' => $validatedData['contact'],
            'blood_type' => $validatedData['blood_type'],
        ]);
        $originalCard->save();

        session()->flash('toast', 'Success');

        return redirect()->back();
    }

    public function restore($id)
    {
        Card::onlyTrashed()->findOrFail($id)->restore();
        session()->flash('toast', 'Card restored.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        Card::findOrFail($id)->delete();
        session()->flash('toast', 'Card moved to bin.');

        return redirect()->back();
    }

    public function forget($id)
    {
        Card::withTrashed()->findOrFail($id)->forceDelete();

        session()->flash('toast', 'Card permanently deleted.');

        return redirect()->back();
    }
}
