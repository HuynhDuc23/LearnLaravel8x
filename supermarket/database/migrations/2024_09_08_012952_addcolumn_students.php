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
        if (Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'name')) {
                $table->string('name')->unique();
                $table->mediumText('descriptions');
            }
        }));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique('students_name_unique');
        });
    }
};
