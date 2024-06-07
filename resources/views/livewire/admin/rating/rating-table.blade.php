<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Search Input -->
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                placeholder="Search" required>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sortable-th', ['name' => 'id', 'displayName' => 'Feedback ID'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'task_id', 'displayName' => 'Rated For'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'user_id', 'displayName' => 'Rated By'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'rating', 'displayName' => 'Rating'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'comment', 'displayName' => 'Comment'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'created_at', 'displayName' => 'Created At'])
                                @include('livewire.includes.table-sortable-th', ['name' => 'updated_at', 'displayName' => 'Updated At'])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr wire:key="{{ $feedback->id }}" class="border-b group">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $feedback->id }}
                                </td>
                                <td class="px-4 py-3">{{ $feedback->task->user->username }}</td>
                                <td class="px-4 py-3">{{ $feedback->user->username }}</td>
                                <td class="px-4 py-3">{{ $feedback->rating }}</td>
                                <td class="px-4 py-3">{{ $feedback->comment }}</td>
                                <td class="px-4 py-3">{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-4 py-3">{{ $feedback->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                    <button wire:click="$dispatch('openModal', { component: 'admin.rating.modal.view-feedback-modal', arguments: { feedbackId: {{ $feedback->id }} }})" class="px-3 py-1 hover:bg-gray-100 text-white rounded flex items-center justify-center">
                                        <img src="{{ asset('svg/view-icon.svg') }}" alt="View Icon" class="h-6 w-6">
                                    </button>
                                    <button wire:click="$dispatch('openModal', { component: 'admin.rating.modal.delete-confirmation-modal', arguments: { feedbackId: {{ $feedback->id }} }})" class="px-3 py-1 hover:bg-gray-100 text-white rounded flex items-center justify-center">
                                        <img src="{{ asset('svg/delete-icon.svg') }}" alt="Delete Icon" class="h-6 w-6">
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="14" class="px-4 py-3 text-center text-gray-900 text-lg font-semibold">
                                    No feedbacks found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="py-4 px-3">
                    <div class="flex">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select
                                wire:model.live='perPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </section>
</div>