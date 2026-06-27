<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'slug',
        'price',
        'original_price',
        'unit',
        'min_order',
        'weight',
        'stock_status',
        'preorder_days',
        'preorder_unit',
        'description',
        'is_featured',
        'status',
        'tags',
        'shipping_note',
        'dimension_length',
        'dimension_width',
        'dimension_height',
        'views_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'min_order' => 'integer',
        'weight' => 'integer',
        'preorder_days' => 'integer',
        'tags' => 'array',
        'dimension_length' => 'decimal:2',
        'dimension_width' => 'decimal:2',
        'dimension_height' => 'decimal:2',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage(): HasMany
    {
        return $this->hasMany(ProductImage::class)->where('is_primary', true);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function wishlistedBy(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
