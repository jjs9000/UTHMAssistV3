<div class="p-6 relative">
    <button wire:click="closeModal" class="absolute top-0 right-0 mt-2 mr-2">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>
    <h2 class="text-lg font-semibold mb-4">{{ $application->task->title }}</h2>

    <div class="mb-4">
        <p class="text-gray-700"><strong>Message:</strong> {{ $application->message }}</p>
    </div>

    <div>
        <p class="px-2 py-1 text-sm font-semibold 
            @if($application->status === 'accepted') bg-green-500 text-white
            @elseif($application->status === 'rejected') bg-red-500 text-white
            @else bg-blue-500 text-white
            @endif
            rounded">
            <strong>Status:</strong> {{ ucfirst($application->status) }}
        </p>
    </div>
</div>
