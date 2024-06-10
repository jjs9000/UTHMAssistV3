<div class="py-12">
    <div class="mt-8 max-w-7xl mx-auto">
        <h1 class="text-2xl text-gray-900 font-semibold mb-4">Applied Tasks</h1>

        <div class="flex justify-between mb-4">
            <!-- Sort By -->
            <div>
                <label for="sort" class="text-gray-700 font-semibold">Sort by:</label>
                <select id="sort" wire:model.live.debounce.300ms="sortBy" class="ml-2 rounded-lg shadow-sm">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>

            <!-- Filter by Status -->
            <div>
                <label for="task-status" class="text-gray-700 font-semibold">Task Status:</label>
                <select id="task-status" wire:model.live.debounce.300ms="taskStatus" class="ml-2 rounded-lg shadow-sm">
                    <option value="">All</option>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>
            </div>

            <!-- Filter by Application Status -->
            <div>
                <label for="application-status" class="text-gray-700 font-semibold">Application Status:</label>
                <select id="application-status" wire:model.live.debounce.300ms="applicationStatus" class="ml-2 rounded-lg shadow-sm">
                    <option value="">All</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>

        @if ($applications->isEmpty())
        <div class="p-6 text-center">
            <p class="text-lg font-semibold text-gray-700">No application found</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full shadow-md table-auto overflow-scroll">
                <thead class="bg-white border-2 border-gray-900">
                    <tr>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Task Title</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Message</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-2 border-gray-900 divide-y divide-gray-900">
                    @foreach ($applications as $application)
                    <tr>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->title }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->message ?: 'No message provided.' }}</td>
                        <td class="py-4 px-6 text-sm">
                            <span class="px-2 py-1 text-sm font-semibold {{ $application->status === 'accepted' ? 'bg-green-500 text-white' : ($application->status === 'rejected' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white') }} rounded">{{ ucfirst($application->status) }}</span>
                        </td>
                        <td class="py-4 px-6 text-sm text-center">
                            <button wire:click="$dispatch('openModal', { component: 'view-my-application-modal', arguments: { applicationId: {{ $application->id }} } })">
                                <img src="{{ asset('svg/view-icon.svg') }}" alt="View Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                            </button>
                            @if ($application->status === 'accepted') 
                            <button wire:click="$dispatch('openModal', { component: 'user.application.modal.applicant-chat-modal', arguments: { applicationId: {{ $application->id }} } })">
                                <img src="{{ asset('svg/chat-icon-filled.svg') }}" alt="Chat Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
                            </button>
                            @endif                                                     
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>
