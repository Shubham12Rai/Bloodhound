<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGeneralInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_general_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inspector_id');
            $table->string('banner_image')->nullable();
            $table->string('inspection_address');
            $table->string('inspection_date')->nullable();
            $table->string('client_name');
            $table->string('client_onsite')->nullable();
            $table->string('property_type')->nullable();
            $table->string('add_suites')->nullable();
            $table->string('add_structure')->nullable();
            $table->string('year_build')->nullable();
            $table->string('approx_yrs')->nullable();
            $table->string('utilities', 100)->nullable();
            $table->string('reportUUID');
            $table->integer('status')->nullable()->default(1);
            $table->timestamps();
            
            $table->foreign('inspector_id')->references('id')->on('inspectors')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('client_general_info');
    }
}
