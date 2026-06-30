<section class="partner-logos-section py-5 bg-light border-bottom border-top">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark mb-1">Our Trusted Airline Partners</h2>
            <p class="text-muted mb-0">Direct flight connections with leading global airlines for your sacred journey</p>
        </div>
        <div class="logo-slider-wrapper position-relative overflow-hidden">
            <div class="logo-slider-track d-flex align-items-center">
                @if($heroCarousel && !empty($heroCarousel->slides))
                    @php
                        // Duplicate slides to ensure continuous loop
                        $slides = $heroCarousel->slides;
                        $infiniteSlides = array_merge($slides, $slides, $slides);
                    @endphp
                    @foreach($infiniteSlides as $slide)
                        <div class="logo-slide mx-4">
                            @if(!empty($slide['link']))
                                <a href="{{ $slide['link'] }}" target="_blank">
                            @endif
                            <img src="{{ asset('storage/' . $slide['image']) }}" alt="{{ $slide['title'] ?? 'Airline Partner' }}" class="img-fluid partner-logo-img">
                            @if(!empty($slide['link']))
                                </a>
                            @endif
                        </div>
                    @endforeach
                @else
                    {{-- Premium Default Fallback Airline Logos (Saudia, Emirates, British Airways, Qatar, Gulf Air, Turkish Airlines) --}}
                    @php
                        $defaultAirlines = [
                            ['name' => 'Saudia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/e/ea/Saudi_Arabian_Airlines_logo.svg'],
                            ['name' => 'Emirates', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Emirates_logo.svg'],
                            ['name' => 'British Airways', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f2/British_Airways_Logo.svg'],
                            ['name' => 'Qatar Airways', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/23/Qatar_Airways_Logo.svg'],
                            ['name' => 'Gulf Air', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f6/Gulf_Air_Logo.svg'],
                            ['name' => 'Turkish Airlines', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3d/Turkish_Airlines_logo_detailed.svg'],
                        ];
                        // Duplicate for infinite scrolling effect
                        $doubleAirlines = array_merge($defaultAirlines, $defaultAirlines, $defaultAirlines);
                    @endphp
                    @foreach($doubleAirlines as $airline)
                        <div class="logo-slide mx-4 d-flex align-items-center justify-content-center" style="width: 140px; height: 60px;">
                            <img src="{{ $airline['logo'] }}" alt="{{ $airline['name'] }}" class="img-fluid" style="max-height: 45px; width: auto; filter: grayscale(20%) contrast(100%);">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<style>
.logo-slider-wrapper {
    width: 100%;
    mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
}
.logo-slider-track {
    display: flex;
    width: max-content;
    animation: scroll-logos 30s linear infinite;
}
.logo-slider-track:hover {
    animation-play-state: paused;
}
.logo-slide {
    flex-shrink: 0;
    width: 150px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.6;
    transition: opacity 0.3s ease, filter 0.3s ease, transform 0.3s ease;
    filter: grayscale(100%);
}
.logo-slide:hover {
    opacity: 1;
    filter: grayscale(0%);
    transform: scale(1.05);
}
.partner-logo-img {
    max-height: 45px;
    object-fit: contain;
}
.logo-slide svg {
    max-height: 45px;
    width: auto;
}
@keyframes scroll-logos {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-33.33%);
    }
}
</style>
