<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Makkah Gateway',
                'phone' => '0203 411 1934',
                'email' => 'info@makkahgateway.co.uk',
                'address' => 'Beacon House, Stokenchurch, High Wycombe, HP14 3FE, UK',
                'facebook_url' => 'https://www.facebook.com/makkahgateway',
                'instagram_url' => 'https://www.instagram.com/makkahgateway',
                'youtube_url' => 'https://www.youtube.com/makkahgateway',
                'linkedin_url' => 'https://www.linkedin.com/company/makkahgateway',
                'twitter_url' => 'https://twitter.com/makkahgateway',
                'whatsapp_number' => '447380888233',
            ]
        );
    }
}
