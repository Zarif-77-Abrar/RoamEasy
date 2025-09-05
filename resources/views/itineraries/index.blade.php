<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('My Plans') }}
      </h2>
  </x-slot>

  <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          {{-- Flash message --}}
          @if (session('status'))
              <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                  {{ session('status') }}
              </div>
          @endif

          {{-- Create Plan button --}}
          <div class="flex justify-end mb-4">
              <a href="{{ route('itineraries.create') }}"
                 class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                  {{ __('Create Plan') }}
              </a>
          </div>

          {{-- Plans list --}}
          <div class="bg-white overflow-hidden shadow-sm rounded-lg">
              <div class="p-6 text-gray-900">

                  @if($itineraries->count() === 0)
                      <p class="text-gray-600">
                          You have no plans yet. Click <strong>Create Plan</strong> to start planning your trip.
                      </p>
                  @else
                      <div class="overflow-x-auto">
                          <table class="min-w-full divide-y divide-gray-200">
                              <thead class="bg-gray-50">
                                  <tr>
                                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                          Title
                                      </th>
                                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                          Duration
                                      </th>
                                      <th class="px-4 py-2"></th>
                                  </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                                  @foreach ($itineraries as $itinerary)
                                      <tr>
                                          {{-- Title --}}
                                          <td class="px-4 py-2 font-medium text-gray-900">
                                              {{ $itinerary->title }}
                                          </td>

                                          {{-- Duration --}}
                                          <td class="px-4 py-2 text-gray-600">
                                              {{ \Carbon\Carbon::parse($itinerary->start_date)->format('M d, Y') }}
                                              –
                                              {{ \Carbon\Carbon::parse($itinerary->end_date)->format('M d, Y') }}
                                          </td>

                                          {{-- Actions --}}
                                          <td>  
                                            <a href="{{ route('itineraries.details', $itinerary) }}"
                                                    class="px-4 py-2 bg-indigo-500 text-black rounded" style="color:black">
                                                    View Details
                                            </a>
                                          </td>

                                          <td class="px-4 py-2 text-right space-x-2">
                                              {{-- Optional: a View/Manage button (Step 2 will use this) --}}
                                              {{-- <a href="{{ route('itineraries.show', $itinerary) }}"
                                                  class="px-3 py-1.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                                  View
                                              </a> --}}

                                              {{-- Delete --}}
                                              <form action="{{ route('itineraries.destroy', $itinerary) }}"
                                                    method="POST" class="inline">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit"
                                                          onclick="return confirm('Delete this plan?')"
                                                          class="px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700">
                                                      Delete
                                                  </button>
                                              </form>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                      
                      <div class="mt-4">
                          {{ $itineraries->links() }}
                      </div>
                  @endif
              </div>
          </div>
          <div>
            <a href="{{ route('tourist.dashboard') }}"
                class="px-4 py-2 bg-indigo-500 text-white rounded" style="color:white">
                Dashboard
            </a>
          </div>
      </div>
  </div>
</x-app-layout>