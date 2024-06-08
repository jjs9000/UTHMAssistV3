<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewire('wire-elements-modal')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[#FAF9F6]">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
            <script>
          
              // Enable pusher logging - don't include this in production
              Pusher.logToConsole = true;
          
              var pusher = new Pusher('5b69f1f2bd9e3529d33e', {
                cluster: 'ap1'
              });
          
              var channel = pusher.subscribe('my-channel');
              channel.bind('my-event', function(data) {
                $.ajax({
                   url: "{{ route('unreadCount') }}",
                   method: 'GET',
                   success: function(data) {
                     $('.unread_notification').html(data.count);
                   }, 
                })
              });
            </script>
        </div>
    </body>
</html>
