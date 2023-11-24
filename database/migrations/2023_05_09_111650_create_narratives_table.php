<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narratives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cat_id');
            $table->unsignedInteger('sub_cat_id');
            $table->unsignedInteger('inspector_id');
            $table->text('narratives_title')->nullable()->default(null);
            $table->text('narratives_text')->nullable()->default(null);
            $table->integer('status')->nullable()->default(true);

            $table->timestamps();
            $table->tinyInteger('default')->default(0);

            $table->foreign('cat_id')->references('id')->on('form_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_cat_id')->references('id')->on('form_sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade')->onUpdate('cascade');


            $table->index('cat_id');
            $table->index('sub_cat_id');
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
        Schema::dropIfExists('narratives');
    }
}
