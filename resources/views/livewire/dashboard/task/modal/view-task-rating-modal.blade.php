<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Task Reviews</h2>
    
    @if ($feedbacks->isNotEmpty())
        @foreach ($feedbacks as $feedback)
            <div class="mb-4 p-4 bg-white shadow rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">{{ $feedback->task->title }}</h3>
                <p class="text-sm text-gray-600">Rated by: {{ $feedback->user->username }}</p>
                <p class="text-sm text-gray-600">Rating: 
                    @for ($i = 0; $i < $feedback->rating; $i++)
                        <span class="text-yellow-500">&#9733;</span>
                    @endfor
                </p>
                <p class="text-sm text-gray-600">{{ $feedback->comment }}</p>
            </div>
        @endforeach
    @else
        <p class="text-gray-700">No reviews yet.</p>
    @endif
</div>
