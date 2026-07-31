<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    {!! SEO::generate() !!}

    @if(!empty($settings->google_search_console_meta))
        {!! $settings->google_search_console_meta !!}
    @endif

    @if(!empty($settings->custom_head_scripts))
        {!! $settings->custom_head_scripts !!}
    @endif

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '9150957898282297');
    fbq('track', 'PageView');
    </script>
    <!-- End Meta Pixel Code -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @include('frontend.components.schema')
</head>
<body>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=9150957898282297&ev=PageView&noscript=1"
    /></noscript>

    @if(!empty($settings->google_tag_manager_id))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    @if(!empty($settings->custom_body_scripts))
        {!! $settings->custom_body_scripts !!}
    @endif

    @include('frontend.partials.header')
    @if (session('success'))
        <div class="container mt-3"><div class="alert alert-success mb-0">{{ session('success') }}</div></div>
    @endif
    @yield('content')
    @include('frontend.components.footer')
    @include('frontend.components.whatsapp')

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent-banner" class="fixed-bottom p-4 bg-white shadow-lg border d-none" style="z-index: 1050; max-width: 450px; margin-bottom: 24px; margin-left: 24px; border-radius: 16px; border-color: rgba(0,0,0,0.08) !important;">
        <div class="d-flex align-items-start gap-3">
            <div class="text-success fs-3"><i class="bi bi-cookie"></i></div>
            <div>
                <h6 class="fw-bold text-dark mb-2">We value your privacy</h6>
                <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.5;">We use cookies to enhance your browsing experience, serve personalized ads, and analyze our traffic. By clicking "Accept All", you consent to our use of cookies as per UK standard.</p>
                <div class="d-flex gap-2">
                    <button id="accept-cookies" class="btn btn-success btn-sm fw-bold px-3 py-1.5" style="font-size: 0.82rem; border-radius: 8px;">Accept All</button>
                    <button id="reject-cookies" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-1.5" style="font-size: 0.82rem; border-radius: 8px;">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const banner = document.getElementById('cookie-consent-banner');
        const acceptBtn = document.getElementById('accept-cookies');
        const rejectBtn = document.getElementById('reject-cookies');

        function loadTrackingScripts() {
            // 1. Load Google Tag Manager
            @if(!empty($settings->google_tag_manager_id))
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','{{ $settings->google_tag_manager_id }}');
            @endif

            // 2. Load Google Analytics GA4
            @if(!empty($settings->google_analytics_id))
                var gaScript = document.createElement('script');
                gaScript.async = true;
                gaScript.src = 'https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytics_id }}';
                document.head.appendChild(gaScript);
                
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '{{ $settings->google_analytics_id }}');
            @endif

            // 3. Load Google Ads Tag (AW-16635373265)
            var awScript = document.createElement('script');
            awScript.async = true;
            awScript.src = 'https://www.googletagmanager.com/gtag/js?id=AW-16635373265';
            document.head.appendChild(awScript);
            
            window.dataLayer = window.dataLayer || [];
            function gtag2(){dataLayer.push(arguments);}
            gtag2('js', new Date());
            gtag2('config', 'AW-16635373265');

            // 4. Load Microsoft Clarity Code
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "vclmvmmbem");
        }

        if (!localStorage.getItem('cookie_consent')) {
            banner.classList.remove('d-none');
        } else if (localStorage.getItem('cookie_consent') === 'accepted') {
            loadTrackingScripts();
        }

        acceptBtn.addEventListener('click', function() {
            localStorage.setItem('cookie_consent', 'accepted');
            banner.classList.add('d-none');
            loadTrackingScripts();
        });

        rejectBtn.addEventListener('click', function() {
            localStorage.setItem('cookie_consent', 'rejected');
            banner.classList.add('d-none');
        });
    });
    </script>
</body>
</html>
