<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Task postings -->
    <div>
        @if($noTasksAvailable)
            <p>No task postings available.</p>
        @else
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                @foreach($taskPostings as $taskPosting)
                    <div>
                        <div wire:click="showTask({{ $taskPosting->id }})" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:shadow-md">
                            <h2 class="text-xl font-semibold">{{ $taskPosting->title }}</h2>
                            <p class="text-gray-700">Salary: RM {{ $taskPosting->salary }}</p>
                            <p class="text-gray-700">Posted by: {{ $taskPosting->user->username }}</p>
                            <!-- Add more task details here if needed -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Task Show -->
    <div>
        @if ($selectedTask)
            <div class="bg-white p-4 rounded-lg shadow">
                <!-- Display other task details here -->
                <div class="container mx-auto mt-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h1 class="text-3xl font-semibold mb-4">{{ $selectedTask->title }}</h1>
                        
                        <p class="text-gray-700 mb-4">
                            @if(auth()->user()->id == $selectedTask->user->id)
                                Posted by you on {{ $selectedTask->created_at->format('Y-m-d') }}
                            @else
                                Posted by: {{ $selectedTask->user->username }}
                            @endif
                        </p>
                        
                
                        <!-- Display tag with random color -->
                        @foreach($selectedTask->tags as $tag)
                        <div class="mb-4 tag-container">
                            <span class="inline-block bg-gray-300 text-white px-2 py-1 rounded-full text-xs font-semibold">{{ $tag->name }}</span>
                        </div>
                        @endforeach
                
                        
                        <p class="text-gray-700 mb-4">Salary: RM {{ $selectedTask->salary }}</p>
                        
                        <!-- Add other task details as needed -->
                
                        <div class="mt-4">
                            <h2 class="text-xl font-semibold mb-2">Description</h2>
                            <p class="text-gray-700">{{ $selectedTask->description }}</p>
                        </div>
                        <div class="flex items-center">
                            {{-- Apply Button --}}
                            @if (auth()->check())
                                @if (!$selectedTask->isExpired())
                                    @php
                                        $existingApplication = auth()->user()->applications()->where('task_id', $selectedTask->id)->count() > 0;
                                    @endphp
                                    @if ($existingApplication)
                                        <!-- User has already applied, display a message -->
                                        <p>You already applied to this task</p>
                                    @elseif (auth()->user()->id !== $selectedTask->user_id)
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
                        
                            {{-- Expand Icon --}}
                            <div class="ml-4">
                                <a href="{{ route('task-posting.show', ['id' => $selectedTask->id]) }}" target="_blank">
                                    <img src="{{ asset('svg/expand-icon.svg') }}" alt="Expand Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                </a>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
