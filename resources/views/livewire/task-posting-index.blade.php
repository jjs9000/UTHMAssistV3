<div>    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <livewire:search-box/>
                </div>
            </div>
        </div>
    </div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Task postings -->
    <div>
        @if($noTasksAvailable)
        <div class="rounded-lg p-6 text-center">
            <p class="text-gray-900 text-lg font-semibold">No task posted found.</p>
        </div>
        @else
        <div class="p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                @foreach($taskPostings as $taskPosting)
                    <div class="relative">
                        <!-- Save icon button positioned at the top right corner -->
                        <button class="absolute top-0 right-0 mt-2 mr-2">
                            <img src="{{ asset('svg/save-icon.svg') }}" alt="Save Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                        </button>
                        <!-- Task list card content -->
                        <div wire:click="showTask({{ $taskPosting->id }})" class="bg-white p-4 shadow rounded-lg cursor-pointer hover:border-2 border-gray-900 shadow-md">
                            <h2 class="text-xl font-semibold">{{ $taskPosting->title }}</h2>
                            <div class="flex items-center">
                                <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                                <p class="text-gray-700">{{ $taskPosting->location }}</p>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('svg/salary-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                                <p class="text-gray-700">RM {{ $taskPosting->salary }}</p>
                            </div>
                            <div class="flex items-center">
                                <img src="{{ asset('svg/user-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                                <p class="text-gray-700">{{ $taskPosting->user->username }}</p>
                            </div>
                            <!-- Add more task details here if needed -->
                        </div>
                    </div>
                    @endforeach
                </div>            
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $taskPostings->links() }}
                </div>
        </div>
        @endif
    </div>


    <!-- Task Show -->
    <div>
        @if ($selectedTask)
            <div class="p-4">
                <!-- Display other task details here -->
                <div class="container mx-auto">
                    <div class="bg-white border-2 border-gray-900 p-6 rounded-lg shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-3xl font-semibold">{{ $selectedTask->title }}</h1>
                            {{-- Expand Icon --}}
                            <div>
                                <a href="{{ route('task-posting.show', ['id' => $selectedTask->id]) }}" target="_blank">
                                    <img src="{{ asset('svg/expand-icon.svg') }}" alt="Expand Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                </a>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 mb-4">
                            @if(auth()->user()->id == $selectedTask->user->id)
                                You posted {{ $selectedTask->created_at->diffForHumans() }}
                            @else
                                Posted {{ $selectedTask->created_at->diffForHumans() }}
                            @endif
                        </p>
                        
                        <!-- Display tag with random color -->
                        <div class="flex flex-wrap mb-4 tag-container">
                            @foreach($selectedTask->tags as $tag)
                                <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        
                        <div class="flex items-center">
                            <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                            <p class="text-gray-700">{{ $selectedTask->location }}</p>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
                            <p class="text-gray-700">RM {{ $selectedTask->salary }}</p>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('svg/user-icon.svg') }}" alt="User Icon" class="h-6 w-6 mr-2">
                            <p class="text-gray-700">{{ $selectedTask->user->username }}</p>
                        </div>
                        
                        <!-- Add other task details as needed -->
                        <div class="mt-4">
                            <h2 class="text-xl font-semibold mb-2">Description</h2>
                            <p class="text-gray-700">{{ $selectedTask->description }}</p>
                        </div>
                        <div class="flex items-center mt-4">
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
                                        <button wire:click="dispatch('apply')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Apply</button>
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
                                    <p class="font-semibold">Task expired. Applications are no longer accepted.</p>
                                @endif
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
        @else
            <!-- Placeholder content when no task is selected -->
            <div class="bg-white mt-4 p-4 rounded-lg shadow flex flex-col items-center">
                <h1 class="text-2xl font-bold text-gray-700 mb-4">Select a task to view its details.</h1>
                <img src="{{ asset('svg/job-illustration.svg') }}" alt="Job Illustration" class="w-1/2 h-auto">
            </div>
        @endif
    </div>    
</div>
</div>
