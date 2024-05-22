<div>
    <div class="py-4 mx-auto max-w-2xl justify-items-center">
        <h2 class="text-3xl font-semibold">Saved Task</h2>
    </div>
    @if ($noBookmarkAvailable)
        <div class="flex flex-col rounded-lg p-6 text-center justify-center items-center">
            <p class="text-gray-900 text-xl font-semibold">Your saved task will appear here.</p>
                <img src="{{ asset('svg/illustration/bookmark-page.svg') }}" alt="Job Illustration" class="w-64 h-auto">
        </div>
    @else
    <div class="py-4 mx-auto max-w-2xl justify-items-center">
        @foreach ($bookmarks as $bookmark)
            <div class="relative">
                <!-- Options icon button positioned at the top right corner -->
                <div class="absolute top-0 right-0 mt-2 mr-2">
                    <button onclick="toggleDropdown()" class="relative">
                        <img src="{{ asset('svg/option-icon.svg') }}" alt="Options Icon" class="w-6 h-6 hover:cursor-pointer hover:bg-gray-200 hover:rounded-full">
                    </button>
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="#" wire:click.prevent="$dispatch('openModal', { component: 'bookmark.unsave-confirmation-modal', arguments: { taskId: {{ $bookmark->taskPosting->id }} } })" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Unsave</a>
                    </div>
                </div>
                <!-- Task list card content -->
                <a href="{{ route('task-posting.show', ['id' => $bookmark->taskPosting->id]) }}" target="_blank" class="bg-white flex flex-col gap-0 p-4 mb-4 rounded-lg cursor-pointer hover:ring ring-gray-900 shadow-md">
                    <h2 class="text-xl font-semibold">{{ $bookmark->taskPosting->title }}</h2>
                    <div class="flex items-center">
                        <img src="{{ asset('svg/location-icon.svg') }}" alt="Location Icon" class="h-6 w-6 mr-2">
                        <p class="text-gray-700">{{ $bookmark->taskPosting->location }}</p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('svg/salary-icon.svg') }}" alt="Salary Icon" class="h-6 w-6 mr-2">
                        <p class="text-gray-700">RM {{ $bookmark->taskPosting->salary }}</p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('svg/user-icon.svg') }}" alt="User Icon" class="h-6 w-6 mr-2">
                        <p class="text-gray-700">{{ $bookmark->taskPosting->user->username }}</p>
                    </div>
                    <div class="flex items-center">
                        @foreach ($bookmark->taskPosting->tags as $tag)
                            <span class="inline-block bg-gray-900 text-white px-2 py-1 rounded-full text-xs font-semibold mr-2 mb-2">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </a>
            </div>
        @endforeach
    </div>
        <div class="pb-12 max-w-2xl mx-auto justify-items-center">
            {{ $bookmarks->links() }}
        </div>
    @endif
<div>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('hidden');
    }
</script>
