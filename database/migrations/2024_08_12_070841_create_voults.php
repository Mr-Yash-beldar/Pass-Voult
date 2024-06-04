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
        Schema::create('voults', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->notNullable();
            $table->string('category')->notNullable();
            $table->string('service_username')->notNullable();
            $table->string('service_email')->notNullable();
            $table->string('service_url')->notNullable();
            $table->string('service_password')->notnullable();
            $table->string('is_favourite')->default('false');
            //add picture of service
            $table->string('service_logo')->default('https://img.icons8.com/?size=100&id=12505&format=png&color=000000');
            //voultid is for foreign key of users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voults');
    }
};
