<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'visual', 'product_id'];

    public function values()
    {
        return $this->hasMany(VariationValue::class);
    }
}
