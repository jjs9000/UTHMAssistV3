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

    <div class="flex">
        <div class="w-1/2 p-4">
                @if ($postedTasks->isEmpty())
                    <div class="bg-gray-500 shadow-md rounded-lg p-6 text-center">
                        <p class="text-lg font-semibold">No task posted found.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($postedTasks as $task)
                            <div class="bg-white border rounded-lg shadow-md">
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                    <p class="text-gray-700 absolute top-4 right-4"><strong>Posted</strong> {{ $task->created_at->diffForHumans() }}</p>
                                    <div class="flex items-center mt-2">
                                        <p class="px-2 py-1 rounded text-md font-semibold text-white inline-block {{ $task->status == 'available' ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ $task->status == 'available' ? 'Available' : 'Not Available' }}
                                        </p>
                                    </div>                                    
                                </div>                                
                                <div class="flex justify-end space-x-4 p-2">
                                    <div>
                                        <button wire:click="$dispatch('openModal', { component: 'view-task-modal', arguments: { taskId: {{ $task->id }} }})">
                                            <img src="{{ asset('svg/view-icon.svg') }}" alt="View Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                        </button>
                                    </div>
                                    <div>
                                        <button wire:click="editTask({{ $task->id }})">
                                            <img src="{{ asset('svg/edit-icon.svg') }}" alt="Edit Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                        </button>
                                    </div>
                                    <div>
                                        <button wire:click="deleteTask({{ $task->id }})" wire:confirm='Are you sure you want to delete this post?'>
                                            <img src="{{ asset('svg/delete-icon.svg') }}" alt="Delete Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                                        </button>
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
            <div class="bg-white border shadow-md rounded-lg p-6">
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
