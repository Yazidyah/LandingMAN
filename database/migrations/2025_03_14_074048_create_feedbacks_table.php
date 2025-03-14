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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('respondent_id');
            $table->text('kritik')->nullable();
            $table->text('saran')->nullable();
            $table->timestamps();

            $table->foreign('survey_id')->references('survey_id')->on('surveys');
            $table->foreign('respondent_id')->references('respondent_id')->on('respondents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
