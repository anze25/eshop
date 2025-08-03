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
        Schema::create('slide_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slide_id')
                ->constrained('slides')
                ->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('tagline')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->unique(['slide_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_translations');
    }
};
