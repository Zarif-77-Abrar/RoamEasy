<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-black-800 leading-tight">
          {{ __('Create a Plan') }}
      </h2>
  </x-slot>

  <div class="py-6">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white shadow-sm rounded-lg p-6 text-gray-900">

              <form action="{{ route('itineraries.store') }}" method="POST">
                  @csrf

                  {{-- Title --}}
                  <div class="mb-4">
                      <label class="block text-sm font-medium text-gray-700">Title</label>
                      <input type="text" name="title" value="{{ old('title') }}"
                             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                  </div>

                  {{-- Start Date --}}
                  <div class="mb-4">
                      <label class="block text-sm font-medium text-gray-700">Start Date</label>
                      <input type="date" name="start_date" value="{{ old('start_date') }}"
                             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      @error('start_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                  </div>

                  {{-- End Date --}}
                  <div class="mb-4">
                      <label class="block text-sm font-medium text-gray-700">End Date</label>
                      <input type="date" name="end_date" value="{{ old('end_date') }}"
                             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                      @error('end_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div class="flex justify-end">
                      <button type="submit"
                        class="px-4 py-2 bg-indigo-500 text-black rounded" style="color:black"> 
                          Save & Continue
                      </button>
                  </div>
              </form>

          </div>
      </div>
  </div>
</x-app-layout>



