<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
      <!-- Grid: text takes 2/3, image takes 1/3 on md+ screens; stacks on small -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
        <!-- Text column (span 2 on md+) -->
        <div class="md:col-span-2">
          <h1 class="text-2xl font-bold mb-4" style="color:white;font-size:40px">{{ $destination->name }}</h1>
  
          <p style="color:white;font-size:20px"><strong>Location:</strong> {{ $destination->location }}</p>
          <p style="color:white;font-size:20px"><strong>Category:</strong> {{ $destination->category }}</p>
          <p style="color:white;font-size:20px"><strong>Average Rating:</strong>
              {{ $destination->average_rating ? number_format($destination->average_rating, 1) : 'N/A' }}
          </p>
  
          <p class="mt-4 text-gray-700 leading-relaxed" style="color:white;font-size:25px">{{ $destination->description }}</p>
  
          {{-- <a href="{{ route('destinations.index') }}" class="inline-block mt-6 text-blue-600 hover:underline" style="color:white;font-size:20px">
            ← Back to destinations
          </a> --}}
        </div>
  
        <!-- Image column (fixed size) -->
        <div class="md:col-span-1 flex md:justify-end">
          <!-- Change w-64 h-64 to w-72 h-72 etc. to adjust size -->
          <div class="w-64 h-64 overflow-hidden rounded shadow flex-shrink-0">
            <img
                src="{{ $destination->image_url ?? '/images/placeholder.png' }}"
                alt="{{ $destination->name }}"
                {{-- class="w-full h-full object-cover" --}}
                width="500" height="375"
            >
          </div>
        </div>
      </div>
      
      <!-- Mini Map -->
      <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4" style="color:white;font-size:28px">
          Map Location
        </h2>
        <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>
      </div>

      
      <!-- Hotels Section -->
      <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6" style="color:white;font-size:32px">
            Hotels in {{ $destination->name }}
        </h2>

        @if($destination->hotels->isEmpty())
            <p class="text-white-400" style="font-size:20px">
                No hotels available for this destination yet.
            </p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($destination->hotels as $hotel)
                    <div class="bg-gray-800 rounded-lg shadow p-4">
                        <h2 class="text-xl font-semibold mb-2" style="color:white">
                            {{ $hotel->name }}
                        </h2>
                        @if($hotel->image_url)
                            <img src="{{ $hotel->image_url }}" 
                                 alt="{{ $hotel->name }}" 
                                 class="w-full h-40 object-cover rounded mb-3">
                        @endif
                        <p class="text-white-300 mb-2" style="color:white">{{ $hotel->details }}</p>
                        <p style="color:white"><strong>Price:</strong> ${{ $hotel->price }}</p>
                        <p style="color:white"><strong>Rating:</strong> {{ $hotel->rating }}</p>
                    </div>
                @endforeach
            </div>
        @endif
      </div>
    </div>

    <div>
      <a href="{{ route('destinations.index') }}" class="inline-block mt-6 text-blue-600 hover:underline" style="color:white;font-size:20px">
        ← Back to destinations
      </a>
    </div>


    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var lat = {{ $destination->latitude ?? '0' }};
        var lng = {{ $destination->longitude ?? '0' }};
    
        // Ensure values are valid
        if (!lat || !lng) {
            console.error("Invalid coordinates:", lat, lng);
            return;
        }
    
        var map = L.map('map').setView([lat, lng], 13);
    
        // Tile layer (OpenStreetMap free tiles)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    
        // Marker at destination
        L.marker([lat, lng]).addTo(map)
            .bindPopup("<b>{{ $destination->name }}</b><br>{{ $destination->location }}")
            .openPopup();
    });
    </script>
</x-app-layout>
  