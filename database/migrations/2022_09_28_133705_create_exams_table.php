<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('duration')->nullable();
            $table->text('description')->nullable();
            $table->decimal('per_question_mark')->nullable()->default(1);
            $table->decimal('negative_mark')->nullable()->default(0);
            $table->decimal('pass_mark')->nullable();
            $table->boolean('strict')->nullable()->default(false);
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->dateTime('result_publish_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
