<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('food_type', ['wings', 'rabokki', 'toppoki', 'fries', 'rice']);
            $table->integer('slot')->default(1);
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->timestamps();
            
            // Add unique constraint to prevent duplicate slots per food type
            $table->unique(['food_type', 'slot']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
};