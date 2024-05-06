<div>
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <!-- Display other task information here -->

    {{-- Apply Button --}}
    @if (auth()->check())
        @if (!$task->isExpired())
            @php
                $existingApplication = auth()->user()->applications()->where('task_id', $task->id)->count() > 0;
            @endphp
            @if ($existingApplication)
                <!-- User has already applied, display a message -->
                <p>You already applied to this task</p>
            @elseif (auth()->user()->id !== $task->user_id)
                <!-- User is not the original poster, display "Apply" button -->
                <button wire:click="apply" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Apply</button>
            @else
            <!-- User is the original poster, display a button to redirect to their task-posting page -->
            <button 
            wire:click="dispatch('redirectToTaskPostingPage')" 
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            View My Tasks
            </button>
            @endif
        @else
            <!-- Task is expired, display a message -->
            <p>Task expired. Applications are no longer accepted.</p>
        @endif
    @endif
</div>
