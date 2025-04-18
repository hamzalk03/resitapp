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
        Schema::create('resitexam_details', function (Blueprint $table) {
            $table->id();
            $table->date('exam_date')->nullable();
            $table->string('exam_time')->nullable();
            $table->string('exam_hall')->nullable();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resitexam_details');
    }
};
