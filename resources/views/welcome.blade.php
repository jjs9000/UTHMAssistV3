<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <!-- Navigation -->
        <nav class="flex flex-col md:flex-row justify-between items-center bg-[#FAF9F6] py-4 px-4 md:px-8">
            <div class="flex items-center mb-4 md:mb-0">
                <x-application-logo class="block h-16 w-auto text-gray-800" />
                <h2 class="text-2xl md:text-3xl font-bold mt-4 md:mt-6">UTHMAssist</h2>
            </div>
            <div>
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
            </div>
        </nav>
    
        <!-- Hero Section -->
        <section class="py-10 md:py-20 px-4 md:px-8 bg-[#FAF9F6] text-gray-900">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Welcome to UTHMAssist</h2>
                        <p class="text-base md:text-lg mb-8">UTHMAssist is a comprehensive platform designed specifically for UTHM students to find local task opportunities. Our goal is to help students earn extra income and strengthen student communities while studying.</p>
                        <button class="border-2 border-gray-900 text-gray-900 py-2 px-4 md:px-6 rounded-lg text-base md:text-lg font-semibold hover:cursor-pointer transition duration-300 ease-in-out transform hover:scale-110">Learn More</button>
                    </div>
                    <div class="md:w-1/2 mt-8 md:mt-0">
                        <img src="{{ asset('svg/illustration/landing-page-1.svg') }}" alt="Illustration" class="w-full">
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Features Section -->
        <section class="py-10 md:py-20 px-4 md:px-8 bg-[#FAF9F6]">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center">Key Features</h2>
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/3 text-center mb-8 md:mb-0">
                        <img src="{{ asset('svg/illustration/landing-page-2.svg') }}" alt="Built For UTHM Students" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-xl md:text-2xl font-semibold mb-4">Built For UTHM Students</h3>
                        <p class="text-sm md:text-base">Empowering UTHM students to earn extra pocket money by connecting them with opportunities among the students.</p>
                    </div>
                    <div class="md:w-1/3 text-center mb-8 md:mb-0">
                        <img src="{{ asset('svg/illustration/landing-page-3.svg') }}" alt="Apply on the Go" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-xl md:text-2xl font-semibold mb-4">Apply on the Go</h3>
                        <p class="text-sm md:text-base">Seamlessly apply for tasks anytime, anywhere, with a user-friendly interface designed for busy students on the move.</p>
                    </div>
                    <div class="md:w-1/3 text-center">
                        <img src="{{ asset('svg/illustration/landing-page-4.svg') }}" alt="Direct Messaging" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-xl md:text-2xl font-semibold mb-4">Direct Messaging</h3>
                        <p class="text-sm md:text-base">Facilitate smooth communication between users with our built-in direct messaging feature, making task coordination easier than ever.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About the Developer Section -->
        <section class="py-10 md:py-20 px-4 md:px-8 bg-[#FAF9F6]">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-12">About the Developer</h2>
                <div class="flex flex-col md:flex-row items-center justify-center bg-white p-6 rounded-lg shadow-lg">
                    <img src="{{ asset('svg/illustration/landing-page-5.svg') }}" alt="Farris Hirzan" class="w-24 h-24 md:w-32 md:h-32 rounded-full mb-4 md:mb-0 mr-0 md:mr-6">
                    <div class="text-left">
                        <h3 class="text-xl md:text-2xl font-semibold mb-2">Farris Hirzan</h3>
                        <p class="text-sm md:text-base text-gray-700 mb-4">I am a student at Universiti Tun Hussein Onn Malaysia (UTHM) and the developer of UTHMAssist. For my Final Year Project, I created this system to help strengthen the communities of UTHM Students by providing opportunities among them.</p>
                        <p class="text-sm md:text-base text-gray-700">UTHMAssist was developed using <strong>Laravel, Livewire, TailwindCSS and MySQL.</strong></p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8 px-4 md:px-8">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center">
                <p class="mb-4 md:mb-0">&copy; 2024 UTHMAssist. All rights reserved.</p>
                <ul class="flex space-x-4">
                    <li><a href="#" class="hover:text-gray-400">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-gray-400">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-gray-400">Contact Us</a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>