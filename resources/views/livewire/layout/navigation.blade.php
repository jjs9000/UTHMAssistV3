<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-[#FAF9F6]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                @if (Auth::check() && Auth::user()->usertype === 'user')
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('task-posting.index') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
                    </a>
                </div>
                @else
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin-dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
                    </a>
                </div>
                @endif

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Only display Message link to usertype = 'user' -->
                    @if (Auth::check() && Auth::user()->usertype === 'user')
                        <x-nav-link :href="route('task-posting.index')" :active="request()->routeIs('task-posting.index')">
                            {{ __('Home') }}
                        </x-nav-link>

                        <x-nav-link :href="route('task-posting-page')" :active="request()->routeIs('task-posting-page')">
                            {{ __('Task') }}
                        </x-nav-link>

                        <x-nav-link :href="route('application')" :active="request()->routeIs('application')">
                            {{ __('Application') }}
                        </x-nav-link>
                    @endif

                    <!-- Displayed for admin -->
                    @if (Auth::check() && Auth::user()->usertype === 'admin')
                        <x-nav-link :href="route('admin-user')" :active="request()->routeIs('admin-user')">
                            {{ __('User') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.taskpost.index')" :active="request()->routeIs('admin.taskpost.index')">
                            {{ __('Task Post') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.application.index')" :active="request()->routeIs('admin.application.index')">
                            {{ __('Application') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.tag.index')" :active="request()->routeIs('admin.tag.index')">
                            {{ __('Tag') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.rating.index')" :active="request()->routeIs('admin.rating.index')">
                            {{ __('Feedback & Rating') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Messages Link -->
                <x-nav-link :href="route('messages')" :active="request()->routeIs('messages')">
                    <div class="relative">
                        <img src="{{ asset('svg/email-icon.svg') }}" alt="Email Icon" class="w-6 h-6">
                        <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center unread_notification">
                            {{ auth()->user()->getMessageCount() }}
                        </span>
                    </div>
                </x-nav-link>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700  focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->first_name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::check() && Auth::user()->usertype === 'user')
                        <x-dropdown-link :href="route('bookmark.index')" wire:navigate>
                            {{ __('Saved Task') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard.index')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Setting') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                        @else
                        <x-dropdown-link :href="route('admin-dashboard')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Setting') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400  hover:text-gray-500  hover:bg-gray-100  focus:outline-none focus:bg-gray-100  focus:text-gray-500  transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 ">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 " x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
