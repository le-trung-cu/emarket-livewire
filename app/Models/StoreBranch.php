<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBranch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'district_id', 'ward_code', 'shop_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
