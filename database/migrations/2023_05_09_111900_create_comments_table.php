<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inspector_id');
            $table->unsignedInteger('sub_cat_id');
            $table->unsignedInteger('client_id');
            $table->text('comments')->nullable()->default(null);
            $table->integer('status')->nullable()->default(true);
            $table->timestamps();
            $table->boolean('pinned')->default(false);

            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_cat_id')->references('id')->on('form_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('client_general_info')->onDelete('cascade')->onUpdate('cascade');

            $table->index('inspector_id');
            $table->index('sub_cat_id');
            $table->index('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
