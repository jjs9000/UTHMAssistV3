<div>
    <!-- Success message -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.414l2.93-2.93-2.931-2.929a1 1 0 111.415-1.414L10 8.586l2.93-2.93a1 1 0 111.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("This is the task page") }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/2 p-4">
            <div class="grid grid-cols-1 gap-4">
                @if ($postedTasks->isEmpty())
                    <p class="text-center">No task posted found.</p>
                @else
                    @foreach ($postedTasks as $task)
                        <div class="bg-gray-500 rounded-lg shadow-md">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                <p class="text-gray-700">Posted on {{ $task->created_at->format('M d, Y') }}</p>
                                @foreach($task->tags as $tag)
                                    <div class="mb-4 tag-container">
                                        <span class="inline-block bg-white text-yellow px-2 py-1 rounded-full text-xs font-semibold">{{ $tag->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-end space-x-4 p-2">
                                <div>
                                    <x-primary-button wire:click="editTask({{ $task->id }})">Edit</x-primary-button>
                                </div>
                                <div>
                                    <x-danger-button wire:click="deleteTask({{ $task->id }})" wire:confirm='Are you sure you want to delete this post?'>Delete Task</x-danger-button>
                                </div>
                            </div>                            
                        </div>
                    @endforeach
                </div>
                <div class="mt-2 mb-12 p-2">
                    {{ $postedTasks->links() }}
                </div>
                @endif
        </div>
        
        <div class="w-1/2 p-4">
            <div class="bg-gray-500 shadow-md rounded-lg p-6">
                <div class="flex flex-col">
                    @if ($editTaskId)
                        {{-- Update form --}}
                        <livewire:task-posting-create :task="$editTaskDetails" :key="'edit-' . $editTaskId" />
                        <div class="flex items-center justify-end mt-4" wire:click="cancelEdit">
                            <x-primary-button class="bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </x-primary-button>
                        </div>
                    @else
                        {{-- Task creation form --}}
                        <livewire:task-posting-create />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
