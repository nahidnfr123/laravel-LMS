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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->nullable()->constrained()->onDelete('cascade'); //
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); //
            $table->integer('correct')->nullable(); //
            $table->integer('wrong')->nullable(); //
            $table->decimal('total_mark')->nullable(); //
            $table->decimal('positive_mark')->nullable();
            $table->decimal('negative_mark')->nullable();
            $table->decimal('obtained_mark')->nullable(); //
            $table->dateTime('start_time')->nullable(); //
            $table->dateTime('end_time')->nullable(); //
            $table->integer('duration')->nullable();
            $table->boolean('submitted')->nullable()->default(false); //
            $table->enum('status',['passed','failed','rejected','disqualified','expelled','absent','retake'])->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('results');
    }
};
