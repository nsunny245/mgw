<header>
    <div class="top-bar py-2 border-bottom bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-12 text-center text-lg-start mb-2 mb-lg-0">
                    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="Makkah Gateway Logo" class="img-fluid" style="max-height: 60px;">
                    </a>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div class="d-flex justify-content-center gap-4 small text-dark">
                        <div><i class="bi bi-telephone-fill text-success"></i> 0203 411 1934</div>
                        <div><i class="bi bi-phone-fill text-success"></i> 0738 088 8233</div>
                        <div><i class="bi bi-geo-alt-fill text-success"></i> High Wycombe, UK</div>
                    </div>
                </div>
                <div class="col-lg-2 text-center text-lg-end">
                    <a href="#quoteForm" class="btn btn-warning px-4 fw-semibold">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-lg-none" href="{{ url('/') }}">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="Makkah Gateway" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#packages">Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#packages">Ramadan Umrah</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cities">Cities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
