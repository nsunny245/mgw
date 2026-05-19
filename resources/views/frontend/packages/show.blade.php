@extends('frontend.layouts.app')

@section('title', $package->meta_title ?? $package->title)
@section('meta_description', $package->meta_description ?? 'Best Umrah Packages')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $package->title])

<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <img loading="lazy" src="{{ $package->getFirstMediaUrl('packages') ?: 'https://placehold.co/900x500?text=Package' }}" class="img-fluid rounded mb-4" alt="{{ $package->title }}">
                <h1 class="fw-bold mb-4">{{ $package->title }}</h1>
                <div class="mb-4">{!! $package->description !!}</div>
            </div>
            <div class="col-lg-4">
                <div class="border rounded p-4 shadow-sm sticky-top" style="top: 90px;">
                    <h3 class="text-green">£{{ $package->price }}</h3>
                    <hr>
                    <p>Duration: {{ $package->duration }} Days</p>
                    <p>Rating: {{ $package->star_rating }}</p>
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_type" value="{{ $package->title }}">
                        <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
                        <input type="text" name="phone" class="form-control mb-3" placeholder="Phone" required>
                        <button class="btn btn-gold w-100">Send Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
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

@include('frontend.components.related-packages')
@endsection
