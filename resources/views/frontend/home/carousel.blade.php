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
                    {{-- Premium Default Fallback Airline Inline SVGs --}}
                    @php
                        $defaultAirlines = [
                            ['name' => 'Saudia', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 50" fill="none"><path d="M25 10 C25 25, 15 35, 10 35 M25 10 C25 25, 35 35, 40 35" stroke="#1E5C3F" stroke-width="2.5"/><path d="M25 15 L25 38" stroke="#1E5C3F" stroke-width="3"/><path d="M12 33 L38 33" stroke="#C39E5C" stroke-width="2"/><text x="50" y="32" font-family="\'Helvetica Neue\', Arial, sans-serif" font-weight="bold" font-size="20" fill="#002D62">SAUDIA</text></svg>'],
                            ['name' => 'Emirates', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 50" fill="none"><text x="15" y="33" font-family="\'Georgia\', serif" font-weight="bold" font-size="24" fill="#D71920" letter-spacing="1">Emirates</text><rect x="15" y="38" width="105" height="3" fill="#D71920"/></svg>'],
                            ['name' => 'British Airways', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 50" fill="none"><text x="10" y="30" font-family="\'Helvetica Neue\', Arial, sans-serif" font-weight="bold" font-size="14" fill="#0A2240">BRITISH AIRWAYS</text><path d="M135 15 L170 15 C155 25, 135 25, 140 30 L130 30 Z" fill="#D71920"/><path d="M140 10 L160 10 C150 15, 142 15, 143 18 L138 18 Z" fill="#0A2240"/></svg>'],
                            ['name' => 'Qatar Airways', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 170 50" fill="none"><circle cx="28" cy="25" r="18" fill="#5C0632"/><path d="M20 22 C23 15, 27 12, 33 16 C30 20, 27 25, 25 32" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M22 10 L28 17 M32 10 L34 19" stroke="white" stroke-width="1.5"/><text x="52" y="31" font-family="\'Helvetica Neue\', Arial, sans-serif" font-weight="bold" font-size="15" fill="#5C0632">QATAR</text><text x="52" y="42" font-family="\'Helvetica Neue\', Arial, sans-serif" font-size="10" fill="#5C0632" letter-spacing="1">AIRWAYS</text></svg>'],
                            ['name' => 'Gulf Air', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 50" fill="none"><path d="M15 15 C20 10, 30 20, 25 35 C20 30, 18 20, 15 15 Z" fill="#CFA043"/><path d="M20 20 C25 15, 35 25, 30 38" stroke="#002D62" stroke-width="2"/><text x="45" y="32" font-family="\'Georgia\', serif" font-weight="bold" font-size="18" fill="#002D62" letter-spacing="1">GULF AIR</text></svg>'],
                            ['name' => 'Turkish Airlines', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 50" fill="none"><circle cx="25" cy="25" r="18" fill="#E81C24"/><path d="M17 25 C25 22, 33 28, 38 23 C30 25, 23 20, 17 25 Z" fill="white"/><text x="50" y="27" font-family="\'Helvetica Neue\', Arial, sans-serif" font-weight="bold" font-size="14" fill="#0F172A">TURKISH</text><text x="50" y="38" font-family="\'Helvetica Neue\', Arial, sans-serif" font-weight="bold" font-size="11" fill="#E81C24" letter-spacing="1.5">AIRLINES</text></svg>'],
                        ];
                        // Duplicate for infinite scrolling effect
                        $doubleAirlines = array_merge($defaultAirlines, $defaultAirlines, $defaultAirlines);
                    @endphp
                    @foreach($doubleAirlines as $airline)
                        <div class="logo-slide mx-4 d-flex align-items-center justify-content-center">
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
    width: 180px;
    height: 75px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.9;
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.logo-slide:hover {
    opacity: 1;
    transform: scale(1.08);
}
.partner-logo-img {
    max-height: 55px;
    object-fit: contain;
}
.logo-slide svg {
    max-height: 55px;
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
