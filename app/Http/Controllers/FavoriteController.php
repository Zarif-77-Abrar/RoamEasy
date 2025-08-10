<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle($destinationId)
    {
        // Ensure only tourists can favorite
        if (!auth()->user()->hasRole('tourist')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Only tourists can use favorites.'
            ], 403); // Forbidden
        }

        $favorite = Favorite::where('user_id', auth()->id())
                            ->where('destination_id', $destinationId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'destination_id' => $destinationId
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
