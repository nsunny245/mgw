<style>
    .global-breadcrumb-banner {
        background: linear-gradient(rgba(10, 20, 32, 0.75), rgba(10, 20, 32, 0.75)), url('{{ asset("frontend/images/makkah_banner.png") }}') center center/cover no-repeat;
        padding: 90px 0;
        color: #fff;
        margin-bottom: 50px;
    }
    .global-breadcrumb-banner a {
        color: #a8cfb4;
        text-decoration: none;
        font-weight: 500;
    }
    .global-breadcrumb-banner span {
        color: #f6c338;
    }
</style>

<div class="global-breadcrumb-banner text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">{{ $title }}</h2>
        <nav class="fw-semibold">
            <a href="/">Home</a> <span class="mx-2">/</span> 
            @if(isset($parent) && isset($parent_link))
                <a href="{{ $parent_link }}">{{ $parent }}</a> <span class="mx-2">/</span>
            @endif
            <span>{{ $title }}</span>
        </nav>
    </div>
</div>
