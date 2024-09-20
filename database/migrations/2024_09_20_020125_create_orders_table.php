<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('status');
            $table->timestamps();

            $table->unsignedBigInteger('user_id');  // Dùng kiểu dữ liệu unsignedBigInteger
            $table->foreign('user_id')->references(columns: 'id')->on('users')->onDelete('cascade');  // Khoá ngoại với cascade khi xóa category


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};