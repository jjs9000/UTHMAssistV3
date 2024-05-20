<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
        Are you sure you want to unsave this task?
    </h2>

    <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="closeModal">
            Cancel
        </x-secondary-button>
        <x-danger-button class="ml-3" wire:click="unsaveTask">
            Unsave
        </x-danger-button>
    </div>
</div>
