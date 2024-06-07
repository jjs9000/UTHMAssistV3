<div>
    <div class="flex flex-wrap justify-center gap-6 mt-6">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center w-48">
            <img src="{{ asset('svg/user-icon-filled.svg') }}" alt="User Icon" class="w-12 h-12 mb-4">
            <span class="text-lg font-bold">{{ $totalUsers }}</span>
            <p class="text-gray-600">Users</p>
        </div>

        <!-- Total Applications Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center w-48">
            <img src="{{ asset('svg/application-icon.svg') }}" alt="Application Icon" class="w-12 h-12 mb-4">
            <span class="text-lg font-bold">{{ $totalApplications }}</span>
            <p class="text-gray-600">Applications</p>
        </div>

        <!-- Total Tags Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center w-48">
            <img src="{{ asset('svg/tag-icon.svg') }}" alt="Tag Icon" class="w-12 h-12 mb-4">
            <span class="text-lg font-bold">{{ $totalTags }}</span>
            <p class="text-gray-600">Tags</p>
        </div>

        <!-- Total Task Postings Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center w-48">
            <img src="{{ asset('svg/task-icon.svg') }}" alt="Task Icon" class="w-12 h-12 mb-4">
            <span class="text-lg font-bold">{{ $totalTaskPostings }}</span>
            <p class="text-gray-600">Task Posts</p>
        </div>

        <!-- Total Feedback & Reviews Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center w-48">
            <img src="{{ asset('svg/feedback-icon.svg') }}" alt="Feedback Icon" class="w-12 h-12 mb-4">
            <span class="text-lg font-bold">{{ $totalFeedbackReviews }}</span>
            <p class="text-gray-600">Ratings</p>
        </div>
    </div>

    <div class="mt-6 flex flex-row gap-0">
        <div class="w-full sm:w-1/2">
            <div class="p-4 justify-center m-14">
                <livewire:admin.dashboard.chart.user-growth-chart />
            </div>
        </div>
        <div class="w-full sm:w-1/2">
            <div class="p-4 m-14">
                <livewire:admin.dashboard.chart.task-completion-chart />
            </div>
        </div>
    </div>       
</div>
