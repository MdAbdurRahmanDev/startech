<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['flat', 'percent'])->default('flat'); // flat = fixed amount, percent = percentage
            $table->decimal('value', 10, 2); // discount value
            $table->decimal('min_order', 10, 2)->default(0); // minimum order amount to use
            $table->decimal('max_discount', 10, 2)->nullable(); // max discount cap for percent type
            $table->integer('max_uses')->nullable(); // total uses allowed (null = unlimited)
            $table->integer('used_count')->default(0); // how many times used
            $table->date('expires_at')->nullable(); // expiry date
            $table->boolean('status')->default(1); // 1=active, 0=inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
