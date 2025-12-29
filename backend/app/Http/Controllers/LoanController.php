<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index() {
        return Loan::all();
    }

    public function store(Request $request) {
        $loan = Loan::create($request->all());
        return response()->json($loan);
    }

    public function show($id) {
        return Loan::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $loan = Loan::findOrFail($id);
        $loan->update($request->all());
        return response()->json($loan);
    }

    public function destroy($id) {
        $loan = Loan::findOrFail($id);
        $loan->delete(); // SoftDelete
        return response()->json(['message' => 'Loan deleted']);
    }

    public function myLoans(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $loans = Loan::with('listing.item','borrower')->get();
        } else {
            $loans = Loan::with('listing.item')
                ->where('borrower_id', $user->id)
                ->orWhereHas('listing.item', function($q) use ($user) {
                    $q->where('owner_id', $user->id);
                })->get();
        }

        return response()->json($loans);
    }

    public function approve(Loan $loan)
    {
        $user = auth()->user();
        if ($loan->listing->item->owner_id !== $user->id) {
            return response()->json(['message'=>'Not allowed'],403);
        }

        $loan->update([
            'status' => 'approved',
            'approval_date' => now()
        ]);

        return response()->json($loan);
    }

    public function reject(Loan $loan)
    {
        $user = auth()->user();
        if ($loan->listing->item->owner_id !== $user->id) {
            return response()->json(['message'=>'Not allowed'],403);
        }

        $loan->update([
            'status' => 'rejected'
        ]);

        return response()->json($loan);
    }

}
