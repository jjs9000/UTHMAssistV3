<div>
    <div>
        <nav class="z-20 flex shrink-0 grow-0 justify-around gap-4 border-t border-gray-200 bg-white/50 p-2.5 shadow-lg backdrop-blur-lg fixed top-2/4 -translate-y-2/4 left-6 min-h-[auto] min-w-[64px] flex-col rounded-lg border">
            <button wire:click="dispatch('showUserTable')" class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 transition-colors duration-300 ease-in-out hover:bg-indigo-100 focus:outline-none focus:bg-indigo-100 @if($showUserTable) bg-indigo-100 @endif">
                <img src="{{ asset('svg/table-icon.svg') }}" alt="User Table Icon" class="w-6 h-6 shrink-0">
                <small class="text-center text-xs font-medium">User Table</small>
            </button>
            <button wire:click="dispatch('showAddUserForm')" class="flex aspect-square min-h-[32px] w-16 flex-col items-center justify-center gap-1 rounded-md p-1.5 transition-colors duration-300 ease-in-out hover:bg-indigo-100 focus:outline-none focus:bg-indigo-100 @unless($showUserTable) bg-indigo-100 @endif">
                <img src="{{ asset('svg/add-user-icon.svg') }}" alt="Add User Icon" class="w-6 h-6 shrink-0">
                <small class="text-center text-xs font-medium">Add User</small>
            </button>
        </nav>
    </div>

    <div class="mt-10 ml-28">
        @if($showUserTable)
            <livewire:user-table />
        @else
            <livewire:admin-add-user-form />
        @endif
    </div>
</div>

