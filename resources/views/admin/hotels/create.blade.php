<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add New Hotel</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8">
        <form action="{{ route('admin.hotels.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Destination Dropdown -->
            <div>
                <label for="destination_id" class="block font-medium text-sm text-gray-700">Destination</label>
                <select name="destination_id" id="destination_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select Destination --</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                    @endforeach
                </select>
                @error('destination_id') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Hotel Name -->
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Hotel Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('name') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block font-medium text-sm text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" id="price" required value="{{ old('price') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('price') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Rating -->
            <div>
                <label for="rating" class="block font-medium text-sm text-gray-700">Rating (0 - 5)</label>
                <input type="number" step="0.1" min="0" max="5" name="rating" id="rating" value="{{ old('rating') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('rating') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Details -->
            <div>
                <label for="details" class="block font-medium text-sm text-gray-700">Details</label>
                <textarea name="details" id="details" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('details') }}</textarea>
                @error('details') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Image URL -->
            {{-- <div>
                <label for="image_url" class="block font-medium text-sm text-gray-700">Image URL</label>
                <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('image_url') 
                    <p class="text-red-600 text-sm">{{ $message }}</p> 
                @enderror
            </div> --}}

            <!-- Submit -->
            <div>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Hotel
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
