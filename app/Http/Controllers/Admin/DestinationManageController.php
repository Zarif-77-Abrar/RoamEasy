<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;


class DestinationManageController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destinations.manage', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Destination::create($request->all());

        return redirect()->route('admin.destinations.manage')->with('success', 'Destination added successfully.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $destination->update($request->all());

        return redirect()->route('admin.destinations.manage')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('admin.destinations.manage')->with('success', 'Destination deleted successfully.');
    }
}
