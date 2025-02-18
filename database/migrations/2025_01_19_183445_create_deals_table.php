<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            // $table->integer('business_id')->unsigned();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            // $table->integer('category_id')->unsigned();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('city_id')->nullable();
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['free', 'paid']);
            $table->decimal('original_price', 10, 2); //0 for free
            $table->decimal('discounted_price', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('current_usage_count')->default(0);
            $table->integer('max_usage_limit');
            $table->boolean('is_active');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
