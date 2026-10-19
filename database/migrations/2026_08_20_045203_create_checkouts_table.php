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
        Schema::create('checkouts', function (Blueprint $table) {
             $table->id();
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
             $table->enum('payment_method', ['Free', 'Virtual Account', 'QRIS']); //enum adalah data yang bersifat pilihan
             $table->integer('total_book'); //harga buku
             $table->integer('total_book_price'); //total harga buku & pajak
             $table->enum('status', ['Pending', 'Done']);
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
