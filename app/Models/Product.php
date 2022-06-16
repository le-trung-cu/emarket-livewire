<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'regular_price',
        'store_branch_id',
        'category_id',
    ];

    protected $casts = [
        // 'regular_price' => 'decimal',
    ];

    public function store()
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

    public function registerMediaConversions(Media $media = null): void
    {
        // The Collection component will show a preview thumbnail for items in the collection it is showing.
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
