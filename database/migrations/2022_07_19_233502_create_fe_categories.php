<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fe_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('category_name');
            $table->integer('order_by');
            $table->char('show_mode')->comment('Yes or No');
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
        Schema::dropIfExists('fe_categories');
    }
}
