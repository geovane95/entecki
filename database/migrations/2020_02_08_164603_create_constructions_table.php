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
            $table->string('responsible', 64);
            $table->string('cnpj', 14);
            $table->unsignedBigInteger('business');
            $table->unsignedBigInteger('regional');
            $table->unsignedBigInteger('address');
            $table->string('contract_regime', 32);
            $table->string('reporting_regime', 32);
            $table->string('work_number', 32);
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('business')->references('id')->on('businesses');
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
