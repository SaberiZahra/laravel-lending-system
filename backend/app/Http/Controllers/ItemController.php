<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        return Item::all();
    }

    public function store(Request $request) {
        $item = Item::create($request->all());
        return response()->json($item);
    }

    public function show($id) {
        return Item::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id) {
        $item = Item::findOrFail($id);
        $item->delete(); // SoftDelete
        return response()->json(['message' => 'Item deleted']);
    }
}
