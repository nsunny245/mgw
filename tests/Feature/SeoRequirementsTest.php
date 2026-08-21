<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoRequirementsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed target categories
        $categories = [
            'easter-umrah-packages' => 'Easter Umrah Packages',
            'ramadan-umrah' => 'Ramadan Umrah',
            'group-umrah-packages' => 'Group Umrah Packages',
            'cheap-umrah' => 'Cheap Umrah',
            '3-star-umrah' => '3 Star Umrah',
            '4-star-umrah' => '4 Star Umrah',
            '5-star-umrah' => '5 Star Umrah',
        ];

        foreach ($categories as $slug => $name) {
            Category::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }

        // Seed target cities
        $cities = [
            'london' => 'London',
            'manchester' => 'Manchester',
            'birmingham' => 'Birmingham',
            'bradford' => 'Bradford',
        ];

        foreach ($cities as $slug => $name) {
            City::firstOrCreate(['slug' => $slug], ['name' => $name]);
        }
    }

    /**
     * Data provider for target URLs and their expected SEO metadata.
     */
    public static function seoTargetProvider(): array
    {
        return [
            // Calendar Months
            ['/umrah-calendar/january', 'January Umrah Packages | Best UK Umrah Deals 2027', 'Discover affordable January Umrah Packages from the UK.', 'January Umrah Packages'],
            ['/umrah-calendar/february', 'February Umrah Packages 2027 | UK Mid Term Deals', 'Book February Umrah Packages 2027 from the UK.', 'February Umrah Packages'],
            ['/umrah-calendar/march', 'March Umrah Packages | 5 Star Family Umrah Deals', 'Explore March Umrah Packages from the UK with 5-star hotels,', 'March Umrah Packages'],
            ['/umrah-calendar/april', 'April Umrah Packages 2027 | Best UK Umrah Deals', 'Book April Umrah Packages 2027 from the UK with trusted service,', 'April Umrah Packages 2027'],
            ['/umrah-calendar/may', 'May Umrah Packages 2027 | Trusted UK Umrah Deals', 'Book May Umrah Packages 2027 from the UK with trusted service,', 'May Umrah Packages'],
            ['/umrah-calendar/june', 'June Umrah Packages UK 2027 | Best Umrah Deals', 'Explore June Umrah Packages UK 2027 with trusted service,', 'June Umrah Packages UK 2027'],
            ['/umrah-calendar/july', 'July Umrah Packages UK 2027 | Trusted Umrah Deals', 'Book July Umrah Packages UK 2027 with trusted service,', 'July Umrah Packages'],
            ['/umrah-calendar/august', 'August Umrah Packages 2026 | Best UK Holiday Deals', 'Book August Umrah Packages 2026 from the UK with premium hotels,', 'August Umrah Packages 2026'],
            ['/umrah-calendar/september', 'September Umrah Packages | Best UK Umrah Deals 2026', 'Book September Umrah Packages from the UK with premium hotels,', 'September Umrah Packages'],
            ['/umrah-calendar/october', 'October Umrah Packages | Affordable UK Deals 2026', 'Discover October Umrah Packages from the UK with trusted service,', 'October Umrah Packages'],
            ['/umrah-calendar/november', 'November Umrah Packages | Best UK Deals for 2026', 'Book November Umrah Packages from the UK with trusted service,', 'November Umrah Packages'],
            ['/umrah-calendar/december', 'December Umrah Packages From UK | Makkah Gateway', 'Book December Umrah Packages from the UK with premium hotels,', 'December Umrah Packages'],

            // Categories
            ['/category/easter-umrah-packages', 'Easter Umrah Packages | Best UK Holiday Deals', 'Book Easter Umrah Packages from the UK with premium hotels,', 'Easter Umrah Packages'],
            ['/category/ramadan-umrah', 'Ramadan Umrah Packages 2027 | Best UK Ramadan Deals', 'Book Ramadan Umrah Packages 2027 from the UK.', 'Ramadan Umrah Packages 2027'],
            ['/category/group-umrah-packages', 'Group Umrah Packages | Affordable UK Group Deals', 'Explore Group Umrah Packages from the UK with trusted guides,', 'Group Umrah Packages'],
            ['/category/cheap-umrah', 'Cheap Umrah Packages | Affordable Family Deals UK', 'Discover Cheap Umrah Packages from the UK with trusted service,', 'Cheap Umrah Packages'],
            ['/category/3-star-umrah', '3 Star Umrah Packages | Affordable Family Deals UK', 'Book 3 Star Umrah Packages from the UK with comfortable hotels,', '3 Star Umrah Packages'],
            ['/category/4-star-umrah', '4 Star Umrah Packages | Premium UK Holiday Deals', 'Discover 4 Star Umrah Packages from the UK with quality hotels,', '4 Star Umrah Packages'],
            ['/category/5-star-umrah', '5 Star Umrah Packages | Luxury UK Umrah Deals', 'Experience 5 Star Umrah Packages from the UK with luxury hotels,', '5 Star Umrah Packages'],

            // Cities
            ['/umrah-packages-london', 'London Umrah Packages | Trusted UK Umrah Deals', 'Book London Umrah Packages with trusted service, premium hotels and flexible departures.', 'London Umrah Packages'],
            ['/umrah-packages-manchester', 'Manchester Umrah Packages | Makkah Gateway UK', 'Book Manchester Umrah Packages with trusted service, premium hotels and flexible departures.', 'Manchester Umrah Packages'],
            ['/umrah-packages-birmingham', 'Birmingham Umrah Packages | Trusted UK Umrah Deals', 'Book trusted Birmingham Umrah Packages with premium hotels, family-friendly options and expert UK support.', 'Birmingham Umrah Packages'],
            ['/umrah-packages-bradford', 'Bradford Umrah Packages | Trusted UK Umrah Deals', 'Explore trusted Bradford Umrah Packages with family-friendly options, quality hotels and expert UK support.', 'Bradford Umrah Packages'],
        ];
    }

    /**
     * @dataProvider seoTargetProvider
     */
    public function test_target_urls_have_correct_status_and_seo_attributes(string $url, string $expectedTitle, string $expectedDescPart, string $expectedH1): void
    {
        $response = $this->get($url);
        $response->assertStatus(200);

        // Assert Title is present and matches
        $response->assertSee('<title>' . $expectedTitle . '</title>', false);

        // Assert Meta Description contains the expected keyword/phrase snippet
        $response->assertSee($expectedDescPart, false);

        // Assert H1 contains the primary keyword
        $response->assertSee($expectedH1, false);
    }

    public function test_index_php_redirects_to_clean_path(): void
    {
        $request = \Illuminate\Http\Request::create('http://localhost/index.php/about-us', 'GET');
        $middleware = new \App\Http\Middleware\EnforceSeoNormalsMiddleware();

        $response = $middleware->handle($request, function() {
            return response('OK');
        });

        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals('http://localhost/about-us', $response->headers->get('Location'));
    }

    public function test_trailing_slash_redirects_to_clean_path(): void
    {
        $request = \Illuminate\Http\Request::create('http://localhost/about-us/', 'GET');
        $middleware = new \App\Http\Middleware\EnforceSeoNormalsMiddleware();

        $response = $middleware->handle($request, function() {
            return response('OK');
        });

        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals('http://localhost/about-us', $response->headers->get('Location'));
    }

    public function test_robots_txt_contains_correct_directives(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath);
        
        $content = file_get_contents($robotsPath);
        $this->assertStringContainsString('User-agent: *', $content);
        $this->assertStringContainsString('Disallow: /admin/', $content);
        $this->assertStringContainsString('Sitemap: https://www.makkahgateway.co.uk/sitemap.xml', $content);
    }
}
