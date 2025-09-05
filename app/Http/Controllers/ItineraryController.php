<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function index()
    {
        $itineraries = Itinerary::where('user_id', auth()->id())
        ->latest()
        ->paginate(10);
        return view('itineraries.index', compact('itineraries'));
    }

    public function create()
    {
        return view('itineraries.create');
    }

    public function store(Request $request)
    {
        // $this->authorize('viewAny', Itinerary::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $itinerary = Itinerary::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return redirect()
            ->route('itineraries.show', $itinerary)
            ->with('status', 'Plan created successfully! Now add your destinations.');
    }



    public function show(Itinerary $itinerary)
    {
        // load days and destination for display
        $itinerary->load('days.destination');

        $start = Carbon::parse($itinerary->start_date);
        $end   = Carbon::parse($itinerary->end_date);

        // inclusive difference: same-day trip => 1 day
        $totalDays = $start->diffInDays($end) + 1;

        $usedDays = $itinerary->days->count();
        $remainingDays = max(0, $totalDays - $usedDays);

        return view('itineraries.show', compact('itinerary', 'totalDays', 'usedDays', 'remainingDays'));
    }



    public function destroy(Itinerary $itinerary)
    {
        if ($itinerary->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $itinerary->delete();
        return redirect()->route('itineraries.index')
                         ->with('success', 'Itinerary deleted successfully.');
    }

    
    public function details(Itinerary $itinerary)
    {
        // eager load days + destinations for performance
        $itinerary->load('days.destination');

        return view('itineraries.details', compact('itinerary'));
    }
    
}






