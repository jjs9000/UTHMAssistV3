<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is your messages page.') }}
    </div>
    
    <!-- Display Messages Here -->

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('dashboard') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Back to Dashboard') }}
        </a>
    </div>
</x-app-layout>
