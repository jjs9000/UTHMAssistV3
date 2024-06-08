<div class="p-6 relative bg-white rounded-lg shadow-md max-w-lg mx-auto">
    <!-- Close button -->
    <button wire:click="closeModal" class="absolute top-0 right-0 mt-2 mr-2">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>
    <h2 class="text-center text-2xl font-semibold mb-4 text-gray-800">{{ $application->task->title }}</h2>

    <!-- Message Card -->
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <h3 class="text-xl font-semibold mb-2">Message</h3>
        <div class="flex items-center text-gray-700">
            {{ $application->message ?: 'No message provided.' }}
        </div>
    </div>

    <!-- Status Card -->
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <h3 class="text-xl font-semibold mb-2">Status</h3>
        <div class="flex items-center text-gray-700">
            <p class="px-2 py-1 text-sm font-semibold 
                @if($application->status === 'accepted') bg-green-500 text-white
                @elseif($application->status === 'rejected') bg-red-500 text-white
                @else bg-blue-500 text-white
                @endif
                rounded">
                {{ ucfirst($application->status) }}
            </p>
        </div>
    </div>

    <!-- Display if rejected -->
    @if ($application->status === 'rejected')
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <h3 class="text-xl font-semibold mb-2">Reason</h3>
        <div class="flex items-center text-gray-700">
            {{ $application->reject_reason ?: 'No reason provided.' }}
        </div>
    </div>
    @endif
</div>