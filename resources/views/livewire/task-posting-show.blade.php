<div class="max-w-lg mx-auto mt-8 bg-white p-6 rounded-lg shadow">
    <!-- Posted on -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $task->title }}</h1>
        <p class="text-gray-700">Posted {{ $task->created_at->diffForHumans() }}</p>
    </div>

    <div class="flex flex-wrap mb-4 tag-container">
        @foreach ($task->tags as $tag)
            <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
        @endforeach
    </div>

    <!-- Task information -->
    <div class="mb-4">
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">RM {{ $task->salary }}</p>
        </div>
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">{{ $task->location }}</p>
        </div>
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/user-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">{{ $task->user->username }}</p>
        </div>
        <div class="flex items-center mb-2">
            <img src="{{ asset('svg/time-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
            <p class="text-gray-700">{{ $task->availability }}</p>
        </div>

        <div class="flex items-center mt-4">
            <p class="text-gray-700">
                <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}
            </p>
        </div>
    </div>    
    
    <!-- Apply Button and Bookmark Button -->
    <div class="flex justify-start items-center space-x-4 mb-4">
        @if (auth()->check())
            @if (!$task->isExpired())
                @php
                    $existingApplication = auth()->user()->applications()->where('task_id', $task->id)->count() > 0;
                @endphp
                @if ($existingApplication)
                    <p class="text-green-500">You already applied to this task</p>
                @elseif (auth()->user()->id !== $task->user_id)
                    <button wire:click="apply" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Apply</button>
                @else
                    <button wire:click="dispatch('redirectToTaskPostingPage')" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">View My Tasks</button>
                @endif
            @else
                <p class="text-red-500">Task expired. Applications are no longer accepted.</p>
            @endif
        @endif
                
        <button wire:click="toggleBookmark({{ $task->id }})" class="flex items-center justify-center bg-transparent hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-full">
            @if(in_array($task->id, $savedTaskIds))
                <img src="{{ asset('svg/save-icon-filled.svg') }}" alt="Saved Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                <span>Saved</span>
            @else
                <img src="{{ asset('svg/save-icon.svg') }}" alt="Save Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                <span>Save</span>
            @endif
        </button>
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
