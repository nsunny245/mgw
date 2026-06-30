<header class="sticky-top bg-white shadow-sm" style="z-index: 1020;">
    <div class="top-bar py-2 border-bottom bg-white d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-12 text-center text-lg-start mb-2 mb-lg-0">
                    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                        <img loading="lazy" src="{{ asset('frontend/images/logo.png') }}" alt="Makkah Gateway Logo" class="img-fluid" style="max-height: 60px;">
                    </a>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="d-flex justify-content-center text-dark fw-bold" style="font-size: 0.9rem;">
                        <div class="text-dark"><i class="bi bi-geo-alt-fill text-success me-1"></i> {{ $settings->address ?? 'High Wycombe, UK' }}</div>
                    </div>
                </div>
                <div class="col-lg-5 text-center text-lg-end d-flex justify-content-end align-items-center gap-2">
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->phone ?? '02034111934') }}" class="btn btn-success px-3 fw-bold"><i class="bi bi-telephone-fill me-1"></i> Call: {{ $settings->phone ?? '0203 411 1934' }}</a>
                    <a href="https://wa.me/{{ $settings->whatsapp_number ?? '447380888233' }}" target="_blank" class="btn btn-success px-3 fw-bold" style="background-color: #25D366; border-color: #25D366;"><i class="bi bi-whatsapp me-1"></i> WhatsApp</a>
                    <a href="#quoteForm" class="btn btn-warning px-3 fw-semibold">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand d-lg-none" href="{{ url('/') }}"><img loading="lazy" src="{{ asset('frontend/images/logo.png') }}" alt="Makkah Gateway" height="45"></a>
            <div class="d-flex align-items-center gap-2 d-lg-none">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->phone ?? '02034111934') }}" class="btn btn-success btn-sm fw-bold"><i class="bi bi-telephone-fill me-1"></i> {{ $settings->phone ?? '0203 411 1934' }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"><span class="navbar-toggler-icon"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></li>
                    
                    {{-- Monthly Packages Dropdown --}}
                    @if($monthlyCategories->isNotEmpty())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="monthlyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Monthly Packages
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="monthlyDropdown">
                                @foreach($monthlyCategories as $mCategory)
                                    <li><a class="dropdown-item" href="{{ route('calendar.month', $mCategory->slug) }}">{{ $mCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    {{-- Special Umrah Dropdown --}}
                    @if($specialCategories->isNotEmpty())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="specialDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Special Umrah
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="specialDropdown">
                                @foreach($specialCategories as $sCategory)
                                    <li><a class="dropdown-item" href="{{ route('category.show', $sCategory->slug) }}">{{ $sCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    {{-- Cities Dropdown --}}
                    @if($cities->isNotEmpty())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="citiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cities
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="citiesDropdown">
                                @foreach($cities as $city)
                                    <li><a class="dropdown-item" href="{{ route('city.show', $city->slug) }}">{{ $city->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item"><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
