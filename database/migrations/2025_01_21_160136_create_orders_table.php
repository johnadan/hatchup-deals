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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned(); //user_id
            $table->integer('deal_id')->unsigned();
            $table->timestamp('order_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_status', ['pending', 'completed', 'failed']); // free - auto completed
            // $table->enum('status', ['claimed', 'paid'])->default('claimed'); //For free or paid deals
            $table->string('payment_id')->nullable(); //Payment gateway ID for 'paid' deals
            // $table->timestamp('claim_date')->useCurrent();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
