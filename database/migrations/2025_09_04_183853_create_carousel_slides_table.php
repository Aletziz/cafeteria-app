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
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->string('button_text')->default('Ver Más');
            $table->string('button_url')->nullable();
            $table->string('background_gradient')->default('linear-gradient(135deg, #667eea 0%, #764ba2 100%)');
            $table->string('badge_text')->nullable();
            $table->string('badge_color')->default('bg-primary');
            $table->string('price')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_slides');
    }
};
