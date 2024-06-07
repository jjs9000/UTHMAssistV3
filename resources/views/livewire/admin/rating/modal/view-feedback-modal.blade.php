<div class="max-w-lg mx-auto mt-8 p-6 rounded-lg bg-white shadow-lg relative">
    <!-- Close button at top right corner -->
    <button class="absolute top-4 right-4" wire:click="closeFeedbackModal">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="h-6 w-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>

    <!-- Feedback information -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold">Feedback Details</h1>
    </div>

    <!-- Feedback information -->
    <div class="mb-4">
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Feedback ID:</strong> {{ $feedback->id }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Task ID:</strong> {{ $feedback->task_id }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>User ID:</strong> {{ $feedback->user_id }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Rating:</strong> {{ $feedback->rating }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Comment:</strong> {{ $feedback->comment }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Created At:</strong> {{ $feedback->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Updated At:</strong> {{ $feedback->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</div>
