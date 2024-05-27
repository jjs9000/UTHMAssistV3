<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
        @if($action === 'suspend')
            Are you sure you want to suspend this user?
        @else
            Are you sure you want to unsuspend this user?
        @endif
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        @if($action === 'suspend')
            Once the user is suspended, access to their account will be permanently removed.
        @else
            Once the user is unsuspended, they will regain access to their account.
        @endif
    </p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            Cancel
        </x-secondary-button>
        <x-danger-button class="ml-3" wire:click="suspendOrUnsuspendUser">
            @if($action === 'suspend')
                Suspend
            @else
                Unsuspend
            @endif
        </x-danger-button>
    </div>
</div>

