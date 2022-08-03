<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fe_units', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('unit_name');
            $table->integer('order_by');
            $table->tinyInteger('status')->default('1')->comment('1 = active, 0 = inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fe_units');
    }
}
