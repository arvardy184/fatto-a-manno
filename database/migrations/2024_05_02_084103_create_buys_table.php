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
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('payment_method');
            $table->integer('payment_status');
            $table->unsignedBigInteger('cloth_id');
            $table->unsignedBigInteger('user_id');
            $table->string('payment_url')->nullable();
            $table->timestamps();

            $table->foreign('cloth_id')->references('id')->on('cloths')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buys');
    }
};
