<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Confirm Action</h2>
    <p class="mb-4">Are you sure you want to {{ $actionType }} this application?</p>
    <div class="flex justify-end space-x-4">
        <button wire:click="closeModal" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
        @if ($actionType === 'accept')
            <button wire:click="acceptApplication" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accept</button>
        @elseif ($actionType === 'reject')
            <button wire:click="rejectApplication" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
        @endif
    </div>
</div>
