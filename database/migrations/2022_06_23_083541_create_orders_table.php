<?php

use App\Models\Order;
use App\Models\StoreBranch;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StoreBranch::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(User::class, 'buyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignIdFor(Order::class, 'group_id')->nullable()->constrained('orders')->cascadeOnDelete();
            // tiền phải thanh toán
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedInteger('shipping_fee')->default(0);

            $table->unsignedInteger('discount')->default(0);

            $table->integer('service_type_id_ghn')->default(1);
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('shipping_address');
            $table->string('ward_code');
            $table->unsignedInteger('district_id');
            $table->string('order_code_ghn')->nullable();
            $table->string('print_token_ghn')->nullable();

            $table->enum('shipping_payment_type', ['shop_pay', 'buyer_pay'])->default('buyer_pay');
            $table->enum('payment_type', ['cash', 'credit_card', 'bank_transfer', 'paypal'])->default('cash');
            $table->enum('status', ['pending', 'registered', 'packing', 'sent', 'complated', 'canceled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'success', 'fail'])->default('unpaid');
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
        Schema::dropIfExists('orders');
    }
};
