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
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('content');
            $table->string('nick_name');
            $table->string('location');
            $table->tinyInteger('gender');
            $table->string('avatar')->nullable();
            $table->Integer('credit_points');
            $table->timestamp('create_date');
            $table->foreign('id')->references('id')->on('users');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
