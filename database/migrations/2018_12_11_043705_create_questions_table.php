<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            //Forign keys for user and questionier relation ..... relation will be soft and decalered in relevent model class
            $table->integer('user_id');
            $table->integer('questionier_id');

            $table->string('type', 100);
            $table->text('question');
            $table->text('answer')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
