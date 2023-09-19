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
            $table->string('user_id');
            $table->string('group_id');
            $table->string('course_id');
            $table->string('test_id');
            $table->string('question_id');
            $table->integer('correct');
            $table->integer('wrong');
            $table->float('obtn_marks');
            $table->float('total_score');
            $table->integer('percentage');
            $table->integer('rank');

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
