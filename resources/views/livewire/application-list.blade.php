<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("This is the application page") }}
            </div>
        </div>
    </div>

    <div class="mt-8 max-w-3xl mx-auto">
        <h1 class="text-2xl text-gray-100 font-semibold mb-4">Applied Tasks</h1>

        @if ($applications->isEmpty())
        <div class="bg-gray-500 shadow-md rounded-lg p-6 text-center">
            <p class="text-lg font-semibold">No application found</p>
        </div>
        @else
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($applications as $application)
                    <li class="py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg text-gray-100 font-semibold">{{ $application->task->title }}</h2>
                                <p class="text-gray-100 dark:text-gray-400">{{ $application->message }}</p>
                            </div>
                            <div>
                                <span class="px-2 py-1 text-sm font-semibold {{ $application->status === 'accepted' ? 'bg-green-500 text-white' : 'bg-blue-500 text-white' }} rounded">{{ ucfirst($application->status) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
