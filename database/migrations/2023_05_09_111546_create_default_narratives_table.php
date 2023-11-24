<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultNarrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_narratives', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->unsigned()->nullable();
            $table->integer('sub_cat_id')->unsigned()->nullable();
            $table->text('narratives_title')->nullable();
            $table->longText('narratives_text')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('default_narratives');
    }
}
