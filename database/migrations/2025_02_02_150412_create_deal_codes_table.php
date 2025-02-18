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
        Schema::create('deal_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->string('deal_code');
            $table->boolean('is_claimed');
            $table->timestamps(); //claimed at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_codes');
    }
};
