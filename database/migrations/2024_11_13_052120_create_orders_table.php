<?php

use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('name_P');
            $table->string('email_P');
            $table->string('phone_P');
            $table->string('address_P');
            $table->text('note')->nullable();
            $table->string('status_order')->default(Order::CHO_XAC_NHAN);
            $table->string('momo_order_id')->nullable();
            $table->string('status_pay')->default(Order::CHUA_THANH_TOAN);
            $table->double('payment');
            $table->double('ship');
            $table->double('total_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
