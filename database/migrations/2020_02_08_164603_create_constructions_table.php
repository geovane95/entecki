<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 64);
            $table->string('thumbnail', 256);
            $table->string('company', 64);
            $table->unsignedBigInteger('responsible');
            $table->unsignedBigInteger('regional');
            $table->unsignedBigInteger('address');
            $table->string('contract_regime', 32);
            $table->string('reporting_regime', 32);
            $table->string('issuance_date');
            $table->string('work_number', 32);
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('responsible')->references('id')->on('responsibles');
            $table->foreign('regional')->references('id')->on('regionals');
            $table->foreign('address')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('constructions');
        Schema::dropIfExists('constructions');
    }
}
