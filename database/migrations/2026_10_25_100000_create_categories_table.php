<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 40)->unique();   // label is translated in lang/*/categories.php
            $table->string('icon', 8);
            $table->unsignedSmallInteger('sort')->default(0);
        });

        // Categories are reference data: the app cannot work without them,
        // so they are created together with the table (no seeding needed).
        $categories = [
            'wisdom' => '💡', 'motivation' => '🔥', 'faith' => '🕌',
            'love' => '❤️', 'success' => '🏆', 'life' => '🌿',
            'friendship' => '🤝', 'knowledge' => '📚', 'patience' => '⏳',
            'humor' => '😄', 'other' => '✨',
        ];

        $sort = 0;
        foreach ($categories as $slug => $icon) {
            DB::table('categories')->insert(['slug' => $slug, 'icon' => $icon, 'sort' => ++$sort]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
