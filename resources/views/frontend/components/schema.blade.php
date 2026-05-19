@php
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'TravelAgency',
    'name' => 'Makkah Gateway',
    'url' => url('/'),
    'logo' => asset('images/logo-makkah.png'),
    'telephone' => '+447000000000',
    'address' => [
        '@type' => 'PostalAddress',
        'addressCountry' => 'UK',
    ],
];
@endphp
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
