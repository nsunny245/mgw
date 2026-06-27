<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us',
                'content' => '<p><strong>Assalamu Alaikum,</strong></p><p>It is with great pleasure and a deep sense of responsibility that I introduce you to Makkah Gateway, your trusted partner for Hajj and Umrah pilgrimages. Our mission is to provide a seamless, spiritually enriching, and comfortable journey for every pilgrim who embarks on this sacred path with us.</p><p>At Makkah Gateway, we understand the profound significance of Hajj and Umrah in the lives of Muslims around the world. Our dedicated team works tirelessly to ensure that each aspect of your journey is meticulously planned and executed. From visa processing and flight arrangements to accommodation and guided tours, we strive to make your pilgrimage experience as smooth and fulfilling as possible.</p><p>Our comprehensive packages are designed to cater to the diverse needs of our clients, whether you are embarking on this journey for the first time or are a seasoned pilgrim. We collaborate with top-tier service providers and local experts to offer you the highest standards of comfort, safety, and convenience.</p><p>Innovation and customer satisfaction are at the heart of Makkah Gateway. We continuously seek to enhance our services by integrating the latest technology and adhering to best practices in the travel industry. Our online platform allows you to easily book and manage your travel arrangements, access essential information, and stay connected throughout your journey.</p><p>As we embark on this noble endeavor, we remain committed to upholding the values of integrity, transparency, and excellence. We are honored to accompany you on your spiritual journey and look forward to serving you with the utmost dedication and care.</p><p>Thank you for choosing Makkah Gateway. May your pilgrimage be blessed and your prayers answered.</p>',
                'meta_title' => 'About Us - Makkah Gateway',
                'meta_description' => 'Makkah Gateway is your trusted partner for Hajj and Umrah pilgrimages from the UK with top-tier accommodations and visa support.',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'contact-us'],
            [
                'title' => 'Contact Us',
                'content' => '<h3>How can we help you?</h3><p>Contact us for solutions, suggestions, and assistance. Our team is available 24/7 to guide you through your spiritual journeys.</p>',
                'meta_title' => 'Contact Us - Makkah Gateway',
                'meta_description' => 'Contact Makkah Gateway for Umrah package quotes, flights, visa inquiries, and hotel support from the UK.',
            ]
        );
    }
}
