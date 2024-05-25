<div class="relative bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto">
    <!-- Close button -->
    <button wire:click='closeModal' class="absolute top-0 right-0 mt-4 mr-4">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="w-6 h-6">
    </button>

    <!-- Modal content -->
    <div class="flex flex-col items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $application->task->title }}</h2>
    </div>

    <!-- Applicant Details Card -->
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <h3 class="text-xl font-semibold mb-2">Applicant Details</h3>
        <div class="grid grid-cols-1 gap-2 text-gray-700">
            <p class="flex items-center">
                <img src="{{ asset('svg/user-icon.svg') }}" alt="User Icon" class="w-5 h-5 mr-2">
                {{ $application->user->first_name }} {{ $application->user->last_name }}
            </p>
            <p class="flex items-center">
                <img src="{{ asset('svg/username-icon.svg') }}" alt="Username Icon" class="w-5 h-5 mr-2">
                {{ $application->user->username }}
            </p>
            <p class="flex items-center">
                <img src="{{ asset('svg/email-icon.svg') }}" alt="Email Icon" class="w-5 h-5 mr-2">
                {{ $application->user->email }}
            </p>
            <p class="flex items-center">
                <img src="{{ asset('svg/gender-icon.svg') }}" alt="Gender Icon" class="w-5 h-5 mr-2">
                {{ $application->user->gender }}
            </p>
            <p class="flex items-center">
                <img src="{{ asset('svg/phone-icon.svg') }}" alt="Phone Icon" class="w-5 h-5 mr-2">
                {{ $application->user->contact_number }}
            </p>
        </div>
    </div>

    <!-- Message Card -->
    <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <h3 class="text-xl font-semibold mb-2">Message</h3>
        <p class="text-gray-700">{{ $application->message }}</p>
    </div>

    <div class="bg-gray-100 p-4 rounded-lg">
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
</div>
