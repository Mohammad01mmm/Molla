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
        Schema::create('product_checkouts', function (Blueprint $table) {
            $table->id();
            $table->text('user'); // array
            $table->string('title');
            $table->string('code');
            $table->string('category');
            $table->string('slug_url');
            $table->string('status_off')->nullable();
            $table->string('number_off')->nullable();
            $table->enum('status', [0, 1]);
            $table->longText('properties'); // array
            $table->integer('count');
            $table->text('color'); // array
            $table->string('final_price'); // فاینال قیمت هر یه دونه
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_checkouts');
    }
};
