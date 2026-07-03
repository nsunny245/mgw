@php
    $settings = \App\Models\Setting::first();
@endphp

@if($settings && !empty($settings->pusher_app_key))
    <!-- Audio Chime Element -->
    <audio id="mg-alert-chime" preload="auto">
        <source src="https://assets.mixkit.co/active_storage/sfx/2869/2869-84.wav" type="audio/wav">
    </audio>

    <!-- Pusher Client Integration -->
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Enable pusher logging - remove in production if preferred
            Pusher.logToConsole = false;

            const pusher = new Pusher('{{ $settings->pusher_app_key }}', {
                cluster: '{{ $settings->pusher_app_cluster ?? "eu" }}',
                forceTLS: true
            });

            const channel = pusher.subscribe('makkah-gateway-alerts');
            
            const playChime = () => {
                const chime = document.getElementById('mg-alert-chime');
                if (chime) {
                    chime.play().catch(e => console.log('Audio autoplay blocked or failed:', e));
                }
            };

            // 1. Listen for new inquiries
            channel.bind('new-inquiry', function(data) {
                playChime();
                new FilamentNotification()
                    .title('🔔 New Inquiry Submitted')
                    .body(`Lead from ${data.inquiryData.name} (${data.inquiryData.departure_city || 'UK'})`)
                    .success()
                    .send();
            });

            // 2. Listen for new chat messages
            channel.bind('new-chat', function(data) {
                playChime();
                new FilamentNotification()
                    .title('💬 New Chat Message')
                    .body(`Message from ${data.chatData.name}: "${data.chatData.message}"`)
                    .info()
                    .send();
            });
        });
    </script>
@endif
