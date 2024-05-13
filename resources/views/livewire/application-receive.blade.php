<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 ">
                {{ __("Received Applications") }}
            </div>
        </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto">
        @if ($applications->isEmpty())
            <p class="text-gray-700 ">No applications received.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($applications as $application)
                    <li class="py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold">{{ $application->task->title }}</h2>
                                <p class="text-gray-600 ">{{ $application->user->name }} applied for this task.</p>
                            </div>
                            <div>
                                @if ($application->status === 'pending')
                                    <button wire:click="acceptApplication({{ $application->id }})" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">Accept</button>
                                    <button wire:click="rejectApplication({{ $application->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Reject</button>
                                @elseif ($application->status === 'accepted')
                                    <span class="px-2 py-1 text-sm font-semibold bg-green-500 text-white rounded">Accepted</span>
                                @elseif ($application->status === 'rejected')
                                    <span class="px-2 py-1 text-sm font-semibold bg-red-500 text-white rounded">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>

