<div>
    <!-- Success message -->
    @if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.414l2.93-2.93-2.931-2.929a1 1 0 111.415-1.414L10 8.586l2.93-2.93a1 1 0 111.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
            </svg>
        </span>
    </div>
    @endif

    <div class="mt-10 pb-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="relative bg-white rounded-lg shadow-md overflow-hidden">
                <form wire:submit.prevent="createTask" class="p-6 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input wire:model="title" id="title" class="mt-1 block w-full" type="text" name="title"/>
                        </div>
                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <select wire:model="location" id="location" name="location" class="mt-1 block border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Location</option>
                                <option value="UTHM Parit Raja">UTHM Parit Raja</option>
                                <option value="UTHM Pagoh">UTHM Pagoh</option>
                            </select>
                            <x-input-error :messages="$errors->get('location')" class="text-red-500" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input wire:model="description" id="description" class="mt-1 block w-full" name="description" />
                        </div>
                        <div>
                            <x-input-label for="requirement" :value="__('Requirement')" />
                            <x-textarea-input wire:model="requirement" id="requirement" class="mt-1 block w-full" name="requirement" />
                        </div>

                        <div>
                            <x-input-label for="availability" :value="__('Availability')" />
                            <x-text-input wire:model="availability" id="availability" class="block mt-1 w-full" type="text" name="availability" />
                        </div>

                        <div class="relative">
                            <x-input-label for="salary" :value="__('Salary')" />
                            <div class="flex items-center">
                                <span class="absolute left-3 text-gray-700">RM</span>
                                <x-text-input wire:model="salary" id="salary" class="pl-10 mt-1 block w-full" type="text" name="salary" oninput="formatSalary(this)" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select wire:model="status" id="status" name="status" class="mt-1 block border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Status</option>
                                <option value="available">Available</option>
                                <option value="not_available">Not Available</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="text-red-500" />
                        </div>

                        <div>
                            <x-input-label for="deadline" :value="__('Deadline')" />
                            <x-text-input wire:model="deadline" id="deadline" class="mt-1 block w-full" type="date" name="deadline" />
                        </div>
                        
                        <div>
                            <x-input-label for="location_detail" :value="__('Location Detail')" />
                            <x-textarea-input wire:model="location_detail" id="location_detail" class="mt-1 block w-full" name="location_detail" />
                        </div>

                        <div>
                            <x-input-label for="tags" :value="__('Tags')" />
                            <select wire:model="selectedTags" name="tags[]" id="tags" multiple class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('selectedTags')" class="text-red-500" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button class="bg-gray-500 text-white rounded hover:bg-gray-600">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
