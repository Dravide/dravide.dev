<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'color',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
