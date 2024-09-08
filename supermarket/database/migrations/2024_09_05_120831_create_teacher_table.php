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
        if (!Schema::hasTable('teacher')) {
            Schema::create('teacher', function (Blueprint $table) {
                $table->increments('id'); // Tạo cột id với kiểu auto-increment
                $table->string('name'); // Tạo cột name
                $table->integer('price'); // Tạo cột price
                $table->timestamps(); // Thêm cột created_at và updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('teacher');
        // if (Schema::hasTable('teacher')) {
        //     Schema::rename('teacher', 'giaovien');
        // }
        if (Schema::hasTable('teacher')) {
            Schema::dropIfExists('teacher');
        }
    }
};
