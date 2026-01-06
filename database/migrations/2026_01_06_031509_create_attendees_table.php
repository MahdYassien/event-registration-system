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
    Schema::create('attendees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique(); // Unique index prevents duplicate emails
        $table->string('phone')->nullable(); // Optional field
        $table->string('company')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
