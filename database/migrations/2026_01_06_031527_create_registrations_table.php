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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            // Foreign Keys
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('attendee_id')->constrained()->onDelete('cascade');

            $table->timestamp('registration_date')->useCurrent();
            $table->enum('status', ['confirmed', 'waitlisted', 'cancelled'])->default('confirmed');
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
