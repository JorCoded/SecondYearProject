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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('discount_value', 8,2);
            $table->enum('type',['percentage','fixed']);
            $table->dateTime('starts_at')->index();
            $table->dateTime('ends_at')->index();
            $table->timestamps();
        });

        Schema::create('promotion_room',function(Blueprint $table){
            $table->foreignId('room_id')->constrained(table:'room', column:'id')->onDelete('cascade');
            $table->foreignId('promotion_id')->constrained()->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
