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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id')->unsigned();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('favoriteable'); // Adds favoriteable_id and favoriteable_type
            // $table->enum('type', ['business', 'deal']); //->default('deal')
            // $table->integer('reference_id'); //business_id or deal_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
