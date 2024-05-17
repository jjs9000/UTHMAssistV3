<div class="max-w-lg mx-auto mt-8 p-6 rounded-lg bg-white shadow-lg relative">
    <!-- Close button at top right corner -->
    <button class="absolute top-4 right-4" wire:click="closeTaskModal">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="h-6 w-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>

    <!-- Posted on -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $task->title }}</h1>
    </div>

    <!-- Task information -->
    <div class="mb-4">
        <div class="flex items-center mb-2">
            <p class="px-2 py-1 rounded text-md font-semibold mr-2 mb-2 text-white inline-block {{ $task->status == 'available' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $task->status }}
            </p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Posted:</strong> {{ $task->created_at->diffForHumans() }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Updated:</strong> {{ $task->updated_at->diffForHumans() }}</p>
        </div>
        <div class="flex items-center mb-2">
            <p class="text-gray-700 inline-block"><strong>Deadline:</strong> {{ $task->deadline }}</p>
        </div>
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">RM {{ $task->salary }}</p>
        </div>
        <div class="flex items-center">
            <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">{{ $task->location }}</p>
        </div>
    </div>
    
    <div class="flex flex-wrap mb-4 tag-container">
        @foreach($task->tags as $tag)
            <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
        @endforeach
    </div>

    <!-- Location Detail -->
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Location</h2>
        <p class="text-gray-700">{{ $task->location_detail }}</p>
    </div>

    <!-- Description -->
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Description</h2>
        <p class="text-gray-700">{{ $task->description }}</p>
    </div>

    <!-- Requirement -->
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Requirement</h2>
        <p class="text-gray-700">{{ $task->requirement }}</p>
    </div>
</div>
