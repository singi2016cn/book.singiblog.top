<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookDownloadLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_download_links', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('books_id')->comment('书籍id');
            $table->unsignedSmallInteger('type')->comment('下载类型 1云盘2BT3FTP4缓存5其他')->default(1);
            $table->string('url',255)->comment('下载链接');
            $table->string('url_key',255)->comment('下载链接密码')->nullable();
            $table->unsignedInteger('download_count')->comment('下载次数')->default(0);
            $table->unsignedTinyInteger('is_work')->comment('是否可用 0不可用1可用')->default(1);
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
        Schema::dropIfExists('book_download_links');
    }
}
