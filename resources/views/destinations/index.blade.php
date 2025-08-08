<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Browse Destinations</h2>
    </x-slot>

    <div class="p-6">
        
        {{-- filter form --}}
        <form method="GET" action="{{ route('destinations.index') }}" class="mb-6">
            <select name="city">
                <option value="">-- Select City --</option>
                @foreach(($cities ?? collect()) as $city)
                    <option value="{{ $city }}" @selected(request('city') == $city)>{{ $city }}</option>
                @endforeach
            </select>

            <select name="category">
                <option value="">-- Select Category --</option>
                @foreach(($categories ?? collect()) as $category)
                    <option value="{{ $category }}" @selected(request('category') == $category)>{{ $category }}</option>
                @endforeach
            </select>

            <select name="min_rating">
                <option value="">-- Minimum Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @selected(request('min_rating') == $i)>{{ $i }} stars</option>
                @endfor
            </select>

            <button type="submit">Filter</button>
        </form>              
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($destinations as $destination)
                <div class="bg-white p-4 shadow rounded">
                    <!-- Image -->
                    {{-- <img src="{{ $destination->image_url }}" 
                        alt="{{ $destination->name }}" 
                        class="w-full h-40 object-cover mb-2"> --}}

                    <!-- Name -->
                    <h3 class="text-lg font-bold">{{ $destination->name }}</h3>

                    <!-- Location & Category -->
                    <p class="text-sm text-gray-600">
                        {{ $destination->location }} — {{ $destination->category }}
                    </p>

                    <!-- Description -->
                    {{-- <p class="mt-2 text-sm">{{ Str::limit($destination->description, 100) }}</p> --}}
                    <!-- Rating -->
                    <p>Rating: {{ number_format($destination->average_rating, 1) ?? 'N/A' }}</p>

                    <!-- View Reviews Button -->
                    <a href="{{ route('reviews.showForDestination', $destination->id) }}" 
                    class="bg-blue-500 text-black px-3 py-1 rounded mt-3 inline-block">
                        View Reviews
                    </a>

                    <a href="{{ route('destinations.show', $destination->id) }}" 
                        class="bg-blue-600 text-black px-3 py-1 rounded mt-2 inline-block hover:bg-blue-700">
                        Details
                    </a>
                </div>
            @empty
                <p>No destinations found.</p>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $destinations->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
