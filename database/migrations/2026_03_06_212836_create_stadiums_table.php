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
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->foreingId('managerId')->constrained('users')->onDelete('cascade');
            $table->string('name',100);
            $table->string('city',100);
            $table->string('address',100);
            $table->integer('capacity');
            $table->text('description')->nullable();
            $table->text('equipments')->nullable;
            $table->enum('status', ['available', 'reserved', 'not working']);
            $table->float('price_per_hour', 10, 2);
            $table->string('stadium_image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadiums');
    }
};
