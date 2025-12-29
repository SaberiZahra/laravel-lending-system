<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();

        $user->load([
            'items.listings',
            'loans.listing.item'
        ]);

        return response()->json([
            'id' => $user->id,
            'full_name' => $user->full_name,
            'username' => $user->username,
            'email' => $user->email,
            'profile_image' => $user->profile_image,
            'trust_score' => $user->trust_score,
            'status' => $user->status,
            'items' => $user->items,
            'loans' => $user->loans,
        ]);
    }
}
