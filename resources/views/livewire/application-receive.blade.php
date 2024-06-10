<div class="py-12">
    <div class="mt-8 max-w-7xl mx-auto">
        <h1 class="text-2xl text-gray-900 font-semibold mb-4">Received Applications</h1>

        <div class="flex justify-between mb-4">
            <!-- Sort By -->
            <div>
                <label for="sort" class="text-gray-700 font-semibold">Sort by:</label>
                <select id="sort" wire:model.live.debounce.300ms="sortBy" class="ml-2 rounded-lg shadow-sm">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>

        @if ($applications->isEmpty())
        <div class="p-6 text-center">
            <p class="text-lg font-semibold text-gray-700">No application found</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full shadow-md">
                <thead class="bg-white border-2 border-gray-900">
                    <tr>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Task Title</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Applicant</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Action</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700"></th>
                    </tr>
                </thead>
                <tbody class="bg-white border-2 border-gray-900 divide-y divide-gray-900">
                    @foreach ($applications as $application)
                    <tr>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->title }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->user->username }}</td>
                        <td class="py-4 px-6 text-sm">
                        @if ($application->status === 'pending')
                            <button wire:click="$dispatch('openModal', { component: 'user.application.modal.application-confirmation-modal', arguments: { applicationId: {{ $application->id }}, actionType: 'accept' }})" wire:loading.attr="disabled" wire:target="acceptApplication" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">
                                Accept
                            </button>
                            <button wire:click="$dispatch('openModal', { component: 'user.application.modal.application-confirmation-modal', arguments: { applicationId: {{ $application->id }}, actionType: 'reject' }})" wire:loading.attr="disabled" wire:target="rejectApplication" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Reject
                            </button>
                        @elseif ($application->status === 'accepted')
                            <button disabled class="bg-green-500 text-white px-4 py-2 rounded mr-2">
                                Accepted
                            </button>
                        @elseif ($application->status === 'rejected')
                            <button disabled class="bg-red-500 text-white px-4 py-2 rounded">
                                Rejected
                            </button>
                        @endif
                                                     
                        </td>
                        <td class="py-4 px-6 text-sm text-center">
                            <button wire:click="$dispatch('openModal', { component: 'view-received-application-modal', arguments: { application: {{ $application->id }} } })">
                                <img src="{{ asset('svg/view-icon.svg') }}" alt="View" class="w-6 h-6">
                            </button>
                            @if ($application->status === 'accepted')
                            <button wire:click="$dispatch('openModal', { component: 'user.application.modal.task-poster-chat-modal', arguments: { applicationId: {{ $application->id }} } })">
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
