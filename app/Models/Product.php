<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Brick\Money\Money;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'regular_price',
        'status',
        'store_branch_id',
        'category_id',
    ];

    protected $casts = [
        // 'regular_price' => 'decimal',
        // 'status' => ProductStatus::class,
    ];

    public function storeBranch()
    {
        return $this->belongsTo(StoreBranch::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variationOptions()
    {
        return $this->hasMany(VariationOption::class);
    }

    public function variationValues()
    {
        return $this->hasManyThrough(VariationValue::class, VariationOption::class, 'product_id', 'variation_option_id', 'id', 'id');
        // return $this->hasManyThrough(VariationValue::class, VariationOption::class, 'a', 'b', 'c', 'd');
        // ^ "select * from `variation_values` inner join `variation_options` on `variation_options`.`d` = `variation_values`.`b` where `variation_options`.`a` is null"
    }

    public function skus()
    {
        return $this->hasMany(SKU::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product-galary')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('galary')
                    ->withResponsiveImages()
                    ->nonQueued();

                $this
                    ->addMediaConversion('preview')
                    ->width(56)
                    ->height(56)
                    ->nonQueued();
            });

        // 300x300; show in product index page
        $this->addMediaCollection('product-thumbnail')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                // 55x55; show in admin table
                $this
                    ->addMediaConversion('small')
                    ->width(55)
                    ->height(55)
                    ->nonQueued();
            });
    }

    public function getPriceVndAttribute()
    {
        return Money::of($this->attributes['regular_price'], 'VND')->formatTo('vn_VN');
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function similarProducts(int $count = 4)
    {
        return Product::query()
            ->has('skus')
            ->where('category_id', $this->category_id)
            ->whereNot('id', $this->id)
            ->limit($count)
            ->get();
    }
}
