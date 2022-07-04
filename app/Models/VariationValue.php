<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'label',
        'variation_option_id',
    ];

    public function variationOption()
    {
        return $this->belongsTo(VariationOption::class);
    }
}
