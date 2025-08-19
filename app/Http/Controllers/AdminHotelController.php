<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('destination')->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.hotels.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'rating'         => 'nullable|numeric|min:0|max:5',
            'details'        => 'nullable|string',
            'image_url'      => 'nullable|url',
        ]);

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')
                         ->with('success', 'Hotel created successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $destinations = Destination::all();
        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'rating'         => 'nullable|numeric|min:0|max:5',
            'details'        => 'nullable|string',
            'image_url'      => 'nullable|url',
        ]);

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')
                         ->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
                         ->with('success', 'Hotel deleted successfully.');
    }
}
