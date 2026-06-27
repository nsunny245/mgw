@extends('frontend.layouts.app')

@section('title', $package->meta_title ?? $package->title)
@section('meta_description', $package->meta_description ?? 'Best Umrah Packages')

@section('content')
<style>
    .package-h1 {
        font-size: 42px;
        font-weight: 800;
        color: #111;
        line-height: 1.2;
    }
    .metric-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }
    .metric-item {
        background: #fdfdfd;
        border: 1px solid #eef2f5;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        transition: transform 0.3s;
    }
    .metric-item:hover {
        transform: translateY(-3px);
    }
    .metric-icon {
        font-size: 26px;
        color: #0b4f36;
        margin-bottom: 8px;
    }
    .metric-label {
        font-size: 13px;
        color: #7f8a96;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .metric-value {
        font-size: 17px;
        font-weight: 700;
        color: #202833;
    }
    .included-box {
        border-radius: 14px;
        border: 1px solid #eef2f5;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }
    .included-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: rgba(11, 79, 54, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #0b4f36;
    }
    .gallery-img-container {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    .gallery-img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .gallery-img-container:hover .gallery-img {
        transform: scale(1.05);
    }
    .reviews-card {
        background: #fdfdfd;
        border: 1px solid #eef2f5;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    }
    .review-score {
        font-size: 48px;
        font-weight: 800;
        color: #0b4f36;
        line-height: 1;
    }
    .progress-rating {
        height: 8px;
        border-radius: 4px;
        background: #eef2f5;
    }
    .progress-bar-fill {
        background: #198754;
    }
    .inquiry-sidebar {
        border: 1px solid #eef2f5;
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    }
    @media(max-width: 767px) {
        .metric-grid {
            grid-template-columns: 1fr;
        }
        .package-h1 {
            font-size: 30px;
        }
    }
</style>

@include('frontend.components.breadcrumbs', ['title' => $package->title, 'parent' => 'Umrah Packages', 'parent_link' => '#packages'])

<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Side Details -->
            <div class="col-lg-8">
                <div class="pe-lg-3">
                    <h1 class="package-h1 mb-4">{{ $package->title }}</h1>
                    
                    <!-- 3x2 Grid Section -->
                    <div class="metric-grid">
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-clock-fill"></i></div>
                            <div class="metric-label">Duration</div>
                            <div class="metric-value">{{ $package->duration ?: '14' }} Days</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-building-fill-check"></i></div>
                            <div class="metric-label">Makkah Hotel</div>
                            <div class="metric-value">{{ $package->makkah_hotel ?: '5 Star Luxury' }}</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-building-fill-exclamation"></i></div>
                            <div class="metric-label">Madina Hotel</div>
                            <div class="metric-value">{{ $package->madinah_hotel ?: '5 Star Luxury' }}</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-currency-pound"></i></div>
                            <div class="metric-label">Price PP</div>
                            <div class="metric-value">£{{ rtrim(rtrim((string) $package->price, '0'), '.') ?: '0' }}</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-patch-check-fill"></i></div>
                            <div class="metric-label">Status</div>
                            <div class="metric-value text-success font-bold">{{ $package->status ?: 'Available' }}</div>
                        </div>
                        <div class="metric-item">
                            <div class="metric-icon"><i class="bi bi-star-fill text-warning"></i></div>
                            <div class="metric-label">Rating</div>
                            <div class="metric-value">{{ $package->star_rating ?: '5 Star' }}</div>
                        </div>
                    </div>

                    <!-- Package Image -->
                    <div class="mb-5">
                        <img loading="lazy" src="{{ $package->getFirstMediaUrl('packages') ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=900&q=80' }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 480px; object-fit: cover;" alt="{{ $package->title }}">
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-3">Package Overview</h4>
                        <div class="text-secondary leading-relaxed">{!! $package->description !!}</div>
                    </div>

                    <!-- Umrah Calendar & Pricing Planner -->
                    @php
                        $calendars = $package->calendars()->orderBy('year')->get()->sortBy(function($calendar) {
                            $months = [
                                'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
                                'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
                                'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
                            ];
                            return $months[$calendar->month] ?? 13;
                        });
                    @endphp

                    @if($calendars->isNotEmpty())
                        <div class="mb-5 card border-0 shadow-sm rounded-4 overflow-hidden" id="calendar-planner">
                            <div class="card-header bg-success text-white py-3 px-4 d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0 text-white"><i class="bi bi-calendar3 me-2"></i> Umrah Calendar Planner</h4>
                                <span class="badge bg-warning text-dark fw-bold">Live Rates</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-4">Month / Period</th>
                                                <th>Departure Dates</th>
                                                <th>Price PP</th>
                                                <th>Availability</th>
                                                <th class="pe-4 text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($calendars as $cal)
                                                <tr>
                                                    <td class="ps-4 fw-bold">
                                                        {{ $cal->month }} {{ $cal->year }}
                                                        @if($cal->notes)
                                                            <small class="d-block text-muted fw-normal">{{ $cal->notes }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($cal->start_date && $cal->end_date)
                                                            {{ \Carbon\Carbon::parse($cal->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($cal->end_date)->format('d M') }}
                                                        @else
                                                            Flexible Dates
                                                        @endif
                                                    </td>
                                                    <td class="fw-bold text-success">£{{ number_format($cal->price, 0) }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $cal->status === 'Available' ? 'success' : ($cal->status === 'Filling Fast' ? 'warning' : 'danger') }}">
                                                            {{ $cal->status }}
                                                        </span>
                                                    </td>
                                                    <td class="pe-4 text-end">
                                                        @if($cal->status !== 'Sold Out')
                                                            <button type="button" 
                                                                    class="btn btn-warning btn-sm fw-bold px-3 select-calendar-date" 
                                                                    data-month="{{ $cal->month }}" 
                                                                    data-year="{{ $cal->year }}"
                                                                    data-date="{{ $cal->start_date }}"
                                                                    data-price="{{ $cal->price }}">
                                                                Book Now
                                                            </button>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>Sold Out</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    @elseif($package->available_all_year)
                        <div class="mb-5 card border-0 shadow-sm rounded-4 overflow-hidden" id="calendar-planner">
                            <div class="card-header bg-success text-white py-3 px-4 d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-0 text-white"><i class="bi bi-calendar3 me-2"></i> Umrah Calendar Planner</h4>
                                <span class="badge bg-warning text-dark fw-bold">Year Round</span>
                            </div>
                            <div class="card-body p-4 text-center">
                                <p class="text-secondary mb-3"><i class="bi bi-info-circle text-success fs-4 d-block mb-2"></i> This package is available all year round with flexible dates. Select your desired departure date in the inquiry form to book.</p>
                                <button type="button" class="btn btn-warning fw-bold select-year-round px-4 py-2" onclick="document.querySelector('.inquiry-sidebar').scrollIntoView({ behavior: 'smooth' })">Get Custom Quote Now</button>
                            </div>
                        </div>
                    @endif

                    <!-- What's Included Section -->
                    <div class="included-box p-4 mb-5">
                        <h4 class="fw-bold mb-4">What is Included in the Package</h4>
                        <div class="row g-3">
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-airplane-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">Flights Support</h6>
                                    <small class="text-muted">Return flight arrangement included</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-file-earmark-text-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">Umrah Visa</h6>
                                    <small class="text-muted">Complete visa document assistance</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-building-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">Hotel Accommodations</h6>
                                    <small class="text-muted">Close hotels in Makkah & Madinah</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-bus-front-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">Ground Transportation</h6>
                                    <small class="text-muted">Private air-conditioned coaches</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">24/7 UK Support</h6>
                                    <small class="text-muted">Dedicated support during transit</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex gap-3 align-items-center">
                                <div class="included-icon-box"><i class="bi bi-patch-check-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold mb-0">ATOL Protection</h6>
                                    <small class="text-muted">100% financially secured</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Picture Gallery -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4">Hotel Picture Gallery</h4>
                        <div class="row g-3">
                            @forelse($package->getMedia('gallery') as $media)
                                <div class="col-4">
                                    <div class="gallery-img-container">
                                        <img src="{{ $media->hasGeneratedConversion('webp') ? $media->getUrl('webp') : $media->getUrl() }}" alt="{{ $package->title }}" class="gallery-img">
                                    </div>
                                </div>
                            @empty
                                <div class="col-4">
                                    <div class="gallery-img-container">
                                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=400&q=80" alt="Luxury Hotel Room" class="gallery-img">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="gallery-img-container">
                                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80" alt="Hotel Reception" class="gallery-img">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="gallery-img-container">
                                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=400&q=80" alt="Hotel Lobby" class="gallery-img">
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Hotel Reviews Section -->
                    <div class="reviews-card p-4">
                        <h4 class="fw-bold mb-4">Hotel Reviews & Ratings</h4>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center border-end mb-3 mb-md-0">
                                <div class="review-score">4.7</div>
                                <div class="text-warning my-2">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <div class="text-muted small">Based on guest reviews</div>
                            </div>
                            <div class="col-md-8 ps-md-4">
                                <!-- Service Review -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small fw-bold mb-1">
                                        <span>Service</span>
                                        <span>4.8 / 5</span>
                                    </div>
                                    <div class="progress progress-rating">
                                        <div class="progress-bar progress-bar-fill" role="progressbar" style="width: 96%;" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!-- Location Review -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small fw-bold mb-1">
                                        <span>Location</span>
                                        <span>4.5 / 5</span>
                                    </div>
                                    <div class="progress progress-rating">
                                        <div class="progress-bar progress-bar-fill" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!-- Cleanliness Review -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small fw-bold mb-1">
                                        <span>Cleanliness</span>
                                        <span>4.9 / 5</span>
                                    </div>
                                    <div class="progress progress-rating">
                                        <div class="progress-bar progress-bar-fill" role="progressbar" style="width: 98%;" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!-- Facilities Review -->
                                <div>
                                    <div class="d-flex justify-content-between small fw-bold mb-1">
                                        <span>Facilities</span>
                                        <span>4.6 / 5</span>
                                    </div>
                                    <div class="progress progress-rating">
                                        <div class="progress-bar progress-bar-fill" role="progressbar" style="width: 92%;" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Inquiry Form -->
            <div class="col-lg-4">
                <div class="inquiry-sidebar sticky-top" style="top: 100px; z-index: 10;">
                    <h4 class="fw-bold mb-3 text-green">Request Custom Quote</h4>
                    <p class="small text-muted mb-4">Complete the fields below to obtain a customized packages proposal.</p>
                    
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <!-- Link inquiry automatically to the current package -->
                        <input type="hidden" name="package_type" value="{{ $package->title }}">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Full Name</label>
                            <input type="text" name="name" class="form-control py-2" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Phone Number</label>
                            <input type="text" name="phone" class="form-control py-2" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control py-2" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Departure City</label>
                            <input type="text" name="city" class="form-control py-2" placeholder="London, Birmingham, etc.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Number of Persons</label>
                            <select class="form-select py-2" name="persons" required>
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
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Travel Date</label>
                            <input type="date" name="travel_date" class="form-control py-2" required>
                        </div>
                        <button class="btn btn-warning w-100 py-3 fw-bold text-dark rounded-3">GET FREE QUOTE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@@context":"https://schema.org",
  "@type":"FAQPage",
  "mainEntity":[
    {
      "@type":"Question",
      "name":"What is included in this package?",
      "acceptedAnswer":{"@type":"Answer","text":"Flights hotels visa and transport included."}
    }
  ]
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.select-calendar-date');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                const month = this.getAttribute('data-month');
                const year = this.getAttribute('data-year');
                
                // Set travel date field
                const dateInput = document.querySelector('input[name="travel_date"]');
                if (dateInput && date) {
                    dateInput.value = date;
                }
                
                // Scroll to Inquiry form
                const formSection = document.querySelector('.inquiry-sidebar');
                if (formSection) {
                    formSection.scrollIntoView({ behavior: 'smooth' });
                    // Highlight the sidebar form to signal selection success
                    formSection.style.transition = 'background-color 0.5s';
                    formSection.style.backgroundColor = '#fff9e6';
                    setTimeout(() => {
                        formSection.style.backgroundColor = '#ffffff';
                    }, 1500);
                }
            });
        });
        
        // Auto-select calendar month if passed in URL query params
        const urlParams = new URLSearchParams(window.location.search);
        const monthParam = urlParams.get('month');
        if (monthParam) {
            const matchedBtn = Array.from(buttons).find(btn => btn.getAttribute('data-month').toLowerCase() === monthParam.toLowerCase());
            if (matchedBtn) {
                // Wait briefly for full rendering and smooth scroll
                setTimeout(() => {
                    matchedBtn.click();
                }, 500);
            }
        }
    });
</script>

@include('frontend.components.related-packages')
@endsection
