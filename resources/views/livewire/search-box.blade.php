<div>
    <div class="flex flex-wrap justify-center items-center px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="relative w-full sm:w-auto lg:w-96">
            <!-- Adjusted input field -->
            <input wire:model.live.debounce.300ms="search" type="text" class="h-12 sm:h-16 w-full pr-8 pl-5 rounded-lg text-gray-900 bg-white z-0 hover:ring ring-gray-900 focus:shadow focus:outline-none" placeholder="Search anything...">
            
            <!-- Adjusted search icon -->
            <div class="absolute top-3 right-3 sm:top-4 sm:right-3">
                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
            </div>
        </div>

        <!-- Location Filter -->
        <div class="relative w-full sm:w-auto lg:w-96">
            <select wire:model.live.debounce.300ms="location" class="h-12 sm:h-16 w-full pl-3 pr-10 rounded-lg bg-white text-gray-900 z-0 hover:ring ring-gray-900 focus:shadow focus:outline-none">
                <option value="">All Locations</option>
                <option value="UTHM Parit Raja">UTHM Parit Raja</option>
                <option value="UTHM Pagoh">UTHM Pagoh</option>
            </select>
        </div>
    </div>
</div>