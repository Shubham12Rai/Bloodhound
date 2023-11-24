<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_cat_id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('comment_id');
            $table->string('image_path')->nullable()->default(null);
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('sub_cat_id')->references('id')->on('form_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('client_general_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');

            $table->index('sub_cat_id');
            $table->index('client_id');
            $table->index('comment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
