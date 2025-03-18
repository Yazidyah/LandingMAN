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
            $table->increments('id');
            $table->unsignedBigInteger('response_id'); // Change to unsignedBigInteger for foreign key
            $table->unsignedBigInteger('question_id'); // Change to unsignedBigInteger for foreign key
            $table->string('likert_value')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('response_id')->references('id')->on('responses')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
