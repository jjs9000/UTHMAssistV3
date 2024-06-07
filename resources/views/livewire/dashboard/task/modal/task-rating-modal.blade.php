<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Rate Task</h2>
    
    <form wire:submit.prevent="submitRating">
        <div class="text-center flex items-center justify-center">
            @for($i = 1; $i <= 5; $i++)
                <svg wire:click="setRating({{ $i }})" class="star-icon text-gray-600 cursor-pointer mx-1" width="23" height="23" xmlns="http://www.w3.org/2000/svg" fill="#FFEA00" viewBox="0 0 24 24" stroke="currentColor">
                    @if($i <= $rating)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" fill="none"></path>
                    @endif
                </svg>
            @endfor
        </div>
        
        <div class="mb-4">
            <label for="comment" class="block text-gray-700">Comment</label>
            <x-textarea-input id="comment" wire:model="comment" class="mt-1 block w-full rounded-lg shadow-sm"></x-textarea-input>
        </div>
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Rating</button>
    </form>
</div>
