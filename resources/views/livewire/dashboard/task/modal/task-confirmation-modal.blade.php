<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
        Are you sure you want to set the task to complete?
    </h2>

    <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            Cancel
        </x-secondary-button>
        <x-primary-button class="ml-3" wire:click="completeTask">
            Complete
        </x-primary-button>
    </div>
</div>
