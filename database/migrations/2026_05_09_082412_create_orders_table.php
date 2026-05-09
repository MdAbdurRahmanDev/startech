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
        Schema::create('orders', function (Blueprint $row) {
            $row->id();
            $row->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $row->string('order_number')->unique();
            $row->string('first_name');
            $row->string('last_name');
            $row->string('email');
            $row->string('phone');
            $row->text('address');
            $row->string('upazila')->nullable();
            $row->string('district')->nullable();
            $row->text('note')->nullable();
            $row->foreignId('shipping_method_id')->nullable()->constrained()->onDelete('set null');
            $row->decimal('shipping_cost', 10, 2)->default(0);
            $row->decimal('subtotal', 10, 2);
            $row->decimal('total', 10, 2);
            $row->string('payment_method')->default('cash_on_delivery');
            $row->enum('status', ['pending', 'on_the_way', 'delivered', 'rejected'])->default('pending');
            $row->timestamps();
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
