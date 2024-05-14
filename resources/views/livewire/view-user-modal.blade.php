<div class="p-4">
    <h2 class="text-lg font-medium text-gray-900">User Details</h2>
    <p class="mt-2">Name: {{ $user->first_name }} {{ $user->last_name }}</p>
    <p class="mt-2">Email: {{ $user->email }}</p>
    <p class="mt-2">Username: {{ $user->username }}</p>
    <p class="mt-2">User Type: {{ $user->usertype }}</p>
    <p class="mt-2">Date of Birth: {{ $user->date_of_birth }}</p>
    <p class="mt-2">Contact Number: {{ $user->contact_number }}</p>
    <p class="mt-2">Address: {{ $user->address }}</p>
    <p class="mt-2">Post Code: {{ $user->post_code }}</p>
    <p class="mt-2">State: {{ $user->state }}</p>
    <p class="mt-2">City: {{ $user->city }}</p>

    <div class="mt-6 flex justify-end">
        <x-secondary-button wire:click="closeUserModal">Close</x-secondary-button>
    </div>
</div>
