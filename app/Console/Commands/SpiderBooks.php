<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use phpQuery;

class SpiderBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:books {page_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'spider jd book resources';

    protected $categories_setting = [
        '计算机与互联网' => 1,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $page_id = $this->argument('page_id');
        $file = 'https://item.jd.com/'.$page_id.'.html';
        phpQuery::newDocumentFileHTML($file);

        $book['title'] = $this->format(pq('h1')->html());
        $book['author'] = trim(str_replace('著','',explode('；',$this->format(pq('#p-author')->html()))[0]));
        $book['cover'] = $this->format(pq('#spec-n1>img')->attr('src'));
        $book_infos = pq('#parameter2>li')->texts();
        if ($book_infos){
            foreach($book_infos as $book_info){
                $book_info_arr = explode('：',$book_info);
                $book_info_arr[1] = trim($book_info_arr[1]);
                if ($book_info_arr[0] == '出版社'){
                    $book['publish_id'] = DB::table('publishes')->where('name',$book_info_arr[1])->value('id');
                    if (!$book['publish_id']){
                        $book['publish_id'] = DB::table('publishes')->insertGetId(['name'=>$book_info_arr[1],'created_at'=>date('Y-m-d H:i:s')]);
                    }
                }elseif($book_info_arr[0] == 'ISBN'){
                    $book['isbn'] = $book_info_arr[1];
                }elseif($book_info_arr[0] == '丛书名'){
                    $book['series'] = $book_info_arr[1];
                }elseif($book_info_arr[0] == '出版时间'){
                    $book['publish_date'] = $book_info_arr[1];
                }
            }
        }
        $book['category'] = $this->categories_setting[$this->format(pq('div[class="breadcrumb"]>span>a:first')->html())];
        $book['created_at'] = date('Y-m-d H:i:s');

        $book_id = DB::table('books')->where('isbn',$book['isbn'])->value('id');
        if(!$book_id){
            $book_id = DB::table('books')->insertGetId($book);
            $this->info('spider book successful,book_id is '.$book_id);
        }else{
            DB::table('books')->where('id',$book_id)->update($book);
            $this->info('updated successful');
        }
    }

    function format($html){
        return trim(strip_tags(iconv('gbk','utf-8',$html)));
    }
}
