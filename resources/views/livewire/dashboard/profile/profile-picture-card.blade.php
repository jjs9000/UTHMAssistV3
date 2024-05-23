<div class="w-1/2 mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-gray-900">Profile Information</h2>
    <div class="mt-4 space-y-4">
        <div class="flex items-center justify-start">
            <div class="flex flex-col space-y-2 ml-4">
                <p>{{ $user->username }}</p>
                <p>{{ $user->date_of_birth }}</p>
            </div>
        </div>
    </div>
</div>
