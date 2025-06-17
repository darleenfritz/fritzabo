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
        Schema::create('billingcycles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // z. B. "Monatlich", "Jährlich"
            $table->integer('interval_in_days'); // z. B. 30, 365, 90, 7
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billingcycles');
    }
};
