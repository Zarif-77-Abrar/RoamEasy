@php
    $favorites = $favorites ?? collect();
@endphp

<x-app-layout>
    <x-slot name="header">
      <h2 class="text-xl font-semibold">{{ 'Add Day to ' . $itinerary->title }}</h2>
    </x-slot>
  
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm rounded-lg p-6">
        <div class="mb-4">
          <a href="{{ route('itineraries.show', $itinerary) }}" class="px-3 py-2 bg-gray-500 text-white rounded">Back to Plan</a>
        </div>
  
        <p class="mb-4 text-gray-700">
          Trip length: <strong>{{ $totalDays }}</strong> days. Already added: <strong>{{ $usedDays }}</strong>.
        </p>
  
        @if($usedDays >= $totalDays)
          <div class="p-4 bg-yellow-50 border rounded text-sm text-gray-700">
            This trip already has all {{ $totalDays }} days added.
          </div>
        @else
          <div class="mb-4">
            <p class="text-sm text-gray-600">You are adding <strong>Day {{ $usedDays + 1 }}</strong> of {{ $totalDays }}.</p>
          </div>
          
          {{-- Favorites quick-pick --}}
            {{-- @if($favorites->count())
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Your Favorite Destinations</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($favorites as $fav)
                            <button type="button"
                                onclick="document.getElementById('destination_id').value = '{{ $fav->destination->id }}'"
                                class="px-3 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                                {{ $fav->destination->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif --}}

          <form method="POST" action="{{ route('itineraries.days.store', $itinerary) }}">
            @csrf
  
            <div class="mb-4">
              <label class="block text-sm font-medium">Destination</label>
              <select name="destination_id" required class="mt-1 block w-full border rounded p-2">
                <option value="">-- Select Destination --</option>
                @foreach($destinations as $destination)
                  <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                    {{ $destination->name }}
                  </option>
                @endforeach
              </select>
              @error('destination_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
  
            <div class="mb-4">
              <label class="block text-sm font-medium">Note (optional)</label>
              <textarea name="note" class="mt-1 block w-full border rounded p-2">{{ old('note') }}</textarea>
            </div>
  
            <div class="flex items-center space-x-2">
              <button type="submit" class="px-4 py-2 bg-indigo-200 rounded">Save Day</button>
              <a href="{{ route('itineraries.show', $itinerary) }}" class="px-4 py-2 bg-indigo-200 rounded">Cancel</a>
            </div>

            <div>
                <a href="{{ route('destinations.index') }}"
                    class="px-4 py-2 bg-indigo-500 text-white rounded" style="color:black">
                    Destination Details 
                </a>
            </div>
          </form>
        @endif
      </div>
    </div>
</x-app-layout>
  