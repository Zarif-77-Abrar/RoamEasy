<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Destinations</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('admin.destinations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Destination</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Location</th>
                    <th class="border px-2 py-1">Category</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($destinations as $destination)
                <tr>
                    <td class="border px-2 py-1">{{ $destination->id }}</td>
                    <td class="border px-2 py-1">{{ $destination->name }}</td>
                    <td class="border px-2 py-1">{{ $destination->location }}</td>
                    <td class="border px-2 py-1">{{ $destination->category }}</td>
                    <td class="border px-2 py-1">
                        <a href="{{ route('admin.destinations.edit', $destination) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Delete this destination?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $destinations->links() }}
        </div>
    </div>
</x-app-layout>
