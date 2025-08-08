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
  
          <a href="{{ route('destinations.index') }}" class="inline-block mt-6 text-blue-600 hover:underline" style="color:white;font-size:20px">
            ← Back to destinations
          </a>
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
    </div>
  </x-app-layout>
  