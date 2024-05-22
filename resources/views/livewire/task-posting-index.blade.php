<div>
    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <livewire:search-box />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Task postings -->
        <div>
            <div class="">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="ml-48 text-gray-700"><strong>{{ $taskPostings->total() }} tasks</strong></p>
                    </div>
                    <div>
                        <label for="sort" class="text-gray-700 font-semibold">Sort by:</label>
                        <select id="sort" wire:model.live.debounce.300ms="sortBy" class="ml-2 mr-10 rounded-lg shadow-sm">
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
                            <option value="salary_high">Highest Salary</option>
                            <option value="salary_low">Lowest Salary</option>
                        </select>
                    </div>
                </div>
            </div>

            @if ($noTasksAvailable)
                <div class="rounded-lg p-6 text-center">
                    <p class="text-gray-900 text-lg font-semibold">No task posted found.</p>
                </div>
            @else
                <div class="p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                        @foreach ($taskPostings as $taskPosting)
                            <div class="relative">
                                <!-- Save icon button positioned at the top right corner -->
                                <button wire:click="toggleBookmark({{ $taskPosting->id }})" class="absolute top-0 right-0 mt-2 mr-2">
                                    @if(in_array($taskPosting->id, $savedTaskIds))
                                        <img src="{{ asset('svg/save-icon-filled.svg') }}" alt="Saved Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                    @else
                                        <img src="{{ asset('svg/save-icon.svg') }}" alt="Save Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                    @endif
                                </button>
                                <!-- Task list card content -->
                                <div wire:click="showTask({{ $taskPosting->id }})" class="bg-white flex flex-col gap-0 ml-40 p-4 rounded-lg cursor-pointer hover:ring ring-gray-900 shadow-md">
                                        <h2 class="text-xl font-semibold">{{ $taskPosting->title }}</h2>
                                        <div class="flex items-center">
                                            <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                                            <p class="text-gray-700">{{ $taskPosting->location }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
                                            <p class="text-gray-700">RM {{ $taskPosting->salary }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            <img src="{{ asset('svg/user-icon.svg') }}" alt="User Icon" class="h-6 w-6 mr-2">
                                            <p class="text-gray-700">{{ $taskPosting->user->username }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            @foreach ($taskPosting->tags as $tag)
                                                <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="ml-40 mt-8">
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
                        <div class="bg-white mt-10 mr-40 border p-6 rounded-lg shadow">
                            <div class="flex justify-between items-center mb-4">
                                <h1 class="text-3xl font-semibold">{{ $selectedTask->title }}</h1>
                                <!-- Expand Icon -->
                                <div>
                                    <a href="{{ route('task-posting.show', ['id' => $selectedTask->id]) }}" target="_blank">
                                        <img src="{{ asset('svg/expand-icon.svg') }}" alt="Expand Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                    </a>
                                </div>
                            </div>

                            <p class="text-gray-700 mb-4">
                                    <strong>Posted</strong> {{ $selectedTask->created_at->diffForHumans() }}
                            </p>

                            <!-- Display tag with random color -->
                            <div class="flex flex-wrap mb-4 tag-container">
                                @foreach ($selectedTask->tags as $tag)
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
                            <div class="flex items-center">
                                <img src="{{ asset('svg/time-icon.svg') }}" alt="User Icon" class="h-6 w-6 mr-2">
                                <p class="text-gray-700">{{ $selectedTask->availability }}</p>
                            </div>
                            <div class="flex items-center mt-4">
                                <p class="text-gray-700">
                                    <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($selectedTask->deadline)->format('d-m-Y') }}
                                </p>
                            </div>                            

                            <div class="mt-4">
                                <h2 class="text-xl font-semibold mb-2">Description</h2>
                                <p class="text-gray-700">{{ $selectedTask->description }}</p>
                            </div>
                            <div class="flex items-center mt-4">
                                <!-- Apply Button -->
                                @if (auth()->check() && !$selectedTask->isExpired())
                                    @php
                                        $existingApplication = auth()->user()->applications()->where('task_id', $selectedTask->id)->count() > 0;
                                    @endphp
                                    @if ($existingApplication)
                                        <!-- User has already applied, display a message -->
                                        <p class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm">You already applied to this task</p>
                                    @else
                                        <button class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-500">
                                            <a href="{{ route('task-posting.show', ['id' => $selectedTask->id]) }}" target="_blank">Click here to apply!</a>
                                        </button>
                                    @endif
                                @endif
                            </div>                            
                        </div>
                    </div>
                </div>
            @else
                <!-- Placeholder content when no task is selected -->
                <div class="container mx-auto">
                    <div class="mr-20 mt-14 py-20 h-screen flex flex-col items-center">
                        <h1 class="text-2xl font-bold text-gray-700 mb-4">Select a task to view its details.</h1>
                        <img src="{{ asset('svg/illustration/job-1.svg') }}" alt="Job Illustration" class="w-1/2 h-auto">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
