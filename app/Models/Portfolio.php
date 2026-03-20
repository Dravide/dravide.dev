<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'project_url',
        'source_url',
        'sort_order',
        'is_visible',
    ];

    public static function getCategories(): array
    {
        return [
            'Web App' => 'ti ti-world',
            'Mobile App' => 'ti ti-device-mobile',
            'Desktop App' => 'ti ti-device-desktop',
            'UI/UX Design' => 'ti ti-palette',
            'Backend' => 'ti ti-server',
            'Frontend' => 'ti ti-layout-navbar',
            'Fullstack' => 'ti ti-stack-2',
            'Other' => 'ti ti-box',
        ];
    }

    public function getCategoryIconAttribute(): string
    {
        $categories = self::getCategories();
        return $categories[$this->category] ?? 'ti ti-box';
    }

    protected $appends = ['category_icon'];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function techStacks(): BelongsToMany
    {
        return $this->belongsToMany(TechStack::class, 'portfolio_tech_stack');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('sort_order');
    }
}
