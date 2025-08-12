{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Destination') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $destination->name }}" required />
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <x-label for="location" :value="__('Location')" />
                        <x-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ $destination->location }}" required />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <x-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ $destination->description }}</textarea>
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <x-label for="category" :value="__('Category')" />
                        <x-input id="category" class="block mt-1 w-full" type="text" name="category" value="{{ $destination->category }}" required />
                    </div>

                    <!-- Image URL -->
                    <div class="mb-4">
                        <x-label for="image_url" :value="__('Image URL')" />
                        <x-input id="image_url" class="block mt-1 w-full" type="text" name="image_url" value="{{ $destination->image_url }}" />
                    </div>

                    <!-- Latitude -->
                    <div class="mb-4">
                        <x-label for="latitude" :value="__('Latitude')" />
                        <x-input id="latitude" class="block mt-1 w-full" type="number" step="0.0000001" name="latitude" value="{{ $destination->latitude }}" required />
                    </div>

                    <!-- Longitude -->
                    <div class="mb-4">
                        <x-label for="longitude" :value="__('Longitude')" />
                        <x-input id="longitude" class="block mt-1 w-full" type="number" step="0.0000001" name="longitude" value="{{ $destination->longitude }}" required />
                    </div>

                    <!-- Submit Button -->
                    <x-button class="mt-4">
                        {{ __('Update Destination') }}
                    </x-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
 --}}

<!-- resources/views/admin/destinations/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Destination
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $destination->name) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                        <input type="text" name="location" id="location"
                               value="{{ old('location', $destination->location) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('location')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                  required>{{ old('description', $destination->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category" class="block font-medium text-sm text-gray-700">Category</label>
                        <input type="text" name="category" id="category"
                               value="{{ old('category', $destination->category) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image URL -->
                    <div class="mb-4">
                        <label for="image_url" class="block font-medium text-sm text-gray-700">Image URL</label>
                        <input type="text" name="image_url" id="image_url"
                               value="{{ old('image_url', $destination->image_url) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        @error('image_url')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Latitude -->
                    <div class="mb-4">
                        <label for="latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
                        <input type="text" name="latitude" id="latitude"
                               value="{{ old('latitude', $destination->latitude) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('latitude')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Longitude -->
                    <div class="mb-4">
                        <label for="longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
                        <input type="text" name="longitude" id="longitude"
                               value="{{ old('longitude', $destination->longitude) }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                               required>
                        @error('longitude')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Update Destination
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
