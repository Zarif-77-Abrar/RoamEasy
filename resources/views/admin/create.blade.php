<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New Admin
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" required class="block w-full mt-1">
            </div>

            <div class="mt-4">
                <label>Email</label>
                <input type="email" name="email" required class="block w-full mt-1">
            </div>

            <div class="mt-4">
                <label>Password</label>
                <input type="password" name="password" required class="block w-full mt-1">
            </div>

            <div class="mt-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required class="block w-full mt-1">
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
