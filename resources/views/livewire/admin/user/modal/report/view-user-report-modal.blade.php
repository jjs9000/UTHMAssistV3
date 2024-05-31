<div class="p-6 bg-white rounded-lg shadow-lg max-w-2xl mx-auto">
    <!-- Close button container -->
    <div class="absolute top-0 right-0 mt-2 mr-2">
        <button wire:click="$dispatch('closeModal')" class="text-gray-800 hover:text-gray-600 focus:outline-none">
            <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="h-6 w-6">
        </button>
    </div>

    <h2 class="text-2xl font-semibold mb-4">User Reports</h2>

    <div class="overflow-y-auto max-h-96">
        @forelse ($reports as $report)
            <div class="p-4 mb-4 bg-gray-100 rounded-lg">
                <p><strong>Reason:</strong> {{ ucfirst(str_replace('_', ' ', $report->reason)) }}</p>
                <p><strong>Additional Reason:</strong> {{ $report->additional_reason ?? 'N/A' }}</p>
                <p><strong>Reported At:</strong> {{ $report->created_at->format('d F Y, h:i A') }}</p>
            </div>
        @empty
            <p class="text-gray-500">No reports found for this user.</p>
        @endforelse
    </div>
</div>