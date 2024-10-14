<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('購入者');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method',['convenience_store','credit_card','bank_transfer'])->default('credit_card'); //支払い方法
            $table->enum('order_status',['pending','paid','cancelled'])->default('pending'); //支払い状態
            $table->decimal('amount', 8, 2)->nullable(); //支払い金額
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
}
