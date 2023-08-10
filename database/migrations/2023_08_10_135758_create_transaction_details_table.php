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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('TransId');
            $table->unsignedBigInteger('BookId');
            $table->bigInteger('Qty');
            $table->date('ReturnDate');
            $table->bigInteger('FineDays');
            $table->bigInteger('Fine');
            $table->timestamps();

            $table->foreign('TransId')->references('id')->on('transactions');
            $table->foreign('BookId')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
