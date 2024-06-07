<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <!-- User Profile Header -->
    <div class="flex items-center mb-6">
        @if ($user->gender === 'male')
        <img src="{{ asset('svg/avatar/male.svg') }}" alt="Profile Picture" class="w-24 h-24 rounded-full mr-4">
        @else
        <img src="{{ asset('svg/avatar/female.svg') }}" alt="Profile Picture" class="w-24 h-24 rounded-full mr-4">
        @endif
        <h1 class="text-3xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
    </div>

    <!-- User Details Card -->
    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
        <!-- Username -->
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/user-icon-filled.svg') }}" alt="User Icon" class="w-6 h-6 mr-2">
            <p class="text-gray-900">{{ $user->username }}</p>
        </div>

        <!-- Gender -->
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/gender-icon.svg') }}" alt="Gender Icon" class="w-6 h-6 mr-2">
            <p class="text-gray-900">{{ ucfirst($user->gender) }}</p>
        </div>

        <!-- Email -->
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/email-icon.svg') }}" alt="Email Icon" class="w-6 h-6 mr-2">
            <p class="text-gray-900">{{ $user->email }}</p>
        </div>

        <!-- Date of Birth -->
        <div class="flex items-center mb-6">
            <img src="{{ asset('svg/birth-icon.svg') }}" alt="Birthday Icon" class="w-5 h-5 mr-2">
            <p class="text-gray-600 text-md font-medium">{{ $formattedDateOfBirth }}</p>
        </div>

        <!-- Bio -->
        <div>
            <label class="block font-semibold text-lg text-gray-700 mb-2">Bio:</label>
            <textarea class="w-full bg-gray-100 text-gray-900 border-2 border-gray-900 rounded-lg p-2" rows="3" readonly>{{ $user->bio ?? 'No bio available' }}</textarea>
        </div>
    </div>

    <!-- Rating Card -->
    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md text-center">
        <label class="block font-medium text-gray-700 mb-2">Rating:</label>
        <div class="flex justify-center items-center text-4xl text-yellow-500">
            @for ($i = 0; $i < round($averageRating); $i++)
                <span>★</span>
            @endfor
            @for ($i = round($averageRating); $i < 5; $i++)
                <span>☆</span>
            @endfor
        </div>
        <p class="text-gray-900 text-xl mt-2">{{ $averageRating }}/5</p>
    </div>    

    <!-- Feedback Card -->
    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2">Feedback:</h2>
        @if ($feedbacks->isEmpty())
            <p>No feedback available.</p>
        @else
            <ul class="space-y-4">
                @foreach ($feedbacks as $feedback)
                    <li class="flex items-start space-x-4 border-2 border-gray-300 p-4 rounded-lg shadow-md">
                        <p class="text-gray-900 font-semibold text-md">{{ $feedback->user->username }}</p>
                        <div>
                            <p class="text-gray-900">{{ $feedback->comment }}</p>
                            <div class="flex items-center text-yellow-500">
                                <span>{{ str_repeat('★', $feedback->rating) }}{{ str_repeat('☆', 5 - $feedback->rating) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Report Button -->
    <div class="mt-6">
        <button wire:click="$dispatch('openModal', { component: 'user.report.report-user-modal', arguments: { userId: {{ $user->id }} } })" class="text-white bg-red-500 hover:bg-red-700 font-medium py-2 px-4 rounded">
            Report User
        </button>
    </div>
</div>
