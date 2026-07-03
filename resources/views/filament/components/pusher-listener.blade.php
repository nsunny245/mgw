@php
    $settings = \App\Models\Setting::first();
@endphp

<!-- Audio Chime Element -->
<audio id="mg-alert-chime" preload="auto">
    <source src="https://assets.mixkit.co/active_storage/sfx/2869/2869-84.wav" type="audio/wav">
</audio>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const playChime = () => {
            const chime = document.getElementById('mg-alert-chime');
            if (chime) {
                chime.play().catch(e => console.log('Audio autoplay blocked or failed:', e));
            }
        };

        // Play chime on native Filament database notification events (polling)
        window.addEventListener('filament-notifications-sent', playChime);
        window.addEventListener('notification-sent', playChime);

        @if($settings && !empty($settings->pusher_app_key))
            // Lazy load Pusher script if keys are configured
            const script = document.createElement('script');
            script.src = "https://js.pusher.com/8.0.1/pusher.min.js";
            script.onload = () => {
                const pusher = new Pusher('{{ $settings->pusher_app_key }}', {
                    cluster: '{{ $settings->pusher_app_cluster ?? "eu" }}',
                    forceTLS: true
                });

                const channel = pusher.subscribe('makkah-gateway-alerts');
                
                channel.bind('new-inquiry', function(data) {
                    playChime();
                });

                channel.bind('new-chat', function(data) {
                    playChime();
                });
            };
            document.head.appendChild(script);
        @endif
    });
</script>
