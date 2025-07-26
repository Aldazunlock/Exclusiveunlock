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
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('brand_model_id')->constrained('brand_models');
            $table->string('device_number');
            $table->string('color');
            $table->string('provider');
            $table->string('device_password');
            $table->text('fault_discription');
            $table->decimal('cost', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->boolean('power_on');
            $table->boolean('charging');
            $table->boolean('network');
            $table->boolean('display');
            $table->boolean('camera');
            $table->boolean('battery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
