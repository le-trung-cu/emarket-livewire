<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\SKU;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Collection $orders)
    {

        $orders->each(function($order) {
            
            if($order->id == 1){
                $skus = SKU::find([1,4]);
            }else {
                $skus = SKU::inRandomOrder()->limit(2)->get();
            }

            OrderItem::factory()->create([
                'order_id' => $order->id,
                'product_name' => $skus->get(0)->product->name,
                'variation_string' => SKU::buildVariationValueToString($skus->get(0)->getVariationArray()),
                'sku_id' => $skus->get(0)->id,
            ]);

            OrderItem::factory()->create([
                'order_id' => $order->id,
                'product_name' => $skus->get(1)->product->name,
                'variation_string' => SKU::buildVariationValueToString($skus->get(1)->getVariationArray()),
                'sku_id' => $skus->get(1)->id,
            ]);
        });
    }
}
