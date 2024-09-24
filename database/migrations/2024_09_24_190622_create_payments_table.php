<?php

use App\Models\Order;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('payment_method')->default('credit card'); // e.g., "credit card", "PayPal"
            $table->float('amount');
            $table->string('payment_status')->default('pending'); // e.g., "pending", "success", "failed"
            $table->string('transaction_id')->nullable(); // unique transaction ID from the payment gateway
            $table->text('payment_response')->nullable(); // payment gateway response (for debugging purposes)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
