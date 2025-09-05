<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Itinerary;
use App\Models\ItineraryDay;
use App\Models\Destination;
use Illuminate\Http\Request;

class ItineraryDayController extends Controller
{
    /** Show form to add a new day */
    


    public function create(Itinerary $itinerary)
    {
        $itinerary->load('days');
        $user = auth()->user();
        $totalDays = Carbon::parse($itinerary->start_date)->diffInDays(Carbon::parse($itinerary->end_date)) + 1;
        $usedDays = $itinerary->days->count();
    
        if ($usedDays >= $totalDays) {
            return redirect()
                ->route('itineraries.show', $itinerary)
                ->with('status', 'You have already added all ' . $totalDays . ' days for this trip.');
        }
    
        $destinations = Destination::all();
        $favorites = collect();
        if ($user) {
            $favorites = $user->favorites()->with('destination')->get();
        }
        
        return view('itineraries.days.create', compact('itinerary', 'destinations', 'totalDays', 'usedDays'));
    }




    
    public function store(Request $request, Itinerary $itinerary)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'note' => 'nullable|string',
        ]);
    
        // compute total allowed days
        $totalDays = Carbon::parse($itinerary->start_date)->diffInDays(Carbon::parse($itinerary->end_date)) + 1;
    
        // existing day_numbers sorted ascending
        $existing = $itinerary->days()->orderBy('day_number')->pluck('day_number')->toArray();
    
        $usedDays = count($existing);
    
        if ($usedDays >= $totalDays) {
            return redirect()
                ->route('itineraries.show', $itinerary)
                ->with('status', 'You cannot add more days. This trip is limited to ' . $totalDays . ' days.');
        }
    
        // find smallest missing positive integer for day_number (fills gaps)
        $next = 1;
        foreach ($existing as $n) {
            if ($n === $next) $next++;
            elseif ($n > $next) break;
        }
    
        // extra guard
        if ($next > $totalDays) {
            return redirect()
                ->route('itineraries.show', $itinerary)
                ->with('status', 'No available day slots remaining.');
        }
    
        $itinerary->days()->create([
            'day_number'    => $next,
            'destination_id'=> $validated['destination_id'],
            'note'          => $validated['note'] ?? null,
        ]);
    
        return redirect()
            ->route('itineraries.show', $itinerary)
            ->with('status', 'Day added successfully!');
    }
    

   

    public function destroy(Itinerary $itinerary, ItineraryDay $day)
    {
        // make sure this day belongs to the itinerary
        if ($day->itinerary_id === $itinerary->id) {
            $day->delete();
        }
    
        return redirect()->route('itineraries.details', $itinerary)
                         ->with('success', 'Day removed successfully.');
    }
    

}
