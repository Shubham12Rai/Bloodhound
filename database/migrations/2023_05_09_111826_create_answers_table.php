<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inspector_id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('sub_cat_id');
            $table->unsignedInteger('cat_id');
            $table->text('answer')->nullable()->default(null);
            $table->string('row_type')->default("Plain");
            $table->integer('status')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('client_general_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_cat_id')->references('id')->on('form_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cat_id')->references('id')->on('form_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade')->onUpdate('cascade');


            $table->index('client_id');
            $table->index('question_id');
            $table->index('sub_cat_id');
            $table->index('cat_id');
            $table->index('inspector_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
