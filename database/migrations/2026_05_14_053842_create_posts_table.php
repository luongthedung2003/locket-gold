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
        Schema::create('posts', function (Blueprint $description) {
            $description->id();
            $description->string('title');
            $description->string('slug')->unique();
            $description->string('image')->nullable();
            $description->text('excerpt')->nullable();
            $description->longText('content');
            $description->string('category')->default('News');
            $description->string('video_url')->nullable();
            $description->boolean('is_published')->default(true);
            $description->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
