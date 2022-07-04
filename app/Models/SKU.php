<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    use HasFactory;

    protected $table = 'skus';

    protected $fillable = [
        'barcode',
        'activity',
        'weight',
        'price',
        'stock',
        'product_id',
    ];

    protected $casts = [
        'activity' => 'boolean',
        'weight' => 'integer',
        'price' => MoneyCast::class,
        'stock' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variationValues()
    {
        return $this->belongsToMany(VariationValue::class, 'product_variations', 'sku_id');
    }

    public function getPriceValueAttribute()
    {
        return $this->attributes['price'];
    }

    public function getVariationArray()
    {
        $result = (array) collect($this->variationValues)->reduce(function ($result, $item) {
            $result[$item->variationOption->name] = $item->value;
            return $result;
        }, []);

        return $result;
    }

    public static function buildVariationValueToString(array $variation)
    {
        $output = implode(', ', array_map(
            function ($v, $k) {
                if(is_array($v)){
                    return $k.'[]='.implode('&'.$k.'[]:', $v);
                }else{
                    return $k.':'.$v;
                }
            }, 
            $variation, 
            array_keys($variation)
        ));

        return $output;
    }
}
