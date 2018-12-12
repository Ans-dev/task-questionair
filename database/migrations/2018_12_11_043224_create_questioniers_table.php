<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestioniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questioniers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            //Foriegn key for user.
            $table->integer('user_id');

            $table->string('name', 100);
            $table->time('duration');
            $table->boolean('resumeable')->default(false);
            $table->boolean('published')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questioniers');
    }
}
