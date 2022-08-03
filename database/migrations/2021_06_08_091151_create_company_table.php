<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('company_name');
            $table->char('company_email');
            $table->char('company_logo');
            $table->char('company_favicon');
            $table->char('company_phone');
            $table->text('head_office');
            $table->tinyInteger('status')->default('1')->comment('0 = inactive,1= active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
