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
            <span>★★★★☆</span>
        </div>
        <p class="text-gray-900 text-xl mt-2">4.5/5</p> <!-- Hard coded rating -->
    </div>

    <!-- Feedback Card -->
    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-md">
        <label class="block font-medium text-gray-700 mb-2">Feedback:</label>
        <ul class="space-y-4">
            <li class="flex items-start space-x-4">
                <img src="{{ asset('images/default-profile.png') }}" alt="John Doe" class="w-8 h-8 rounded-full">
                <div>
                    <p class="text-gray-900">Great user, very cooperative! - John Doe</p>
                    <div class="flex items-center text-yellow-500">
                        <span>★★★★☆</span>
                    </div>
                </div>
            </li>
            <li class="flex items-start space-x-4">
                <img src="{{ asset('images/default-profile.png') }}" alt="Jane Smith" class="w-8 h-8 rounded-full">
                <div>
                    <p class="text-gray-900">Prompt responses and very polite. - Jane Smith</p>
                    <div class="flex items-center text-yellow-500">
                        <span>★★★★★</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Report Button -->
    <div class="mt-6">
        <button wire:click="$dispatch('openModal', { component: 'user.report.report-user-modal', arguments: { userId: {{ $user->id }} } })" class="text-white bg-red-500 hover:bg-red-700 font-medium py-2 px-4 rounded">
            Report User
        </button>
    </div>
</div>
