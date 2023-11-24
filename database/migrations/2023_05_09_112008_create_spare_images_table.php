<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpareImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('inspector_id');
            $table->unsignedInteger('client_id');
            $table->string('image_path')->nullable()->default(null);
            $table->integer('status')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('client_general_info')->onDelete('cascade')->onUpdate('cascade');

            $table->index('inspector_id');
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
        Schema::dropIfExists('spare_images');
    }
}
