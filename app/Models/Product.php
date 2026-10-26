<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'format',
        'short_description',
        'full_description',
        'ingredients',
        'directions',
        'storage',
        'price',
        'currency',
        'size',
        'stock_status',
        'stock_quantity',
        'image_main',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Auto-generate slug when creating/updating if it's empty
    protected static function booted()
    {
        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);

                // Ensure uniqueness by appending a number if needed
                $originalSlug = $product->slug;
                $count = 1;
                while (static::where('slug', $product->slug)
                    ->where('id', '!=', $product->id ?? 0)
                    ->exists()) {
                    $product->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}