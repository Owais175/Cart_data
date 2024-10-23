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
        Schema::table('payment', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->string('stripeToken')->nullable();
            $table->boolean('create_account')->default(false);
            $table->string('password')->nullable();
            $table->string('password_confirmation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment', function (Blueprint $table) {
            //
        });
    }
};
