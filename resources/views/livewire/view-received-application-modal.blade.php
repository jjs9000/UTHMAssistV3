<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Close button -->
    <button wire:click='closeModal' class="absolute top-0 right-0 mt-4 mr-4">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="w-6 h-6">
    </button>

    <!-- Modal content -->
    <h2 class="text-lg font-semibold">{{ $application->task->title }}</h2>
    <p class="text-gray-700">Applicant: {{ $application->user->username }}</p>
    <p class="text-gray-700">Applicant Full Name: {{ $application->user->first_name }} {{ $application->user->last_name }}</p>
    <p class="text-gray-700">Message: {{ $application->message }}</p>
</div>

