<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->default(false);
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('membership')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('region_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index('region_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspectors');
    }
}
