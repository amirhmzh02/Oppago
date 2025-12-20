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
        Schema::create('carousel_images', function (Blueprint $table) {
            $table->id();
            $table->integer('slot')->unique(); // Unique slot number
            $table->string('image_name');      // e.g., "slot1-slideshow.jpg"
            $table->string('original_name');   // Original uploaded filename
            $table->string('image_path');      // Storage path
            $table->string('mime_type');       // e.g., "image/jpeg"
            $table->integer('file_size');      // Size in bytes
            $table->timestamps();              // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_images');
    }
};
