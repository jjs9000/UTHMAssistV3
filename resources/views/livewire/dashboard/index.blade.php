<div class="flex flex-col min-h-screen">
    <div class="flex-grow pb-16"> <!-- Added padding-bottom to provide space for the bottom navigation -->
        <div class="mt-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($showUserProfile)
                <livewire:dashboard.profile.index />
            @elseif($showUserTask)
                <livewire:dashboard.task.index />
            @elseif($showUserTimetable)
                <livewire:dashboard.timetable.timetable-manager />
            @endif
        </div>
    </div>

    <nav class="fixed bottom-4 left-1/2 transform -translate-x-1/2 w-full max-w-xs bg-white/50 border-t border-gray-200 shadow-lg backdrop-blur-lg p-2.5 flex justify-around gap-4 rounded-lg border">
        <button wire:click="$dispatch('showUserProfile')" class="flex items-center justify-center flex-col gap-1 min-h-[32px] w-16 rounded-md p-1.5 transition-colors duration-300 ease-in-out hover:bg-indigo-100 focus:outline-none focus:bg-indigo-100 @if($showUserProfile) bg-indigo-100 @endif">
            <img src="{{ asset('svg/user-icon-filled.svg') }}" alt="Profile Icon" class="w-6 h-6">
            <small class="text-xs font-medium">Profile</small>
        </button>
        <button wire:click="$dispatch('showUserTask')" class="flex items-center justify-center flex-col gap-1 min-h-[32px] w-16 rounded-md p-1.5 transition-colors duration-300 ease-in-out hover:bg-indigo-100 focus:outline-none focus:bg-indigo-100 @if($showUserTask) bg-indigo-100 @endif">
            <img src="{{ asset('svg/task-icon.svg') }}" alt="Task Icon" class="w-6 h-6">
            <small class="text-xs font-medium">Task</small>
        </button>
        <button wire:click="$dispatch('showUserTimetable')" class="flex items-center justify-center flex-col gap-1 min-h-[32px] w-16 rounded-md p-1.5 transition-colors duration-300 ease-in-out hover:bg-indigo-100 focus:outline-none focus:bg-indigo-100 @if($showUserTimetable) bg-indigo-100 @endif">
            <img src="{{ asset('svg/table-icon.svg') }}" alt="Timetable Icon" class="w-6 h-6">
            <small class="text-xs font-medium">Timetable</small>
        </button>
    </nav>
</div>