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
            // $table->enum('category', ['food_beverage', 'professional_services', 'leisure_entertainment', 'finance_banking', 'health_fitness', 'beauty_personal_care', 'home_household', 'apparel_accessories']); //->default('restaurant')
            $table->integer('user_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->boolean('is_featured')->default(false);
            $table->boolean('approved')->default(false);
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
