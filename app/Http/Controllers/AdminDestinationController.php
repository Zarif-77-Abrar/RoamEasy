<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(10); // now supports links()
        return view('admin.destinations.index', compact('destinations'));
    }



    public function create()
    {
        return view('admin.destinations.create');
    }


    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:255',
            'image_url'   => 'nullable|url',
            // 'image_file'  => 'nullable|image|max:2048', // file upload optional
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
        ]);

        
        $data['created_by'] = Auth::id();

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Destination created successfully.');
    }




    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.destinations.edit', compact('destination'));
    }

    
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:255',
            'image_url'   => 'nullable|url',
            'latitude'    => 'required|numeric|between:-90,90',
            'longitude'   => 'required|numeric|between:-180,180',
        ]);

        

        // Do NOT overwrite created_by on update (unless you want to allow it)
        $destination->update($data);

        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Destination updated successfully.');
    }



    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);


        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted.');
    }


    public function manage()
    {
        // $destinations = Destination::all();
        // return view('admin.destinations.index', compact('destinations'));

        $destinations = Destination::paginate(10); // now supports links()
        return view('admin.destinations.index', compact('destinations'));
    }

}
