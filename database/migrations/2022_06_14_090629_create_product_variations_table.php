<?php

use App\Models\SKU;
use App\Models\VariationValue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->foreignIdFor(SKU::class, 'sku_id')->constrained('skus')->cascadeOnDelete();
            $table->foreignIdFor(VariationValue::class)->constrained();
            $table->timestamps();

            $table->primary(['sku_id', 'variation_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
};
