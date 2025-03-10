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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id');
            $table->foreignId('user_id');
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('restrict') 
                ->onUpdate('restrict');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict') 
                ->onUpdate('restrict');
            $table->integer('price');    
            $table->date('start_date'); 
            $table->date('end_date'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
