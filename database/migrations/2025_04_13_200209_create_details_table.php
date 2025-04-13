<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();                            // id
            $table->foreignId('tutorial_id')        // tutorial_id (relasi ke tabel tutorials)
                ->constrained('tutorials')
                ->onDelete('cascade');
            $table->text('text')->nullable();       // text (boleh kosong)
            $table->text('image')->nullable();      // image URL/path
            $table->text('code')->nullable();       // code snippet
            $table->text('url')->nullable();        // url eksternal (opsional)
            $table->integer('order')->default(0);   // urutan tampil
            $table->string('status')->default('draft'); // status (misal: draft, published)
            $table->timestamps();                   // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
