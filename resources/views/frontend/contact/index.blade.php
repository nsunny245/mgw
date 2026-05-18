@extends('frontend.layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Contact Makkah Gateway')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-4">Contact Us</h1>
                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
                    <input type="text" name="phone" class="form-control mb-3" placeholder="Phone" required>
                    <textarea name="message" class="form-control mb-3" placeholder="Message"></textarea>
                    <button class="btn btn-gold">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
