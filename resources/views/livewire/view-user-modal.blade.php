<div class="p-6 bg-white rounded-lg shadow-lg max-w-md mx-auto">
    <div class="flex flex-col items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p class="text-gray-600">{{ $user->usertype }}</p>
    </div>

    <div class="grid grid-cols-1 gap-4 text-gray-700 mb-6">
        <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
        <p><span class="font-semibold">Username:</span> {{ $user->username }}</p>
        <p><span class="font-semibold">Date of Birth:</span> {{ $user->date_of_birth }}</p>
        <p><span class="font-semibold">Contact Number:</span> {{ $user->contact_number }}</p>
        <p><span class="font-semibold">Address:</span> {{ $user->address }}</p>
        <p><span class="font-semibold">Post Code:</span> {{ $user->post_code }}</p>
        <p><span class="font-semibold">State:</span> {{ $user->state }}</p>
        <p><span class="font-semibold">City:</span> {{ $user->city }}</p>
    </div>

    <div class="flex justify-between space-x-2 mb-6">
        <button class="flex-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">View Profile</button>
        <button class="flex-1 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:bg-red-600">Suspend</button>
    </div>

    <div class="flex justify-end">
        <button wire:click="closeUserModal" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none focus:bg-gray-300">Close</button>
    </div>
</div>
