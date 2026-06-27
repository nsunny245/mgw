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
                    {{-- Premium Default Fallback Airline SVGs (Saudia, Emirates, British Airways, Qatar, Gulf Air, Turkish Airlines) --}}
                    @php
                        $defaultAirlines = [
                            ['name' => 'Saudia', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#005A9C"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="16">SAUDIA</text><path d="M5 28 h110" stroke="#005A9C" stroke-width="2"/></svg>'],
                            ['name' => 'Emirates', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#D71920"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="16">Emirates</text><path d="M5 28 h110" stroke="#D71920" stroke-width="2"/></svg>'],
                            ['name' => 'British Airways', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#00247D"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="14">BRITISH AIRWAYS</text></svg>'],
                            ['name' => 'Qatar Airways', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#5c0632"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="14">QATAR AIRWAYS</text></svg>'],
                            ['name' => 'Gulf Air', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#cfa043"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="16">GULF AIR</text></svg>'],
                            ['name' => 'Turkish Airlines', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 40" fill="#E81C24"><text x="10" y="25" font-family="sans-serif" font-weight="bold" font-size="14">TURKISH AIRLINES</text></svg>'],
                        ];
                        // Duplicate for infinite scrolling effect
                        $doubleAirlines = array_merge($defaultAirlines, $defaultAirlines, $defaultAirlines);
                    @endphp
                    @foreach($doubleAirlines as $airline)
                        <div class="logo-slide mx-4">
                            {!! $airline['svg'] !!}
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
