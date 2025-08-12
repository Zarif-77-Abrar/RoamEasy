
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Destination</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <form method="POST" action="{{ route('admin.destinations.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('latitude') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('longitude') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Destination
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
