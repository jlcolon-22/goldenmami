<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_information', function (Blueprint $table) {
            $table->id();
            $table->string('res_name')->nullable();
            $table->string('res_email')->nullable();
            $table->string('res_number')->nullable();
            $table->text('res_fb')->nullable();
            $table->text('res_twitter')->nullable();
            $table->text('res_instagram')->nullable();
            $table->text('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_information');
    }
}
