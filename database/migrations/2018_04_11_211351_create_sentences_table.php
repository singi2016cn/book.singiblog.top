<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content',255)->comment('内容');
            $table->string('author',255)->comment('作者')->nullable();
            $table->unsignedInteger('book_id')->comment('书籍id')->nullable();
            $table->string('book',255)->comment('出自书籍')->nullable();
            $table->string('tag_ids',255)->comment('标签ids')->nullable();
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
        Schema::dropIfExists('sentences');
    }
}
