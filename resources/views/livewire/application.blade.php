<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("This is the application page") }}
            </div>
        </div>
    </div>

    <div>
        <h1>Applied Tasks</h1>
    
        @if ($applications->isEmpty())
            <p>No applications found.</p>
        @else
            <ul>
                @foreach ($applications as $application)
                    <li>{{ $application->task->title }} - {{ $application->created_at->diffForHumans() }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

