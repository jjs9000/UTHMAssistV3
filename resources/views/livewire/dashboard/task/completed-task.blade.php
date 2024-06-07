<div class="py-12">
    <div class="mt-8 max-w-7xl mx-auto">
        <h1 class="text-2xl text-gray-900 font-semibold mb-4">Completed Tasks</h1>

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

        <div class="overflow-x-auto">
            <table class="min-w-full shadow-md">
                <thead class="bg-white border-2 border-gray-900">
                    <tr>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Task</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Applicant</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-6 text-left text-md font-semibold text-gray-700">Review/Rate</th>
                    </tr>
                </thead>
                <tbody class="bg-white border-2 border-gray-900 divide-y divide-gray-900">
                    @forelse ($applications as $application)
                        <tr>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->title }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $application->user->username }}</td>
                            <td class="py-4 px-6 text-sm text-gray-900">{{ $application->task->status }}</td>
                            <td class="py-4 px-6 text-sm">
                                @if (auth()->id() === $application->task->user_id)
                                <div>
                                    <button wire:click="$dispatch('openModal', { component: 'dashboard.task.modal.view-task-rating-modal', arguments: { taskId: {{ $application->task->id }} } })">
                                        <img src="{{ asset('svg/view-icon.svg') }}" alt="View Reviews" class="w-6 h-6">
                                    </button>
                                </div>
                                @elseif (auth()->id() === $application->user_id)
                                <!-- Applicant can rate the task -->
                                @php
                                    $userFeedback = \App\Models\Feedback::where('task_id', $application->task_id)
                                        ->where('user_id', auth()->id())
                                        ->first();
                                @endphp
                                @if ($userFeedback)
                                    <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Rated</button>
                                @else
                                    <button wire:click="$dispatch('openModal', { component: 'dashboard.task.modal.task-rating-modal', arguments: { taskId: {{ $application->task->id }} } })" class="bg-blue-500 text-white px-4 py-2 rounded">Rate Task</button>
                                @endif
                            @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">No completed tasks</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>