<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index() {
        return Listing::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'daily_fee' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after_or_equal:available_from',
        ]);

        $item = Item::findOrFail($request->item_id);
        if ($item->owner_id !== auth()->id()) {
            return response()->json(['message'=>'Not allowed'],403);
        }

        $listing = Listing::create($request->only([
            'item_id','title','description','daily_fee','deposit_amount','available_from','available_until'
        ]));

        return response()->json($listing, 201);
    }


    public function show($id) {
        return Listing::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $listing = Listing::findOrFail($id);
        $listing->update($request->all());
        return response()->json($listing);
    }

    public function destroy($id) {
        $listing = Listing::findOrFail($id);
        $listing->delete(); // SoftDelete
        return response()->json(['message' => 'Listing deleted']);
    }
}
