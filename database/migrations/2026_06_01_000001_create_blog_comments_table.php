<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->text('comment');

            // 1 = approved/visible, 0 = pending/hidden
            $table->boolean('status')->default(0);

            $table->timestamps();

            $table->index(['blog_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};

