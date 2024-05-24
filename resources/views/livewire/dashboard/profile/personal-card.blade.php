<div class="w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
    <div class="mt-4 space-y-4">
        <div class="flex items-center justify-start space-x-4">
            <div class="w-32">
                <label class="text-sm font-medium text-gray-700">First Name</label>
            </div>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'first_name')
                    <x-text-input type="text" wire:model="first_name" class="border rounded-md p-2"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $first_name }}</span>
                    <button wire:click="startEditing('first_name')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-start space-x-4">
            <div class="w-32">
                <label class="text-sm font-medium text-gray-700">Last Name</label>
            </div>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'last_name')
                    <x-text-input type="text" wire:model="last_name" class="border rounded-md p-2"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $last_name }}</span>
                    <button wire:click="startEditing('last_name')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-start space-x-4">
            <div class="w-32">
                <label class="text-sm font-medium text-gray-700">IC</label>
            </div>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'ic')
                    <x-text-input type="text" wire:model="ic" class="border rounded-md p-2"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $ic }}</span>
                    <button wire:click="startEditing('ic')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-start space-x-4">
            <div class="w-32">
                <label class="text-sm font-medium text-gray-700">Contact Number</label>
            </div>
            <div class="flex items-center space-x-2">
                @if ($editingField === 'contact_number')
                    <x-text-input type="text" wire:model="contact_number" class="border rounded-md p-2"></x-text-input>
                    <button wire:click="save" class="text-blue-500 hover:text-blue-700">Save</button>
                @else
                    <span>{{ $contact_number }}</span>
                    <button wire:click="startEditing('contact_number')" class="text-gray-500 hover:text-gray-700">
                        <img src="{{ asset('svg/pencil-icon.svg') }}" alt="Edit" class="w-4 h-4">
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
