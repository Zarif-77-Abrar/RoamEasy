<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>Welcome to your dashboard!</p>
            <a href="{{ route('destinations.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-block hover:bg-blue-700">
                Browse Destinations
            </a>
        </div>
    </div>
</x-app-layout>


