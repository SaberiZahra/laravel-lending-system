<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();

        $user->load([
            'items',
            'loans.listing.item'
        ]);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'full_name' => 'sometimes|string|max:150',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|max:30',
            'address' => 'sometimes|string',
            'profile_image' => 'sometimes|string',
        ]);

        $user->update($data);

        return response()->json($user);
    }

    /* ===== ADMIN ===== */

    public function index()
    {
        return User::withCount(['items', 'loans'])
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function show(User $user)
    {
        $user->load(['items', 'loans']);

        return response()->json($user);
    }

    public function updateTrustScore(Request $request, User $user)
    {
        if (auth()->user()->role !== 1) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'trust_score' => 'required|numeric|min:0|max:10',
        ]);

        $user->trust_score = $validated['trust_score'];
        $user->save();

        return response()->json([
            'message' => 'Trust score updated successfully',
            'user' => $user
        ]);
    }
}
