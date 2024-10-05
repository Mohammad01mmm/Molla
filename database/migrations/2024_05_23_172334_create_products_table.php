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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('code')->unique();
            $table->string('title');
            $table->text('slag_url');
            $table->text('tags');
            $table->string('status_off');
            $table->string('number_off')->nullable();
            $table->string('time_off')->nullable();
            $table->string('unit_time_off')->nullable();
            $table->string('final_date_off')->nullable();
            $table->string('date_at_off')->nullable();
            $table->text('description');
            $table->text('image');
            $table->text('images');
            $table->enum('status', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
