<div class="w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900">Address Information</h2>
    <div class="mt-4 space-y-4">
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-700">Address</label>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'address')
                    <textarea wire:model="address" class="border rounded-md p-2"></textarea>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $address }}</span>
                    <button wire:click="startEditing('address')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-700">State</label>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'state')
                    <input type="text" wire:model="state" class="border rounded-md p-2">
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $state }}</span>
                    <button wire:click="startEditing('state')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-700">City</label>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'city')
                    <input type="text" wire:model="city" class="border rounded-md p-2">
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $city }}</span>
                    <button wire:click="startEditing('city')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-700">Post Code</label>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'post_code')
                    <input type="text" wire:model="post_code" class="border rounded-md p-2">
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
