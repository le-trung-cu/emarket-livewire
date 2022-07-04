<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use Sluggable, NodeTrait {
        Sluggable::replicate as slugReplicate;
        NodeTrait::replicate as nodeReplicate;
    }

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function replicate(array $except = null)
    {
        $instance = $this->nodeReplicate($except);

        (new SlugService())->slug($instance, true);

        return $instance;
    }
}
