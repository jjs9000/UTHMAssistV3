<div>
    <h1>Apply for Task: {{ $taskPosting->title }}</h1>

    <form wire:submit.prevent="submit">
        @csrf
        <input type="hidden" wire:model="taskPosting" name="taskPosting" value="{{ $taskPosting->id }}">

        <!-- Application Message -->
        <div class="mb-4">
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Application Message (Optional):</label>
            <textarea id="message" wire:model.defer="message" rows="4" cols="50" class="border rounded w-full py-2 px-3" placeholder="Enter your application message (Optional)"></textarea>
            @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply</button>
    </form>
</div>
