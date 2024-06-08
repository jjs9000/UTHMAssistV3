<div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full relative">
    <!-- Close button -->
    <button wire:click="closeModal" class="absolute top-0 right-0 mt-2 mr-2">
        <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="w-6 h-6 hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">
    </button>

    @if ($hasName)
        <h2 class="text-2xl font-semibold text-center mb-4">Start Messaging</h2>
        @if ($isTaskPosterConnected)
            <p class="font-semibold bg-gray-900 text-white text-center border-2 rounded-lg shadow-md mb-4 p-4">{{ $taskPosterName }} is connected to chat <img src="{{ asset('svg/circle-online-icon.svg') }}" alt="Online" class="w-4 h-4 inline-block"></p>
        @else
            <p class="font-semibold bg-gray-900 text-white text-center border-2 rounded-lg shadow-md mb-4 p-4">User is not connected to chat <img src="{{ asset('svg/circle-offline-icon.svg') }}" alt="Online" class="w-4 h-4 inline-block"></p>
        @endif
        <div class="mb-4">
            <p class="text-gray-700">Your name is already set to: <strong>{{ $userName }}</strong></p>
        </div>
        <button wire:click="redirectToMessages" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Go to Messages</button>
    @else
        <h2 class="text-2xl font-semibold text-center mb-4">Enter Your Name</h2>
        <p class="text-center text-gray-600 mb-4">Enter your name to start messaging.</p>
        @if ($isTaskPosterConnected)
            <p class="font-semibold bg-gray-900 text-white text-center border-2 rounded-lg shadow-md mb-4 p-4">{{ $taskPosterName }} is connected to chat <img src="{{ asset('svg/circle-online-icon.svg') }}" alt="Online" class="w-4 h-4 inline-block"></p>
        @else
            <p class="font-semibold bg-gray-900 text-white text-center border-2 rounded-lg shadow-md mb-4 p-4">User is not connected to chat <img src="{{ asset('svg/circle-offline-icon.svg') }}" alt="Online" class="w-4 h-4 inline-block"></p>
        @endif
        <form wire:submit.prevent="updateUserName">
            <div class="mb-4">
                <label for="userName" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" id="userName" wire:model="userName" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter your name">
                @error('userName') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">Start Messaging</button>
        </form>
    @endif
</div>