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
        Schema::create('task_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // assuming you have a 'users' table
            $table->string('title');
            $table->text('description');
            $table->text('requirement');
            $table->decimal('salary');
            $table->enum('location', ['UTHM Parit Raja', 'UTHM Pagoh']); // predefined locations
            $table->string('location_detail'); // exact location details
            $table->date('deadline');
            $table->enum('status', ['available', 'not_available'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_postings');
    }
};
