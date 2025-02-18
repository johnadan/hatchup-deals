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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('phone_number');
            // $table->enum('category', ['food_beverage', 'professional_services', 'leisure_entertainment', 'finance_banking', 'health_fitness', 'beauty_personal_care', 'home_household', 'apparel_accessories']); //->default('restaurant')
            // $table->integer('category_id')->unsigned();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('city_id')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
