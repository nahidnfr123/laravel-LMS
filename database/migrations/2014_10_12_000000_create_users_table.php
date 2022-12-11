<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.->nullable()
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->foreignId('subject_id')->nullable();
            $table->foreignId('semester_id')->nullable();
            $table->foreignId('batch_id')->nullable();
            $table->date('dob')->nullable();
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student');
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');

            $table->string('s_id')->unique()->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('fathers_phone')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_phone')->nullable();

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
