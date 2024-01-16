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
        Schema::create('withdraw_history', function (Blueprint $table) {
            $table->id();
            $table->string('bill_code')->unique();
            $table->tinyInteger('status')->comment('1:success - 2:proccessing 3:fail');
            $table->double('eth',10,2);
            $table->double('vnd',10,2);
            $table->integer('user_id');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('bank');
            $table->timestamp('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_history');
    }
};
