<div class="w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900 mb-4">Profile Information</h2>
    <div class="flex items-center space-x-10">
        <div class="w-48 h-48">
            @if($user->gender === 'male')
                <img src="{{ asset('svg/avatar/male.svg') }}" alt="Male Avatar" class="w-full h-full object-cover rounded-full">
            @else
                <img src="{{ asset('svg/avatar/female.svg') }}" alt="Female Avatar" class="w-full h-full object-cover rounded-full">
            @endif
        </div>
        <div class="flex-1">
            <div class="flex items-center">
                <p class="text-3xl font-semibold">{{ $user->first_name }} {{ $user->last_name }}</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('svg/username-icon.svg') }}" alt="Username Icon" class="w-5 h-5 mr-2">
                <p class="text-gray-600 text-md font-medium">{{ $user->username }}</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('svg/gender-icon.svg') }}" alt="Gender Icon" class="w-5 h-5 mr-2">
                <p class="text-gray-600 text-md font-medium">{{ $user->gender }}</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('svg/email-icon.svg') }}" alt="Email Icon" class="w-5 h-5 mr-2">
                <p class="text-gray-600 text-md font-medium">{{ $user->email }}</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('svg/birth-icon.svg') }}" alt="Birthday Icon" class="w-5 h-5 mr-2">
                <p class="text-gray-600 text-md font-medium">{{ $formattedDateOfBirth }}</p>
            </div>
        </div>
    </div>
</div>

