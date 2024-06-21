<div class="py-12">
    <div class="mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl text-gray-900 font-semibold mb-4">Task List</h1>

        <!-- Sort By -->
        <div class="flex justify-between mb-4">
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
            <p class="text-lg font-semibold text-gray-700">No ongoing tasks</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full shadow-md table-auto w-full hidden sm:table">
                <thead class="bg-white border-2 border-gray-900">
                    <tr>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Task</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Applicant</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-2 border-gray-900 divide-y divide-gray-900">
                    @foreach ($applications as $application)
                    @if ($application->task->status === 'ongoing')
                    <tr>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->title }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->user->username }}</td>
                        <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->status }}</td>
                        <td class="py-4 px-6 text-sm text-center">
                            @if (auth()->id() === $application->task->user_id)
                                @if ($application->task->status === 'completed')
                                    <button class="bg-green-500 text-white px-4 py-2 rounded" disabled>Completed</button>
                                @else
                                    <button wire:click="$dispatch('openModal', { component: 'dashboard.task.modal.task-confirmation-modal', arguments: { applicationId: {{ $application->id }} } })" class="bg-blue-500 text-white px-4 py-2 rounded">Complete</button>
                                @endif
                            @else
                                @if ($application->task->status === 'completed')
                                    <button class="bg-green-500 text-white px-4 py-2 rounded" disabled>Completed</button>
                                @else
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded" disabled>Ongoing</button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Cards for mobile view -->
            <div class="sm:hidden space-y-4">
                @foreach ($applications as $application)
                @if ($application->task->status === 'ongoing')
                <div class="bg-white shadow-md rounded-lg p-4 border-2 border-gray-900">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $application->task->title }}</h2>
                    <p class="mt-2 text-sm text-gray-900">{{ $application->user->username }}</p>
                    <p class="mt-2 text-sm text-gray-900">Status: {{ $application->task->status }}</p>
                    <div class="mt-4 flex space-x-2">
                        @if (auth()->id() === $application->task->user_id)
                            @if ($application->task->status === 'completed')
                                <button class="bg-green-500 text-white px-4 py-2 rounded" disabled>Completed</button>
                            @else
                                <button wire:click="$dispatch('openModal', { component: 'dashboard.task.modal.task-confirmation-modal', arguments: { applicationId: {{ $application->id }} } })" class="bg-blue-500 text-white px-4 py-2 rounded">Complete</button>
                            @endif
                        @else
                            @if ($application->task->status === 'completed')
                                <button class="bg-green-500 text-white px-4 py-2 rounded" disabled>Completed</button>
                            @else
                                <button class="bg-blue-500 text-white px-4 py-2 rounded" disabled>Ongoing</button>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>