<!-- resources/views/admin/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="mb-6">Welcome, Admin!</p>

        <a href="{{ route('admin.create') }}"
           class="bg-black-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Admin
        </a>
        <a href="{{ route('destinations.index') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700">
            Listed Destinations
        </a>

        <a href="{{ route('admin.hotels.index') }}"
            class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Manage Hotels
        </a>

    </div>
</x-app-layout>