<div>
    <div class="flex justify-center items-center px-4 sm:px-6 lg:px-8">
        <div class="relative">
            <!-- Adjusted input field -->
            <input wire:model.live.debounce.300ms="search" type="text" class="h-16 w-96 pr-8 pl-5 rounded-lg text-gray-900 bg-gray-100 z-0 focus:shadow focus:outline-none" placeholder="Search anything...">
            
            <!-- Adjusted search icon -->
            <div class="absolute top-4 right-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
        </div>
    </div>
</div>
