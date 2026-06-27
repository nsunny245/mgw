<section class="hero-section position-relative">
    <div class="hero-overlay"></div>

    <a href="https://wa.me/{{ $settings->whatsapp_number ?? '447380888233' }}" target="_blank" class="hero-whatsapp-tab">
        <span>Contact on WhatsApp</span>
        <i class="bi bi-whatsapp"></i>
    </a>

    <div class="container position-relative hero-content-wrap">
        <div class="row align-items-center hero-row">
            <div class="col-lg-6 text-white hero-left">
                <h1 class="hero-title mb-2">Book Your<br><span class="text-warning">Umrah</span> from UK</h1>
                <p class="lead mb-4">Trusted, ATOL Protected &<br>Affordable Packages</p>
                <ul class="hero-features list-unstyled mb-0">
                    <li><i class="bi bi-check-circle-fill"></i> ATOL Protected</li>
                    <li><i class="bi bi-check-circle-fill"></i> Best Price Guarantee</li>
                    <li><i class="bi bi-check-circle-fill"></i> Flights + Hotels Included</li>
                    <li><i class="bi bi-check-circle-fill"></i> 24/7 UK Support</li>
                </ul>
            </div>

            <div class="col-lg-5 offset-lg-1 hero-right">
                <div class="quote-form-card shadow-lg bg-white rounded-4" id="quoteForm">
                    <h3 class="fw-bold text-center mb-4">Get The Best Umrah Deals!</h3>
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="city" required>
                                <option value="">Select Departure City</option>
                                @foreach($allCities as $c)
                                    <option value="{{ $c->name }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="persons" required>
                                <option value="">How many persons?</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="8+">8+</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="travel_date" class="form-control" placeholder="Travel Date" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">GET BEST DEAL NOW</button>
                        <p class="small text-muted text-center mb-0 mt-3">Your information is safe with us.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="trust-bar">
        <div class="container">
            <div class="row text-center text-white g-0">
                <div class="col-md-3 trust-item">
                    <strong>ATOL Protected</strong>
                    <div class="tiny">License No: 11941</div>
                </div>
                <div class="col-md-3 trust-item">
                    <strong>IATA Certified</strong>
                    <div class="tiny">Accredited Agent</div>
                </div>
                <div class="col-md-3 trust-item">
                    <strong>4.8 Rating</strong>
                    <div class="tiny">From 1000+ Customers</div>
                </div>
                <div class="col-md-3 trust-item">
                    <strong>UK Based Support</strong>
                    <div class="tiny">Here to Help You 24/7</div>
                </div>
            </div>
        </div>
    </div>
</section>
