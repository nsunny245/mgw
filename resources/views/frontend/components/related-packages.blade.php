@if(isset($relatedPackages) && $relatedPackages->count())
<section class="section-padding pt-0">
    <div class="container">
        <h3 class="fw-bold mb-4">Related Packages</h3>
        <div class="row">
            @foreach($relatedPackages as $package)
                @include('frontend.components.package-card')
            @endforeach
        </div>
    </div>
</section>
@endif
