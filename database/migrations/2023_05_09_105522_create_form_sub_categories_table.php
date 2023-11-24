<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cat_id')->nullable()->default(null);
            $table->string('sub_cat_name')->nullable()->default(null);
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('form_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_sub_categories');
    }
}
