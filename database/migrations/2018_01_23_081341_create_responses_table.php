<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('topic_id')->unsigned()->index();
            $table->integer('member_id')->unsigned()->index();
            $table->text('response');
            $table->enum('published', ['0','1']);
            $table->enum('changed', ['0', '1']);
            $table->timestamps();

            $table->foreign('topic_id')
                ->references('id')->on('topics')
                ->onDelete('cascade');

            $table->foreign('member_id')
                ->references('id')->on('members')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
