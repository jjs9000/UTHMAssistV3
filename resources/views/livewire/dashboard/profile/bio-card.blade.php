<div class="w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900">Bio</h2>
    <div class="mt-4">
        @if ($isEditing)
            <x-textarea-input wire:model="bio" class="w-full h-48 p-2 border rounded-md shadow-sm"></x-textarea-input>
            <div class="flex justify-end mt-2">
                <button wire:click="saveBio" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600">
                    Save
                </button>
            </div>
        @else
            <textarea class="w-full h-48 p-2 hover:bg-gray-100 border-2 rounded-md overflow-hidden" readonly>{{ $bio }}</textarea>
            <div class="flex justify-end mt-2">
                <button wire:click="editBio" class="px-4 py-2 bg-gray-500 text-white rounded-md shadow-sm hover:bg-gray-600">
                    Edit
                </button>
            </div>
        @endif
    </div>
</div>

