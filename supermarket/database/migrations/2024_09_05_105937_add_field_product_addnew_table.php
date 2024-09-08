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
        if (Schema::hasTable('product')) {
            Schema::table('product', function (Blueprint $table) {
                $table->string('addnew', 200)->nullable();
                $table->string('descriptionnew', 255)->nullable();
                $table->string('descriptionnew2', 255)->nullable();
                $table->string('descriptionnew3', 255)->nullable();
                $table->string('descriptionnew4', 255)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            // Xóa các cột theo thứ tự ngược lại so với khi thêm
            if (Schema::hasColumn('product', 'descriptionnew4')) {
                $table->dropColumn('descriptionnew4');
            }
            if (Schema::hasColumn('product', 'descriptionnew3')) {
                $table->dropColumn('descriptionnew3');
            }
            if (Schema::hasColumn('product', 'descriptionnew2')) {
                $table->dropColumn('descriptionnew2');
            }
            if (Schema::hasColumn('product', 'descriptionnew')) {
                $table->dropColumn('descriptionnew');
            }
            if (Schema::hasColumn('product', 'addnew')) {
                $table->dropColumn('addnew');
            }
        });
    }
};
