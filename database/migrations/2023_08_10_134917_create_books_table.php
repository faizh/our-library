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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('BookTypeId');
            $table->string('BookName');
            $table->string('Description');
            $table->string('Publisher');
            $table->string('Year');
            $table->bigInteger('Stock');
            $table->timestamps();

            $table->foreign('BookTypeId')->references('id')->on('book_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
