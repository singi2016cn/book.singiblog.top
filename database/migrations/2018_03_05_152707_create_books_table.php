<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category')->comment('分类');
            $table->string('title', 255)->comment('书名');
            $table->string('cover', 255)->comment('封面')->nullable();
            $table->string('author', 255)->comment('作者')->nullable();
            $table->char('isbn', 13)->comment('国际标准书号')->nullable();
            $table->unsignedInteger('publish_id')->comment('出版社id')->default(0);
            $table->integer('download_count')->comment('下载次数')->default(0);
            $table->date('publish_date')->comment('出版日期')->nullable();
            $table->string('series',255)->comment('丛书')->nullable();
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
        Schema::dropIfExists('books');
    }
}
