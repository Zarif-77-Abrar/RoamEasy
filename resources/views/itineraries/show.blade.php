<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $itinerary->title }} ({{ $itinerary->start_date }} - {{ $itinerary->end_date }})
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium mb-4">Days</h3>

            <ul class="space-y-4">
                @forelse($itinerary->days as $day)
                    <li class="border p-4 rounded">
                        <div class="flex justify-between items-center">
                            <div>
                                <strong>Day {{ $day->day_number }}:</strong>
                                {{ $day->destination->name ?? 'Unknown' }}
                                @if($day->note)
                                    <p class="text-sm text-gray-600">{{ $day->note }}</p>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('itineraries.days.destroy', [$itinerary, $day]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li>No days added yet.</li>
                @endforelse
            </ul>
            {{-- <div class="mt-6 flex space-x-3">
                <a href="{{ route('itineraries.index') }}"
                   class="px-4 py-2 bg-indigo-500 text-black rounded" style="color:black">
                   Back to My Plans
                </a>
                <a href="{{ route('itineraries.days.create', $itinerary) }}"
                   class="px-4 py-2 bg-indigo-600 text-black rounded" style="color:black">
                   Add Day
                </a>
            </div> --}}
            <div class="mt-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-600">
                            Days: <strong>{{ $usedDays }}</strong> / <strong>{{ $totalDays }}</strong>
                        </p>
                    </div>
            
                    <div class="flex space-x-2">
                        <a href="{{ route('itineraries.index') }}" class="px-3 py-2 bg-indigo-500 text-black rounded" style="color:black">Back to My Plans</a>
            
                        @if($usedDays < $totalDays)
                            <a href="{{ route('itineraries.days.create', $itinerary) }}" class="px-4 py-2 bg-indigo-600 text-black rounded" style="color:black">
                                Add Day
                            </a>
                        @else
                            <button disabled class="px-4 py-2 bg-gray-300 text-black-600 rounded" style="color:black" title="Trip day limit reached">
                                Add Day
                            </button>
                        @endif
                    </div>
                </div>
            </div>
                  
        </div>
    </div>
</x-app-layout>
