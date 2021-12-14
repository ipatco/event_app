<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->string('image');
            $table->string('location');
            $table->double('price')->default('0');
            $table->double('sale_price')->default('0')->nullable();
            $table->string('video')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('o_name');
            $table->string('o_phone');
            $table->string('o_email');
            $table->string('o_website');
            $table->unsignedBigInteger('user_id');
            $table->integer('booking_status')->default('1');
            $table->integer('status')->default('0');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
