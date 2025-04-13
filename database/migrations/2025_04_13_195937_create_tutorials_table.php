<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();                                // id
            $table->string('title');                     // title
            $table->string('course_code');               // course_code
            $table->string('url_presentation')->nullable(); // url_presentation
            $table->string('url_finished')->nullable();     // url_finished
            $table->string('creator_email');             // creator_email
            $table->timestamps();                        // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};
