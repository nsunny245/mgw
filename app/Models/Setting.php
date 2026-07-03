<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'phone',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'twitter_url',
        'whatsapp_number',
        'google_analytics_id',
        'google_tag_manager_id',
        'google_search_console_meta',
        'custom_head_scripts',
        'custom_body_scripts',
        'notification_emails',
        'pusher_app_id',
        'pusher_app_key',
        'pusher_app_secret',
        'pusher_app_cluster',
    ];
}
