<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
        Are you sure you want to delete this tag?
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        Once the tag is deleted, all of the data will be permanently removed.
    </p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="$dispatch('closeModal')">
            Cancel
        </x-secondary-button>
        <x-danger-button class="ml-3" wire:click="deleteTag">
            Delete
        </x-danger-button>
    </div>
</div>
