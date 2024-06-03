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
            $table->string('name');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->boolean('email_verified')->default(false);
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

    //have done this in model hence commented
    // while selecting data from table password shoul not 
    // be selected so we can use hidden property
    // public function hidden(): array
    // {
    //     return ['password'];
    // }

    // //password should be hashed before saving to database use casted property
    // public function casted(): array
    // {
    //     return ['password' => 'password'];
    // }
 

    

};
