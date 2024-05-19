<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold mb-4">User Profile</h2>
                    <!-- Profile Picture (Top Center) -->
                    <div class="flex justify-center mb-8">
                        <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="w-32 h-32 rounded-full">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- User Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Personal Information</h3>
                            <ul class="list-disc list-inside">
                                <li><strong>First Name:</strong> {{ $user->first_name }}</li>
                                <li><strong>Last Name:</strong> {{ $user->last_name }}</li>
                                <li><strong>Username:</strong> {{ $user->username }}</li>
                                <li><strong>Email:</strong> {{ $user->email }}</li>
                                <li><strong>Contact Number:</strong> {{ $user->contact_number }}</li>
                                <li><strong>Date of Birth:</strong> {{ $user->date_of_birth }}</li>
                            </ul>
                        </div>

                        <!-- Address Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Address Information</h3>
                            <ul class="list-disc list-inside">
                                <li><strong>Address:</strong> {{ $user->address }}</li>
                                <li><strong>Post Code:</strong> {{ $user->post_code }}</li>
                                <li><strong>State:</strong> {{ $user->state }}</li>
                                <li><strong>City:</strong> {{ $user->city }}</li>
                            </ul>
                        </div>

                        <!-- Other Information -->
                        <div class="col-span-2">
                            <h3 class="text-lg font-semibold mb-2">Other Information</h3>
                            <ul class="list-disc list-inside">
                                <li><strong>IC:</strong> {{ $user->ic }}</li>
                                <li><strong>Account Created:</strong> {{ $user->created_at->format('d M Y') }}</li>
                                <li><strong>Last Updated:</strong> {{ $user->updated_at->format('d M Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
