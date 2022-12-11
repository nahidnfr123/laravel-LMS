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
        Schema::create('topic_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->nullable()->constrained()->onDelete('set null');;
            $table->foreignId('topic_id')->nullable()->constrained()->onDelete('set null');;
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');;
            $table->foreignId('clas_id')->nullable()->constrained()->onDelete('set null');;
            $table->boolean('present')->nullable()->constrained()->onDelete('set null');;
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
        Schema::dropIfExists('topic_attendances');
    }
};
