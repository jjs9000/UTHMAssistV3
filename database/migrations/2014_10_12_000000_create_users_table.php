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
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('name')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('ic');
                $table->text('bio')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->enum('usertype', ['user', 'admin'])->default('user');
                $table->enum('gender', ['male', 'female']);
                $table->string('password');
                $table->date('date_of_birth');
                $table->string('contact_number');
                $table->string('address');
                $table->string('post_code');
                $table->string('city');
                $table->string('state');
                $table->rememberToken();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
