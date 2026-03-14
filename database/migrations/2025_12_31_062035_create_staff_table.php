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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', length:100);
            $table->string('lastname', length:100);
            $table->string('email', length:150);
            $table->string('password', length:200);
            $table->string('phoneNumber', length:100);
            $table->string('address', length:200);
            $table->string('profile_pic', length:200)->nullable();
            $table->date('dob');
            $table->boolean('is_admin')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
