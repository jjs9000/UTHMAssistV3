<div class="p-6 bg-white rounded-lg shadow-lg max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">Real-time Notifications Test</h2>

    @if ($message)
        <div class="p-4 mb-4 bg-green-100 rounded-lg">
            <p>{{ $message }}</p>
        </div>
    @endif

    <button wire:click="notifyTest" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
        Send Test Notification
    </button>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Echo.channel('notification-channel')
            .listen('TestEvent', (e) => {
                Livewire.dispatch('echo:notification-channel,TestEvent', e);
            });
    });
</script>
