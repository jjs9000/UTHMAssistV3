<div class="relative p-6 bg-white rounded-lg shadow-lg max-w-md mx-auto">
    <!-- Close button container -->
    <div class="absolute top-0 right-0 mt-2 mr-2">
        <button wire:click="closeUserModal" class="text-gray-800 hover:text-gray-600 focus:outline-none">
            <img src="{{ asset('svg/close-icon.svg') }}" alt="Close Icon" class="h-6 w-6">
        </button>
    </div>

    <div class="flex flex-col items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p class="text-gray-600">{{ $user->usertype }}</p>
    </div>

    <div class="grid grid-cols-1 gap-4 text-gray-700 mb-6">
        <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
        <p><span class="font-semibold">Username:</span> {{ $user->username }}</p>
        <p><span class="font-semibold">Gender:</span> {{ $user->gender }}</p>
        <p><span class="font-semibold">Date of Birth:</span> {{ $this->getFormattedDateOfBirth($user->date_of_birth) }}</p>
        <p><span class="font-semibold">Contact Number:</span> {{ $user->contact_number }}</p>
        <p><span class="font-semibold">Address:</span> {{ $user->address }}</p>
        <p><span class="font-semibold">Post Code:</span> {{ $user->post_code }}</p>
        <p><span class="font-semibold">State:</span> {{ $user->state }}</p>
        <p><span class="font-semibold">City:</span> {{ $user->city }}</p>
        <p><span class="font-semibold">Joined:</span> {{ $user->created_at->format('d F Y, h:i A') }}</p>
        <p><span class="font-semibold">Last Update:</span> {{ $user->updated_at->format('d F Y, h:i A') }}</p>        
    </div>

    @if($user->is_suspended)
    <div class="flex justify-between space-x-2 mb-6">
        <button wire:click="$dispatch('openModal', { component: 'admin.user.modal.confirmation-modal', arguments: { userId: {{ $user->id }}, action: 'unsuspend' }})" class="flex-1 px-4 py-2 bg-[#0F52BA] hover:ring-2 ring-offset-2 ring-gray-900 text-white rounded">Unsuspend</button>
    </div>
    @else
    <div class="flex justify-between space-x-2 mb-6">
        <button wire:click="$dispatch('openModal', { component: 'admin.user.modal.confirmation-modal', arguments: { userId: {{ $user->id }}, action: 'suspend' }})" class="flex-1 px-4 py-2 bg-[#D22B2B] hover:ring-2 ring-offset-2 ring-gray-900 text-white rounded">Suspend</button>
    </div>
    @endif

    <div class="flex justify-between space-x-2 mb-6">
        <button wire:click="$dispatch('openModal', { component: 'admin.user.modal.report.view-user-report-modal', arguments: { userId: {{ $user->id }} }})" class="flex-1 px-4 py-2 bg-gray-900 hover:ring-2 ring-offset-2 ring-gray-900 text-white rounded">View User Report</button>
    </div>
</div>
