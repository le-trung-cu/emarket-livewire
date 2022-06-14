<?php

use App\Models\SKU;
use App\Models\VariationOption;
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
        Schema::create('variation_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('label');
            $table->foreignIdFor(VariationOption::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SKU::class, 'sku_id')->constrained('skus')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variation_values');
    }
};