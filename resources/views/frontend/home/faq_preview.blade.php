<section id="faq-preview" class="py-5" style="background: #faf8f5; border-top: 1px solid rgba(0,0,0,0.03);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-success fw-bold text-uppercase tracking-wider small" style="letter-spacing: 2px;">UMRAH TRAVEL HELP</span>
            <h3 class="fw-bold text-dark mt-1">Questions Before You Travel?</h3>
            <p class="text-muted small">Everything you need to start planning your Umrah pilgrimage with confidence.</p>
        </div>

        <div class="row g-4">
            <!-- Left Side: Support CTA -->
            <div class="col-lg-4 d-flex flex-column justify-content-between">
                <div class="bg-white border rounded-4 p-4 shadow-sm mb-4 h-100 d-flex flex-column justify-content-center">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-patch-question text-success me-2"></i> Need More Clarification?</h5>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                        Our Umrah travel specialists are here to guide you through visa rules, flights, hotel selections, and payments. Feel free to contact us directly.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('contact') }}" class="btn btn-success fw-bold py-2.5 rounded-3"><i class="bi bi-telephone-fill me-2"></i> Speak with Our Team</a>
                        <a href="{{ route('faq') }}" class="btn btn-outline-secondary fw-bold py-2.5 rounded-3">View All FAQs</a>
                    </div>
                </div>
            </div>

            <!-- Right Side: 5 Accordion Questions -->
            <div class="col-lg-8">
                @php
                    $previewFaqs = [
                        [
                            'id' => 101,
                            'question' => 'How much does Umrah cost from the UK?',
                            'answer' => 'The cost of Umrah from the UK depends on your travel dates, flights, hotel category, room type and length of stay. At Makkah Gateway, we offer Umrah packages from budget to 5-star options, with packages tailored to different budgets and requirements. Contact us for the latest prices and availability.'
                        ],
                        [
                            'id' => 102,
                            'question' => 'What is included in an Umrah package?',
                            'answer' => 'Our Umrah packages can include return flights, hotel accommodation in Makkah and Madinah, private transfers and visa assistance, depending on the package selected. Meals can also be added if required for an additional charge.'
                        ],
                        [
                            'id' => 103,
                            'question' => 'Do your packages include return flights?',
                            'answer' => 'Yes. Our Umrah packages include return flights from the UK. We offer both direct and indirect flight options from major UK airports, depending on availability and your preferred travel dates.'
                        ],
                        [
                            'id' => 104,
                            'question' => 'Can I pay for my Umrah package in instalments?',
                            'answer' => 'Yes. Instalment payment plans are available on selected Umrah packages. The required deposit and payment schedule will depend on your package, travel date and booking conditions. Our team will explain the payment options before you confirm your booking.'
                        ],
                        [
                            'id' => 105,
                            'question' => 'Can I choose my Makkah and Madinah hotels?',
                            'answer' => 'Yes. We offer a range of 3-star, 4-star and 5-star hotels in Makkah and Madinah. You can tell us your preferred hotel, location, star rating and budget, and we\'ll provide suitable options based on availability.'
                        ],
                    ];
                @endphp

                <div class="accordion accordion-custom" id="faqPreviewAccordion">
                    @foreach($previewFaqs as $faq)
                        <div class="accordion-item border mb-3 rounded-4 overflow-hidden shadow-sm" style="background: #fff; border-color: rgba(0,0,0,0.05) !important;">
                            <h2 class="accordion-header" id="heading-preview-{{ $faq['id'] }}">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white py-3 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-preview-{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse-preview-{{ $faq['id'] }}" style="font-size: 1.02rem;">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapse-preview-{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading-preview-{{ $faq['id'] }}" data-bs-parent="#faqPreviewAccordion">
                                <div class="accordion-body bg-white text-secondary py-3 px-4 border-top" style="line-height: 1.6; font-size: 0.92rem;">
                                    {!! nl2br(e($faq['answer'])) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('faq') }}" class="text-success fw-bold text-decoration-none d-inline-flex align-items-center">
                        View All Frequently Asked Questions <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Schema JSON-LD for the 5 previewed questions -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    @foreach($previewFaqs as $index => $faq)
    {
      "@@type": "Question",
      "name": "{{ addslashes($faq['question']) }}",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "{{ addslashes(str_replace(["\r", "\n"], " ", $faq['answer'])) }}"
      }
    }{{ $index < count($previewFaqs) - 1 ? ',' : '' }}
    @endforeach
  ]
}
</script>
