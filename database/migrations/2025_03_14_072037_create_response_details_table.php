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
        Schema::create('response_details', function (Blueprint $table) {
            $table->integer('response_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('likert_value')->unsigned();
            $table->primary(['response_id', 'question_id']);
            $table->foreign('response_id')->references('response_id')->on('responses')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_details');
    }
};
