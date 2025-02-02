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
            $table->integer('business_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['free', 'paid']);
            $table->decimal('price', 10, 2)->nullable(); //for paid deals
            $table->date('expiry_date');
            $table->boolean('is_featured')->default(false);
            // $table->date('expiration_date');
            // $table->string('image')->nullable();
            // $table->string('image_url')->nullable();
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
