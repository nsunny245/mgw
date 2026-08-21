@php
    $base = url('/');
    $atol = $settings->atol_number ?? '11941';
    $companyName = 'Makkah Gateway';
    $logoUrl = asset('images/logo-footer.png');
    $phone = $settings->phone ?? '0203 411 1934';
    $email = $settings->email ?? 'info@makkahgateway.co.uk';
    $address = $settings->address ?? 'Beacon House, Stokenchurch, High Wycombe, HP14 3FE, UK';

    $schemas = [];

    // 1. Homepage Schemas
    if (request()->is('/')) {
        // Organization
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $companyName,
            'url' => $base,
            'logo' => $logoUrl,
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $phone,
                'contactType' => 'customer service',
                'areaServed' => 'GB',
                'availableLanguage' => 'English'
            ],
            'sameAs' => array_filter([
                'https://www.facebook.com/makkahgatewayuk',
                'https://www.instagram.com/makkah_gateway/',
                'https://www.youtube.com/@makkahgatewayuk'
            ])
        ];

        // TravelAgency
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => $companyName,
            'url' => $base,
            'logo' => $logoUrl,
            'image' => asset('frontend/images/hero-bg.png'),
            'telephone' => $phone,
            'email' => $email,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressLocality' => 'High Wycombe',
                'postalCode' => 'HP14 3FE',
                'addressCountry' => 'GB'
            ],
            'priceRange' => '££',
            'description' => 'Affordable and luxury Umrah packages from the UK, ATOL protected.'
        ];

        // WebSite
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $companyName,
            'url' => $base,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $base . '/?search={search_term_string}',
                'query-input' => 'required name=search_term_string'
            ]
        ];
    }

    // 2. Package Details Page Schema
    if (isset($package) && $package instanceof \App\Models\Package) {
        $packageUrl = route('package.show', $package->slug);
        $packageImage = $package->getFirstMediaUrl('packages') ?: asset('frontend/images/hero-bg.png');
        $currency = 'GBP';

        // Product with Offer
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $package->title,
            'image' => $packageImage,
            'description' => $package->short_description ?: $package->title,
            'brand' => [
                '@type' => 'Brand',
                'name' => $companyName
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => $packageUrl,
                'priceCurrency' => $currency,
                'price' => $package->price ?: '1500',
                'priceValidUntil' => date('Y-12-31'),
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability' => $package->status === 'Sold Out' ? 'https://schema.org/OutOfStock' : 'https://schema.org/InStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => $companyName
                ]
            ]
        ];

        // BreadcrumbList
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $base
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $package->category->name ?? 'Packages',
                    'item' => isset($package->category) ? route('category.show', $package->category->slug) : $base
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $package->title,
                    'item' => $packageUrl
                ]
            ]
        ];
    }

    // 3. Category Page Schema
    if (isset($category) && $category instanceof \App\Models\Category) {
        $categoryUrl = route('category.show', $category->slug);
        
        // CollectionPage
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $category->name,
            'url' => $categoryUrl,
            'description' => $category->meta_description ?: 'Browse ' . $category->name
        ];

        // ItemList for packages in category
        if (isset($packages) && $packages->count()) {
            $itemListElements = [];
            foreach ($packages as $index => $item) {
                $itemListElements[] = [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'url' => route('package.show', $item->slug)
                ];
            }
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'name' => $category->name,
                'itemListElement' => $itemListElements
            ];
        }

        // BreadcrumbList
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $base
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $category->name,
                    'item' => $categoryUrl
                ]
            ]
        ];
    }

    // 4. City Page Schema
    if (isset($city) && $city instanceof \App\Models\City) {
        $cityUrl = route('city.show', $city->slug);
        
        // CollectionPage
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $city->name,
            'url' => $cityUrl,
            'description' => $city->meta_description ?: 'Browse ' . $city->name
        ];

        // BreadcrumbList
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $base
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $city->name,
                    'item' => $cityUrl
                ]
            ]
        ];
    }

    // 5. Blog details Page Schema
    if (isset($blog) && $blog instanceof \App\Models\Blog) {
        $blogUrl = route('blog.show', $blog->slug);
        $blogImage = $blog->getFirstMediaUrl('blogs') ?: asset('frontend/images/hero-bg.png');

        // BlogPosting
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $blog->title,
            'image' => $blogImage,
            'datePublished' => $blog->created_at->toIso8601String(),
            'dateModified' => $blog->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => $companyName
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $companyName,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $logoUrl
                ]
            ],
            'description' => $blog->meta_description ?: $blog->title
        ];

        // BreadcrumbList
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $base
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Blog',
                    'item' => route('blog.index')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $blog->title,
                    'item' => $blogUrl
                ]
            ]
        ];
    }

    // Apply custom schema overrides if available on the active model's relation
    $activeModel = null;
    if (isset($package)) $activeModel = $package;
    elseif (isset($category)) $activeModel = $category;
    elseif (isset($city)) $activeModel = $city;
    elseif (isset($blog)) $activeModel = $blog;
    elseif (isset($page)) $activeModel = $page;

    if ($activeModel && $activeModel->relationLoaded('seo') && $activeModel->seo && $activeModel->seo->schema_overrides) {
        $schemas[] = $activeModel->seo->schema_overrides;
    }
@endphp

@foreach($schemas as $s)
    <script type="application/ld+json">{!! json_encode($s, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endforeach
