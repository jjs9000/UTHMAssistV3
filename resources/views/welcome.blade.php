<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 antialiased">
        <!-- Navigation -->
        <nav class="flex justify-between items-center bg-white py-4 px-8">
            <h1 class="text-2xl font-semibold">UTHMAssist</h1>
            <div>
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
            </div>
        </nav>
    
        <!-- Hero Section -->
        <section class="py-20 px-8 bg-blue-500 text-white">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2">
                        <h2 class="text-4xl font-bold mb-4">Welcome to UTHMAssist</h2>
                        <p class="text-lg mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet justo a est consequat egestas.</p>
                        <a href="#" class="bg-white text-blue-500 hover:bg-blue-600 py-2 px-6 rounded-lg text-lg font-semibold">Learn More</a>
                    </div>
                    <div class="md:w-1/2 mt-8 md:mt-0">
                        <img src="undraw_online_everywhere_cd90.svg" alt="Illustration" class="w-full">
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Features Section -->
        <section class="py-20 px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-4xl font-bold mb-12 text-center">Key Features</h2>
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/3 text-center mb-8 md:mb-0">
                        <img src="undraw_secure_login_pdn4.svg" alt="Feature Illustration" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-2xl font-semibold mb-4">Secure Login</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="md:w-1/3 text-center mb-8 md:mb-0">
                        <img src="undraw_online_payments_luau.svg" alt="Feature Illustration" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-2xl font-semibold mb-4">Online Payments</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="md:w-1/3 text-center">
                        <img src="undraw_smart_home_28oy.svg" alt="Feature Illustration" class="w-2/3 mx-auto mb-6">
                        <h3 class="text-2xl font-semibold mb-4">Smart Home Integration</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 px-8">
            <div class="max-w-6xl mx-auto flex justify-between items-center">
                <p>&copy; 2023 UTHMAssist. All rights reserved.</p>
                <ul class="flex space-x-4">
                    <li><a href="#" class="hover:text-gray-400">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-gray-400">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-gray-400">Contact Us</a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>
