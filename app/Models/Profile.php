<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'avatar',
        'email',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'facebook_url',
        'whatsapp_number',
    ];
}
