<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                          // Kolom id (auto increment)
            $table->string('name');               // Kolom name (varchar)
            $table->string('email')->unique();    // Kolom email (unik)
            $table->string('password');           // Kolom password
            $table->timestamps();                 // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
