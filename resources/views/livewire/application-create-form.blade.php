<div class="max-w-3xl mx-auto p-6 mt-20 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Apply for Task: {{ $taskPosting->title }}</h1>

    <form wire:submit.prevent="submit" class="space-y-6">
        @csrf
        <input type="hidden" wire:model="taskPosting" name="taskPosting" value="{{ $taskPosting->id }}">

        <!-- Application Message -->
        <div>
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Application Message (Optional):</label>
            <textarea id="message" wire:model="message" rows="4" cols="50" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400" placeholder="Enter your application message (Optional)"></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Apply</button>
    </form>
</div>
