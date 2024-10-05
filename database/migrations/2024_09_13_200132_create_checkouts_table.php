<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->longText('user');
            $table->text('product_id');
            $table->string('total_price'); // مجموع قیمت های محصولات
            $table->string('total_price_payable'); // مجموع قیمت قابل پرداخت
            $table->enum('payment_gateway', ['zarinpal', 'melat', 'meli', 'shapark'])->default('zarinpal');
            $table->string('transaction_id'); // شناسه تراکنش درگاه بانکی
            $table->enum('status', ['successful', 'failed'])->default('successful'); // وضعیت پرداخت
            $table->text('discription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
