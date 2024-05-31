<div class="p-6 relative">
    <div class="mx-auto max-w-md">
        <!-- Close button -->
        <button class="absolute top-2 right-2" wire:click="$dispatch('closeModal')">
            <img src="{{ asset('svg/close-icon.svg') }}" alt="Close" class="w-6 h-6">
        </button>

        <h2 class="text-lg font-semibold mb-4">Report User</h2>
        <form wire:submit.prevent="submitReport">
            <div class="mb-4">
                <label for="reason" class="block font-medium text-gray-700">Reason:</label>
                <select wire:model.defer="reason" id="reason" name="reason" class="block w-full mt-1 form-select rounded-lg">
                    <option value="">Select Reason</option>
                    <option value="spam">Spam</option>
                    <option value="inappropriate_content">Inappropriate Content</option>
                    <option value="harassment">Harassment</option>
                </select>
                <x-input-error :messages="$errors->get('reason')" class="text-red-500" />
            </div>
            <div class="mb-4">
                <label for="additional_reason" class="block font-medium text-gray-700">Additional reason (optional):</label>
                <textarea wire:model.defer="additionalReason" id="additional_reason" name="additional_reason" rows="3" class="block w-full mt-1 form-textarea rounded-lg"></textarea>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-[#D22B2B] text-white rounded-lg shadow hover:transition duration-300 ease-in-out transform hover:scale-110">Submit Report</button>
            </div>
        </form>
    </div>
</div>
