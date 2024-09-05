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
        Schema::create('product', function (Blueprint $table) {
            //$table->id(); // bigint , autoincrement , primary_key

            $table->increments('id');
            $table->string('name', 200); // do dai la 200 mac dinh la 255 , ten fields la : name
            $table->text('description');
            $table->timestamps(); // auto created_at va updated_at => timestamp
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
