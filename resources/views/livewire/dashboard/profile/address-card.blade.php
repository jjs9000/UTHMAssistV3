<div class="w-full sm:w-3/4 md:w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900">Address Information</h2>
    <div class="mt-4 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-4">
            <div class="w-full sm:w-1/4">
                <label class="text-sm font-medium text-gray-700">Address</label>
            </div>
            <div class="flex items-center space-x-2 w-full">
                @if ($editingField === 'address')
                    <x-textarea-input wire:model="address" class="w-full h-24 border rounded-md p-2"></x-textarea-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                <textarea class="w-full h-24 p-2 hover:bg-gray-100 border-2 rounded-md overflow-hidden" readonly>{{ $address }}</textarea>
                    <button wire:click="startEditing('address')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-4">
            <div class="w-full sm:w-1/4">
                <label class="text-sm font-medium text-gray-700">State</label>
            </div>
            <div class="flex items-center space-x-2 w-full">
                @if ($editingField === 'state')
                    <x-text-input type="text" wire:model="state" class="border rounded-md p-2 w-full"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $state }}</span>
                    <button wire:click="startEditing('state')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-4">
            <div class="w-full sm:w-1/4">
                <label class="text-sm font-medium text-gray-700">City</label>
            </div>
            <div class="flex items-center space-x-2 w-full">
                @if ($editingField === 'city')
                    <x-text-input type="text" wire:model="city" class="border rounded-md p-2 w-full"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $city }}</span>
                    <button wire:click="startEditing('city')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-4">
            <div class="w-full sm:w-1/4">
                <label class="text-sm font-medium text-gray-700">Post Code</label>
            </div>
            <div class="flex items-center space-x-2 w-full">
                @if ($editingField === 'post_code')
                    <x-text-input type="text" wire:model="post_code" class="border rounded-md p-2 w-full"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $post_code }}</span>
                    <button wire:click="startEditing('post_code')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>