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
        if (!Schema::hasTable('orders_products')) {
            Schema::create('orders_products', function (Blueprint $table) {
                $table->id(); // Unique ID for each order item
                $table->unsignedBigInteger('orders_id'); // Foreign key referencing orders table
                $table->unsignedBigInteger('order_products_product_id')->nullable(); // Product ID
                $table->string('order_products_name'); // Product name
                $table->decimal('order_products_price', 10, 2); // Product price
                $table->integer('order_products_qty'); // Quantity of the product
                $table->decimal('order_products_subtotal', 10, 2); // Subtotal for this item
                $table->text('variants')->nullable(); // Variants if any
                // Foreign key constraint
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->timestamps(); // Automatically manage created_at and updated_at columns
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_products');
    }
};
