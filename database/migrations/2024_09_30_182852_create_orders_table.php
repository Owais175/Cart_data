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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Unique ID for the order
            $table->unsignedBigInteger('user_id')->nullable(); // Optional, for logged in users
            $table->string('fname'); // First name
            $table->string('lname'); // Last name
            $table->string('email'); // Email address
            $table->string('phone'); // Phone number
            $table->string('address'); // Delivery address
            $table->string('city'); // City
            $table->string('state'); // State
            $table->string('country'); // Country
            $table->string('zip'); // Zip code
            $table->integer('order_items'); // Total number of items in the order
            $table->decimal('order_item_total', 10, 2); // Subtotal for the order
            $table->decimal('order_shipping', 10, 2); // Shipping cost
            $table->decimal('order_total', 10, 2); // Total order cost
            $table->string('payment_method'); // Payment method (e.g., PayPal, Stripe)
            $table->string('transaction_id'); // Transaction ID for payment
            $table->string('order_status')->default('pending'); // Order status (e.g., pending, completed)
            $table->timestamps(); // Timestamps for created_at and updated_at
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
