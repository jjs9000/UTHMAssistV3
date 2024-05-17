<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-3xl text-center font-semibold mb-4">Task Posting Form</h2>

    <form wire:submit.prevent="createTask" class="mx-auto">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input wire:model.defer="title" id="title" class="block mt-1 w-full" type="text" name="title" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-500" />
            </div>

            <div class="mb-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea-input wire:model.defer="description" id="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description" required></x-textarea-input>
                <x-input-error :messages="$errors->get('description')" class="mt-2 text-red-500" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label for="requirement" :value="__('Requirement')" />
                <x-textarea-input wire:model.defer="requirement" id="requirement" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="requirement" required></x-textarea-input>
                <x-input-error :messages="$errors->get('requirement')" class="mt-2 text-red-500" />
            </div>

            <div class="mb-4">
                <x-input-label for="salary" :value="__('Salary')" />
                <x-text-input wire:model.defer="salary" id="salary" class="block mt-1 w-full" type="text" name="salary" required />
                <x-input-error :messages="$errors->get('salary')" class="mt-2 text-red-500" />
            </div>                
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input wire:model.defer="location" id="location" class="block mt-1 w-full" type="text" name="location" required />
                <x-input-error :messages="$errors->get('location')" class="mt-2 text-red-500" />
            </div>

            <div class="mb-4">
                <x-input-label for="deadline" :value="__('Deadline')" />
                <x-text-input wire:model.defer="deadline" id="deadline" class="block mt-1 w-full" type="date" name="deadline" required />
                <x-input-error :messages="$errors->get('deadline')" class="mt-2 text-red-500" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="tags" :value="__('Tags')" />
            <select wire:model="selectedTags" name="tags[]" id="tags" multiple class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('selectedTags')" class="mt-2 text-red-500" />
        </div>
        

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-gray-500 text-white rounded hover:bg-gray-600">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</div>
