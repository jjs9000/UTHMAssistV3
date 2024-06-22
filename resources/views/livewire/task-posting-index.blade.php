<div>
    <div class="pt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg">
                <div class="p-6 sm:p-8 lg:p-10">
                    <livewire:search-box />
                </div>
            </div>
        </div>
    </div>

    <!-- Task postings -->
    <div>
        @if ($noTasksAvailable)
            <div class="rounded-lg p-6 text-center">
                <p class="text-gray-900 text-lg font-semibold">No task posted found.</p>
            </div>
        @else
            <div class="flex justify-center">
                <div class="p-4 max-w-screen-lg mx-auto">
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-700"><strong>{{ $taskPostings->total() }}</strong> tasks</p>
                            </div>
                            <div>
                                <label for="sort" class="text-gray-700 font-semibold">Sort by:</label>
                                <select id="sort" wire:model.live.debounce.300ms="sortBy" class="ml-2 rounded-lg shadow-sm">
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="salary_high">Highest Salary</option>
                                    <option value="salary_low">Lowest Salary</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
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
                                    <!-- Task list card content wrapped in an anchor tag -->
                                    <a href="{{ route('task-posting.show', ['id' => $taskPosting->id]) }}" class="block">
                                        <div class="bg-white flex flex-col gap-0 p-8 pr-8 rounded-lg cursor-pointer hover:ring ring-gray-900 shadow-md h-80 w-80 mx-auto">
                                            <h2 class="text-xl font-semibold mb-2">{{ $taskPosting->title }}</h2>
                                            <div class="flex items-center mb-2">
                                                <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                                                <p class="text-gray-700">{{ $taskPosting->location }}</p>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
                                                <p class="text-gray-700">RM {{ $taskPosting->salary }}</p>
                                            </div>
                                            <div class="flex items-center mb-2">
                                                <img src="{{ asset('svg/user-icon.svg') }}" alt="User Icon" class="h-6 w-6 mr-2">
                                                <p class="text-gray-700">{{ $taskPosting->user->username }}</p>
                                            </div>
                                            <div class="flex items-center mt-2 mb-4">
                                                @foreach ($taskPosting->tags as $tag)
                                                    <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                            <div class="flex justify-between items-center mt-auto">
                                                <div>
                                                    <a href="{{ route('user.profile', ['id' => $taskPosting->user->id]) }}" target="_blank" class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-500">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-8">
                        {{ $taskPostings->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
