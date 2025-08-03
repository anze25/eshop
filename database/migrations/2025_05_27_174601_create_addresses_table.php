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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('street_address');
            $table->string('address_line_2')->nullable(); // Apt, suite, etc.
            $table->string('postal_code');
            $table->string('city');
            $table->string('state_province_region')->nullable(); // Optional per country
            $table->string('country');
            $table->string('phone_number')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->boolean('isdefault')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
