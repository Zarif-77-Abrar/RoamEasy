<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Manage Hotels</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8">
        <a href="{{ route('admin.hotels.create') }}"
           class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Hotel
        </a>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Destination</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Rating</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                    <tr>
                        <td class="border px-4 py-2">{{ $hotel->id }}</td>
                        <td class="border px-4 py-2">{{ $hotel->destination->name }}</td>
                        <td class="border px-4 py-2">{{ $hotel->name }}</td>
                        <td class="border px-4 py-2">{{ $hotel->price }}</td>
                        <td class="border px-4 py-2">{{ $hotel->rating }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.hotels.edit', $hotel) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600"
                                        onclick="return confirm('Delete this hotel?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $hotels->links() }}
        </div>
    </div>
</x-app-layout>
