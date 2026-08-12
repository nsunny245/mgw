@extends('frontend.layouts.app')

@section('title', 'Umrah FAQs UK | Packages, Visas & Travel Guide | Makkah Gateway')
@section('meta_description', 'Find answers to common questions about Umrah from the UK, including visas, eVisas, flights, hotels, transfers, packages and travel requirements.')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => 'FAQs'])

<section class="py-5" style="background: #faf8f5;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-6 rounded-pill mb-3 fw-bold">UMRAH TRAVEL HELP</span>
                <h1 class="fw-bold text-dark mb-3" style="font-size: clamp(24px, 4vw, 36px);">Frequently Asked Questions About Umrah from the UK</h1>
                <p class="text-muted fs-6" style="max-width: 750px; margin: 0 auto; line-height: 1.6;">
                    Planning Umrah from the UK can raise questions about visas, flights, hotels, transportation and choosing the right package. We've brought together answers to some of the questions UK pilgrims ask most frequently when planning their journey to Makkah and Madinah.
                </p>
            </div>
        </div>

        <!-- Search input & category filter buttons -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-lg-6">
                <div class="input-group shadow-sm rounded-3 overflow-hidden border">
                    <span class="input-group-text bg-white border-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" id="faq-search" class="form-control border-0 py-3" placeholder="Search Umrah questions..." aria-label="Search FAQs">
                </div>
                
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                    <button class="btn btn-success px-4 py-2 rounded-pill fw-bold faq-filter-btn active" data-category="all">All Questions</button>
                    <button class="btn btn-outline-success px-4 py-2 rounded-pill fw-bold faq-filter-btn" data-category="visa">Umrah & Visa Requirements</button>
                    <button class="btn btn-outline-success px-4 py-2 rounded-pill fw-bold faq-filter-btn" data-category="packages">Umrah Packages from the UK</button>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- No results state -->
                <div id="no-results" class="text-center py-5 d-none bg-white rounded-4 border shadow-sm mb-4">
                    <div class="fs-1 text-muted mb-3"><i class="bi bi-search-heart"></i></div>
                    <h5 class="fw-bold text-dark">No matching questions found.</h5>
                    <p class="text-muted mb-0 px-3">Please try another search or contact our Umrah travel team.</p>
                </div>

                @php
                    $faqs = \App\Helpers\FaqHelper::getQuestions();
                    $visaFaqs = array_filter($faqs, fn($f) => $f['category'] === 'Umrah & Visa Requirements');
                    $packageFaqs = array_filter($faqs, fn($f) => $f['category'] === 'Umrah Packages from the UK');
                @endphp

                <!-- Section 1: Umrah & Visa Requirements -->
                <div class="faq-group-container mb-5" id="group-visa">
                    <h3 class="fw-bold text-dark mb-4 pb-2 border-bottom"><i class="bi bi-passport text-success me-2"></i> Umrah & Visa Requirements</h3>
                    <div class="accordion accordion-custom" id="accordionVisa">
                        @foreach($visaFaqs as $index => $faq)
                            <div class="accordion-item faq-item-card border mb-3 rounded-4 overflow-hidden shadow-sm" data-search-text="{{ strtolower($faq['question'] . ' ' . $faq['answer']) }}">
                                <h2 class="accordion-header" id="heading-{{ $faq['id'] }}">
                                    <button class="accordion-button collapsed fw-bold text-dark bg-white py-3 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse-{{ $faq['id'] }}" style="font-size: 1.05rem;">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $faq['id'] }}" data-bs-parent="#accordionVisa">
                                    <div class="accordion-body bg-white text-secondary py-3 px-4 border-top" style="line-height: 1.7; font-size: 0.95rem;">
                                        {!! nl2br(e($faq['answer'])) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section 2: Umrah Packages from the UK -->
                <div class="faq-group-container mb-5" id="group-packages">
                    <h3 class="fw-bold text-dark mb-4 pb-2 border-bottom"><i class="bi bi-box-seam text-success me-2"></i> Umrah Packages from the UK</h3>
                    <div class="accordion accordion-custom" id="accordionPackages">
                        @foreach($packageFaqs as $index => $faq)
                            <div class="accordion-item faq-item-card border mb-3 rounded-4 overflow-hidden shadow-sm" data-search-text="{{ strtolower($faq['question'] . ' ' . $faq['answer']) }}">
                                <h2 class="accordion-header" id="heading-{{ $faq['id'] }}">
                                    <button class="accordion-button collapsed fw-bold text-dark bg-white py-3 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse-{{ $faq['id'] }}" style="font-size: 1.05rem;">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $faq['id'] }}" data-bs-parent="#accordionPackages">
                                    <div class="accordion-body bg-white text-secondary py-3 px-4 border-top" style="line-height: 1.7; font-size: 0.95rem;">
                                        {!! nl2br(e($faq['answer'])) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Disclaimer alert box -->
                <div class="card border-0 bg-warning bg-opacity-10 text-warning-emphasis p-4 rounded-4 shadow-sm mt-5">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="fs-2 text-warning"><i class="bi bi-info-circle-fill"></i></div>
                        <div>
                            <p class="mb-0 small text-muted-emphasis font-medium" style="line-height: 1.6;">
                                <strong>Important Notice:</strong> Visa, entry and health requirements can change. Please confirm the latest requirements with our team before booking or travelling.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Schema JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    @foreach($faqs as $index => $faq)
    {
      "@@type": "Question",
      "name": "{{ addslashes($faq['question']) }}",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "{{ addslashes(str_replace(["\r", "\n"], " ", $faq['answer'])) }}"
      }
    }{{ $index < count($faqs) - 1 ? ',' : '' }}
    @endforeach
  ]
}
</script>

<style>
.accordion-custom .accordion-item {
    border-color: rgba(0,0,0,0.06) !important;
}
.accordion-custom .accordion-button:not(.collapsed) {
    background-color: #0e603e !important;
    color: #ffffff !important;
}
.accordion-custom .accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}
.accordion-custom .accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,0.06);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('faq-search');
    const filterButtons = document.querySelectorAll('.faq-filter-btn');
    const faqItems = document.querySelectorAll('.faq-item-card');
    const noResults = document.getElementById('no-results');
    const groupVisa = document.getElementById('group-visa');
    const groupPackages = document.getElementById('group-packages');

    let currentCategory = 'all';
    let searchQuery = '';

    function filterFaqs() {
        let matches = 0;
        let visaMatches = 0;
        let packageMatches = 0;

        faqItems.forEach(item => {
            const matchesSearch = item.getAttribute('data-search-text').includes(searchQuery);
            const parentGroup = item.closest('.faq-group-container').id;
            const matchesCategory = currentCategory === 'all' || 
                (currentCategory === 'visa' && parentGroup === 'group-visa') ||
                (currentCategory === 'packages' && parentGroup === 'group-packages');

            if (matchesSearch && matchesCategory) {
                item.classList.remove('d-none');
                matches++;
                if (parentGroup === 'group-visa') visaMatches++;
                if (parentGroup === 'group-packages') packageMatches++;
            } else {
                item.classList.add('d-none');
            }
        });

        // Toggle Group Headers
        if (currentCategory === 'all') {
            groupVisa.classList.toggle('d-none', visaMatches === 0);
            groupPackages.classList.toggle('d-none', packageMatches === 0);
        } else if (currentCategory === 'visa') {
            groupVisa.classList.remove('d-none');
            groupPackages.classList.add('d-none');
        } else {
            groupVisa.classList.add('d-none');
            groupPackages.classList.remove('d-none');
        }

        // Toggle No Results State
        noResults.classList.toggle('d-none', matches > 0);
    }

    searchInput.addEventListener('input', function() {
        searchQuery = this.value.toLowerCase().trim();
        filterFaqs();
    });

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => {
                b.classList.remove('btn-success', 'active');
                b.classList.add('btn-outline-success');
            });
            this.classList.remove('btn-outline-success');
            this.classList.add('btn-success', 'active');

            currentCategory = this.getAttribute('data-category');
            filterFaqs();
        });
    });
});
</script>
@endsection
