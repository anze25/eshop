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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
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

        
            $table->string('payment_method')->nullable(); // e.g., 'card', 'cod'
            $table->string('payment_status')->default('pending'); // e.g., 'pending', 'paid', 'failed'
            $table->string('stripe_payment_id')->nullable()->index(); // For Stripe's transaction ID
          

            $table->string('type')->default('home');
            $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered');
            $table->boolean('is_shipping_different')->default(false);
            $table->date('delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
