<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Your Admin Management page content here -->
                <h1 class="text-2xl font-bold mb-4">Manage Destinations</h1>

                <a href="{{ route('admin.destinations.create') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded">
                    Add Destination
                </a>

                <!-- Example: Destination table -->
                <table class="w-full mt-6 border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">City</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($destinations as $destination)
                            <tr>
                                <td class="border px-4 py-2">{{ $destination->id }}</td>
                                <td class="border px-4 py-2">{{ $destination->name }}</td>
                                <td class="border px-4 py-2">{{ $destination->location }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.destinations.edit', $destination->id) }}" 
                                       class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('admin.destinations.destroy', $destination->id) }}" 
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure?')" 
                                                class="text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
