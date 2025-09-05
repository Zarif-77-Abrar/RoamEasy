<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4" style="color:white">Plan: {{ $itinerary->title }}</h1>
        <p class="text-gray-600 mb-6" style="color:white">
            {{ $itinerary->start_date }} → {{ $itinerary->end_date }}
        </p>

        <h2 class="text-xl font-semibold mb-3" style="color:white">Your Days</h2>

        <ul class="space-y-4" style="color:white">
            @forelse ($itinerary->days as $day)
                <li class="p-4 border rounded flex justify-between items-center" style="color:white">
                    <div>
                        <p class="font-medium" style="color:white">Day {{ $day->day_number }}</p>
                        <p class="text-gray-700" style="color:white">
                            Destination: {{ $day->destination->name }}
                        </p>
                        @if($day->note)
                            <p class="text-gray-500 text-sm mt-1" style="color:white">Note: {{ $day->note }}</p>
                        @endif
                    </div>
                    <form action="{{ route('itineraries.days.destroy', [$itinerary, $day]) }}" 
                          method="POST"
                          onsubmit="return confirm('Delete this day?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded" style="color:white">
                            Delete
                        </button>
                    </form>
                </li>
            @empty
                <li class="p-4 border rounded text-gray-600" style="color:white">No days added yet.</li>
            @endforelse
        </ul>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('itineraries.days.create', $itinerary) }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded">
               Add Day
            </a>

            <a href="{{ route('itineraries.index') }}"
               class="px-4 py-2 bg-indigo-500 text-white rounded">
               Back to My Plans
            </a>
        </div>
    </div>
</x-app-layout>
