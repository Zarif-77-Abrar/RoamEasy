<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        // dynamic filter lists
        $cities      = Destination::select('location')->distinct()->pluck('location');
        $categories  = Destination::select('category')->distinct()->pluck('category');

        // build query with filters
        $query = Destination::query();

        if ($request->filled('city')) {
            $query->where('location', $request->city);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('min_rating')) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        // keep query-string when paginating
        $destinations = $query->paginate(10)->appends($request->only(['city','category','min_rating']));

        return view('destinations.index', compact('destinations', 'cities', 'categories'));
    }
}
