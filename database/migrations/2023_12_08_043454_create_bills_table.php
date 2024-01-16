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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_code')->unique();
            $table->tinyInteger('status')->comment('1:success - 2:proccessing 3:fail');
            $table->double('eth',10,2);
            $table->double('vnd',10,2);
            $table->bigInteger('user_id');
            $table->bigInteger('recharger_id');
            $table->timestamp('create_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
