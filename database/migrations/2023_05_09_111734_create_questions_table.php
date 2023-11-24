<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('cat_id')->nullable()->default(null);
            $table->unsignedInteger('sub_cat_id')->nullable()->default(null);
            $table->string('question_name')->nullable()->default(null);
            $table->integer('status')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('form_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_cat_id')->references('id')->on('form_sub_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->index('cat_id');
            $table->index('sub_cat_id');
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
