<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->comment('出版社名');
            $table->unsignedTinyInteger('category')->comment('出版社类型')->nullable();
            $table->string('location',255)->comment('所在地')->nullable();
            $table->date('found_date')->comment('成立日期')->nullable();
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
        Schema::dropIfExists('publishes');
    }
}
