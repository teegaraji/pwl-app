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
        Schema::table('tutorials', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('tutorials', 'kode_matkul')) {
                $table->string('kode_matkul')->nullable();
            }

            if (!Schema::hasColumn('tutorials', 'nama_matkul')) {
                $table->string('nama_matkul')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutorials', function (Blueprint $table) {
            if (Schema::hasColumn('tutorials', 'kode_matkul')) {
                $table->dropColumn('kode_matkul');
            }

            if (Schema::hasColumn('tutorials', 'nama_matkul')) {
                $table->dropColumn('nama_matkul');
            }
        });
    }
};
