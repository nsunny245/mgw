<section class="py-2" style="background:#0e603e;">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="text-white">
            <h4 class="fw-bold mb-0">Ready to Start Your Spiritual Journey?</h4>
            <small>Call us now or chat on WhatsApp to get the best deal for your Umrah.</small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings->phone ?? '02034111934') }}" class="btn btn-light btn-sm px-3"><i class="bi bi-telephone-fill me-1"></i> {{ $settings->phone ?? '0203 411 1934' }}</a>
            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '447380888233' }}" target="_blank" class="btn btn-warning btn-sm px-3"><i class="bi bi-whatsapp me-1"></i> Chat on WhatsApp</a>
        </div>
    </div>
</section>
