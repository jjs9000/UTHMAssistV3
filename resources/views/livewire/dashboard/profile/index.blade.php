<div class="flex flex-col md:flex-row mx-10 space-y-4 md:space-y-0 md:space-x-4">
    <div class="w-full md:w-2/3 space-y-4">
        <div class="flex flex-col md:flex-row md:space-x-4">
            {{-- Profile Picture Card --}}
            <livewire:dashboard.profile.profile-picture-card class="w-full md:w-1/2" />

            {{-- Bio Card --}}
            <livewire:dashboard.profile.bio-card class="w-full md:w-1/2" />
        </div>

        <div class="flex flex-col md:flex-row md:space-x-4">
            {{-- Personal Card --}}
            <livewire:dashboard.profile.personal-card class="w-full md:w-1/2" />

            {{-- Address Card --}}
            <livewire:dashboard.profile.address-card class="w-full md:w-1/2" />
        </div>
    </div>
    <div class="w-full md:w-1/3 mx-auto p-4 flex justify-center items-center flex-col">
        <p class="text-2xl font-semibold">Describe & express yourself to others!</p>
        <img src="{{ asset('svg/illustration/profile-page.svg') }}" class="w-80 h-auto" />
    </div>
</div>

