<footer id="footer" class="pt-4 pb-3" style="background:#0b4f36;color:#fff;">
    <div class="container">
        <div class="row g-3 align-items-start">
            <div class="col-lg-3 col-md-6">
                <img loading="lazy" src="{{ asset('images/logo-footer.png') }}" alt="Makkah Gateway" height="56" class="img-fluid mb-2">
                <p class="small mb-2">Your trusted travel partner for Umrah packages from the UK.</p>
                <div class="d-flex gap-3 text-white fs-5">
                    <a href="{{ $settings->facebook_url ?? '#' }}" target="_blank" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $settings->instagram_url ?? '#' }}" target="_blank" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="{{ $settings->youtube_url ?? '#' }}" target="_blank" class="text-white"><i class="bi bi-youtube"></i></a>
                    <a href="{{ $settings->linkedin_url ?? '#' }}" target="_blank" class="text-white"><i class="bi bi-linkedin"></i></a>
                    <a href="{{ $settings->twitter_url ?? '#' }}" target="_blank" class="text-white"><i class="bi bi-twitter"></i></a>
                    <a href="https://wa.me/{{ $settings->whatsapp_number ?? '447380888233' }}" target="_blank" class="text-white"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled small mb-0">
                    <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a></li>
                    <li><a href="#packages" class="text-white text-decoration-none">Umrah Packages</a></li>
                    <li><a href="#packages" class="text-white text-decoration-none">Ramadan Umrah</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-white text-decoration-none">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact Us</a></li>
                    <li><a href="{{ route('terms') }}" class="text-white text-decoration-none">Terms & Conditions</a></li>
                    <li><a href="{{ route('disclaimer') }}" class="text-white text-decoration-none">Disclaimer</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold">Top Packages</h6>
                <ul class="list-unstyled small mb-0">
                    <li>7 Nights Packages</li>
                    <li>10 Nights Packages</li>
                    <li>14 Nights Packages</li>
                    <li>3 Star Packages</li>
                    <li>4 Star Packages</li>
                    <li>5 Star Packages</li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold">City Packages</h6>
                <ul class="list-unstyled small mb-0">
                    <li>Umrah Packages London</li>
                    <li>Umrah Packages Birmingham</li>
                    <li>Umrah Packages Manchester</li>
                    <li>Umrah Packages Bradford</li>
                    <li>More Cities</li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold">Contact Info</h6>
                <p class="small mb-1"><i class="bi bi-geo-alt-fill me-1"></i> {{ $settings->address ?? 'Beacon House, Stokenchurch, High Wycombe, HP14 3FE, UK' }}</p>
                <p class="small mb-1"><a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->phone ?? '02034111934') }}" class="text-white text-decoration-none"><i class="bi bi-telephone-fill me-1"></i> {{ $settings->phone ?? '0203 411 1934' }}</a></p>
                <p class="small mb-0"><a href="mailto:{{ $settings->email ?? 'info@makkahgateway.co.uk' }}" class="text-white text-decoration-none"><i class="bi bi-envelope-fill me-1"></i> {{ $settings->email ?? 'info@makkahgateway.co.uk' }}</a></p>
            </div>
        </div>

        <hr class="border-light opacity-25 my-3">
        <div class="text-center small">&copy; 2026 Makkah Gateway. All rights reserved. Powered by <a href="https://mnstech.store" target="_blank" rel="noopener noreferrer" class="text-white">MNS Technologies</a>.</div>
    </div>
</footer>
