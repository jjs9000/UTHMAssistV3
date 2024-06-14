<div class="max-w-md mx-auto px-0">
    <h2 class="text-3xl text-center font-semibold mb-6">Task Posting Form</h2>

    <form wire:submit.prevent="createTask" class="rounded px-0 pt-6 pb-0">
        @csrf

        <div class="mb-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="title" id="title" class="mt-1 block w-full" type="text" name="title"/>
        </div>
        
        <div class="mb-4">
            <x-input-label for="location" :value="__('Location')" />
            <select wire:model="location" id="location" name="location" class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Select Location</option>
                <option value="UTHM Parit Raja">UTHM Parit Raja</option>
                <option value="UTHM Pagoh">UTHM Pagoh</option>
            </select>
            <x-input-error :messages="$errors->get('location')" class="text-red-500" />
        </div>

        <div class="mb-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input wire:model="description" id="description" class="mt-1 block w-full" name="description" />
        </div>

        <div class="mb-4">
            <x-input-label for="requirement" :value="__('Requirement')" />
            <x-textarea-input wire:model="requirement" id="requirement" class="mt-1 block w-full" name="requirement" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label for="availability" :value="__('Availability')" />
                <x-text-input wire:model="availability" id="availability" class="block mt-1 w-full" type="text" name="availability" />
            </div>
            <div class="mb-4 relative">
                <x-input-label for="salary" :value="__('Salary')" />
                <div class="flex items-center">
                    <span class="absolute left-3 text-gray-700">RM</span>
                    <x-text-input wire:model="salary" id="salary" class="pl-10 mt-1 block w-full" type="text" name="salary" oninput="formatSalary(this)" />
                </div>
            </div>
        </div>

        <div class="mb-4">
            <x-input-label for="location_detail" :value="__('Location Detail')" />
            <x-textarea-input wire:model="location_detail" id="location_detail" class="mt-1 block w-full" name="location_detail" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-input-label for="deadline" :value="__('Deadline')" />
                <x-text-input wire:model="deadline" id="deadline" class="mt-1 block w-full" type="date" name="deadline" />
            </div>

            <div class="mb-4">
                <x-input-label for="status" :value="__('Status')" />
                <select wire:model="status" id="status" name="status" class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Status</option>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="text-red-500" />
            </div>
        </div>

        <div class="mb-4">
            <x-input-label for="tags" :value="__('Tags')" />
            <select wire:model="selectedTags" name="tags[]" id="tags" multiple class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('selectedTags')" class="text-red-500" />
        </div>

        <div class="flex items-center justify-end">
            <button class="w-full bg-gray-900 text-white py-2 px-4 md:px-6 rounded-lg text-base md:text-lg font-semibold hover:cursor-pointer hover:bg-gray-700">
                Submit
            </button>
        </div>
    </form>
</div>

<script>
    function formatSalary(input) {
        let value = input.value.replace(/[^0-9.]/g, '');
        
        if (value.includes('.')) {
            let parts = value.split('.');
            parts[0] = parts[0].slice(0, 7); // Limit integer part length
            parts[1] = parts[1].slice(0, 2); // Limit decimal part length
            value = parts.join('.');
        } else {
            value = value.slice(0, 7); // Limit integer part length if no decimal
        }
        
        input.value = value;
    }

    document.getElementById('salary').addEventListener('blur', function() {
        let value = parseFloat(this.value);
        if (!isNaN(value)) {
            this.value = value.toFixed(2);
        }
    });
</script>