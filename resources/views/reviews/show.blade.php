<!-- resources/views/reviews/show.blade.php -->

<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            Reviews for {{ $destination->name }}
        </h1>

        <!-- Reviews List -->
        @forelse($reviews as $review)
            <div class="border-b py-3">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">{{ $review->user->name }}</span>
                    <span class="text-yellow-500">★ {{ $review->rating }}</span>
                </div>
                <p>{{ $review->comment }}</p>
                <small class="text-gray-500">
                    {{ $review->created_at->format('d M Y') }}
                </small>

                @if(auth()->user()->hasRole('admin'))
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" 
                          method="POST" class="mt-2">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="text-red-500 hover:underline"
                                onclick="return confirm('Delete this review?')">
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p>No reviews yet.</p>
        @endforelse

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>

        <!-- Tourist: Add review -->
        @if(auth()->user()->hasRole('tourist'))
            <div class="bg-gray-100 rounded p-4 mt-6">
                <h2 class="text-lg font-semibold mb-3">Add Your Review</h2>
                <form action="{{ route('reviews.store', $destination->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label>Rating (1-5):</label>
                        <input type="number" name="rating" min="1" max="5" required 
                               class="border p-2 rounded">
                    </div>
                    <div>
                        <label>Comment:</label>
                        <textarea name="comment" rows="3" required 
                                  class="border p-2 rounded w-full"></textarea>
                    </div>
                    <button type="submit" 
                            class="bg-green-500 text-black px-4 py-2 rounded">
                        Submit Review
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
