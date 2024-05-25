<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <x-text-input type="text" id="name" wire:model="name" name="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <x-text-input type="text" id="description" wire:model="description" name="description" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>

        <x-primary-button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Add Tag
        </x-primary-button>
    </form>
</div>
