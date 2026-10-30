<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();       // owner
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('title', 60);
            $table->string('description', 155);   // the 3–155 character post from the SRS
            $table->unsignedInteger('price')->default(0);
            $table->string('city', 30);
            $table->timestamps();

            $table->index(['category_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
