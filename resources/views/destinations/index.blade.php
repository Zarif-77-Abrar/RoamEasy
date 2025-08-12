<x-app-layout>

    <style>
        .favorite-btn {
            background: none;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .favorite-btn.favorited {
            color: gold;
            border-color: gold;
        }
    </style>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Destinations</h2>
    </x-slot>

    <div class="p-6">
        
        {{-- filter form --}}
        <form method="GET" action="{{ route('destinations.index') }}" class="mb-6">
            <select name="city">
                <option value="">-- Select City --</option>
                @foreach(($cities ?? collect()) as $city)
                    <option value="{{ $city }}" @selected(request('city') == $city)>{{ $city }}</option>
                @endforeach
            </select>

            <select name="category">
                <option value="">-- Select Category --</option>
                @foreach(($categories ?? collect()) as $category)
                    <option value="{{ $category }}" @selected(request('category') == $category)>{{ $category }}</option>
                @endforeach
            </select>

            <select name="min_rating">
                <option value="">-- Minimum Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @selected(request('min_rating') == $i)>{{ $i }} stars</option>
                @endfor
            </select>

            <button type="submit">Filter</button>
        </form>              
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @role('admin')
                <div class="mb-4">
                    <a href="{{ route('admin.destinations.manage') }}" class="btn btn-primary" style = "color:white">
                        Manage Destinations
                    </a>
                </div>
            @endrole

            @forelse ($destinations as $destination)
                <div class="bg-white p-4 shadow rounded">
                    <!-- Name -->
                    <h3 class="text-lg font-bold">{{ $destination->name }}</h3>

                    <!-- Location & Category -->
                    <p class="text-sm text-gray-600">
                        {{ $destination->location }} — {{ $destination->category }}
                    </p>

                    <p>Rating: {{ number_format($destination->average_rating, 1) ?? 'N/A' }}</p>

                    <!-- View Reviews Button -->
                    <a href="{{ route('reviews.showForDestination', $destination->id) }}" 
                    class="bg-blue-500 text-black px-3 py-1 rounded mt-3 inline-block">
                        View Reviews
                    </a>

                    <a href="{{ route('destinations.show', $destination->id) }}" 
                        class="bg-blue-600 text-black px-3 py-1 rounded mt-2 inline-block hover:bg-blue-700">
                        Details
                    </a>
                    {{-- {{ dd($destination) }} --}}
                    @role('tourist')
                        <button 
                            class="favorite-btn"
                            data-url="{{ route('favorites.toggle', $destination->id) }}"
                        >
                            {{ $destination->isFavoritedBy(auth()->user()) ? '★ Unfavorite' : '☆ Favorite' }}
                        </button>
                    @endrole
                </div>
            @empty
                <p>No destinations found.</p>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $destinations->withQueryString()->links() }}
        </div>
    </div>
    <script>
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const url = this.dataset.url;
        
                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'added') {
                        this.classList.add('favorited');
                        this.textContent = '★ Unfavorite';
                    } else {
                        this.classList.remove('favorited');
                        this.textContent = '☆ Favorite';
                    }
                });
            });
        });
    </script>
        
</x-app-layout>
