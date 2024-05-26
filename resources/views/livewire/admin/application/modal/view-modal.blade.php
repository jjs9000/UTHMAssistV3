<div class="max-w-lg mx-auto mt-8 p-6 rounded-lg bg-white shadow-lg relative">
    <!-- Close button at top right corner -->
    <button class="absolute top-4 right-4" wire:click="closeModal">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="h-6 w-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>

    <!-- Application task title -->
    <div class="flex justify-center items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $application->task->title }}</h1>
    </div>

    <!-- Application information -->
    <div class="mb-4">       
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Applicant:</strong> {{ $application->user->username }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Application created:</strong> {{ $application->created_at->diffForHumans() }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Message:</strong> {{ $application->message }}</p>
        </div>

        <div class="flex items-center mb-2">
            <p class="text-gray-700"><strong>Application status:</strong>
                <span class="px-2 py-1 rounded text-md font-semibold text-white {{ $application->status == 'accepted' ? 'bg-green-500' : ($application->status == 'rejected' ? 'bg-red-500' : 'bg-blue-500') }}">
                    {{ ucfirst($application->status) }}
                </span>
            </p>
        </div>
        
        @if ($application->status === 'rejected')
        <div class="flex flex-col items-start mb-2">
            <p class="text-gray-700"><strong>Reason:</strong>
        </div>
        
        <x-textarea-input class="text-gray-700 inline-block w-full border-2 border-gray-900" readonly>{{ $application->reject_reason }}</x-textarea-input>
        @endif
    </div>

</div>
