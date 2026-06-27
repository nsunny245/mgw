@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? 'About Makkah Gateway')

@section('content')
@include('frontend.components.breadcrumbs', ['title' => $page->title])

<style>
    .about-content-card {
        border: 1px solid #eef2f5;
        border-radius: 16px;
        background: #fff;
        padding: 40px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.02);
    }
    .about-content-card p {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
        margin-bottom: 20px;
    }
</style>

<section class="pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="about-content-card">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
