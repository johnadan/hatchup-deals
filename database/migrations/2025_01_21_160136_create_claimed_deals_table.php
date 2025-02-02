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
        Schema::create('claimed_deals', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned(); //user_id
            $table->integer('deal_id')->unsigned();
            $table->enum('status', ['claimed', 'paid'])->default('claimed'); //For free or paid deals
            $table->string('payment_id')->nullable(); //Payment gateway ID for 'paid' deals
            $table->timestamp('claim_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed_deals');
    }
};
