<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('accessprofile');
            $table->integer('linecount')->nullable();
            $table->unsignedBigInteger('uploadstatus');
            $table->unsignedBigInteger('uploadtype');
            $table->unsignedBigInteger('competence');
            $table->string('fileName');
            $table->string('file');
            $table->string('extension');
            $table->string('folder');
            $table->unsignedBigInteger('construction')->nullable();
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('accessprofile')->references('id')->on('access_profiles');
            $table->foreign('uploadstatus')->references('id')->on('upload_statuses');
            $table->foreign('uploadtype')->references('id')->on('upload_types');
            $table->foreign('competence')->references('id')->on('competences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_data');
    }
}
