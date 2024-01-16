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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->string('image');
            $table->double('price',10,5);
            $table->tinyInteger('status'); // 1. đã phê duyệt và đang đấu giá - 2. đấu giá đã hết hạn - 3. đấu giá chờ phê duyệt - 4. đấu giá bị cấm hoặc không phê duyệt
            $table->timestamp('create_date');
            $table->timestamp('begin_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->Integer('view');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user_info');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
