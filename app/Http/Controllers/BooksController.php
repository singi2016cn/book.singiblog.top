<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreBooks;
use App\Http\Controllers\BookDownloadLinksController;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books_hot = DB::table('books')->orderBy('download_count','desc')->limit(4)->get();
        $books_new = DB::table('books')->orderBy('id','desc')->limit(4)->get();
        return view('books.index',['books_hot'=>$books_hot,'books_new'=>$books_new]);
    }

    public function search(Request $request)
    {
        $search_data = $request->all();

        $db_instance = DB::table('books');
        if (!empty($search_data['id'])) $db_instance->where('books.id',$search_data['id']);
        if (!empty($search_data['category'])){
            $db_instance->where('category','=',$search_data['category']);
        }else{
            $search_data['category'] = '';
        }

        if (!empty($search_data['publish_id'])){
            $db_instance->where('publish_id',$search_data['publish_id']);
        }else{
            $search_data['publish_id'] = '';
        }

        if (!empty($search_data['tag_id'])){
            $db_instance->where('tags.id',$search_data['tag_id']);
            $db_instance->join('books_tags','books_tags.books_id','=','books.id');
            $db_instance->join('tags','tags.id','=','books_tags.tags_id');
        }else{
            $search_data['tag_id'] = '';
        }

        if (!empty($search_data['search_value'])){
            $db_instance->join('publishes','publishes.id','=','books.publish_id')->where(function($query)use($search_data){
                $query->where('title','like','%'.$search_data['search_value'].'%');
                $query->orWhere('author','like','%'.$search_data['search_value'].'%');
                $query->orWhere('publishes.name',$search_data['search_value']);
                $query->orWhere('isbn',$search_data['search_value']);
            });
        }else{
            $search_data['search_value'] = '';
        }
        if (!empty($search_data['start_date'])) $db_instance->where('created_at','>=',$search_data['start_date']);
        if (!empty($search_data['end_date'])) $db_instance->where('end_date','<=',$search_data['end_date']);
        if (!empty($search_data['orderBy'])){
            if ($search_data['orderBy'] == 1) $db_instance->orderBy('download_count','desc');
            if ($search_data['orderBy'] == 2) $db_instance->orderBy('books.id','desc');
        }else{
            $search_data['orderBy'] = 0;
        }

        $books = $db_instance->paginate(5)->withPath('search');
        $categories = DB::table('categories')->get();
        $publishes = DB::table('publishes')->limit(10)->pluck('name','id')->toArray();
        $tags = DB::table('tags')->limit(10)->pluck('name','id')->toArray();
        return view('books.search',['books'=>$books,'tags'=>$tags,'search_data'=>$search_data,'categories'=>$categories,'publishes'=>$publishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->pluck('name','id');
        $publishes = DB::table('publishes')->pluck('name','id');
        $tags = DB::table('tags')->pluck('name','id');
        return view('books.create',['categories'=>$categories,'publishes'=>$publishes,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBooks $storeBooks
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBooks $storeBooks)
    {
        $request_data = $storeBooks->except(['_token']);
        if ($request_data['publish_id'] && !intval($request_data['publish_id'])){
            $has_publish = DB::table('publishes')->where('name',$request_data['publish_id'])->value('id');
            if(!$has_publish){
                $publish_id = DB::table('publishes')->insertGetId(['name'=>$request_data['publish_id']]);
                if ($publish_id > 0) $request_data['publish_id'] = $publish_id;
            }
        }
        $tags_id = [];
        $date = date('Y-m-d H:i:s');
        if ($request_data['tag_id'] && is_array($request_data['tag_id'])){
            foreach($request_data['tag_id'] as $v){
                if (!intval($v)){
                    $has_tag = DB::table('tags')->where('name',$v)->value('id');
                    if(!$has_tag){
                        $tag_id = DB::table('tags')->insertGetId(['name'=>$v,'created_at'=>$date]);
                        if ($tag_id > 0) $tags_id[] = $tag_id;
                    }else{
                        $tags_id[] = $v;
                    }
                }else{
                    $tags_id[] = $v;
                }
            }
            unset($request_data['tag_id']);
        }
        $request_data['created_at'] = $date;
        $books_id = DB::table('books')->insertGetId($request_data);
        if ($books_id > 0 && $tags_id){
            foreach($tags_id as $tag_v){
                DB::table('books_tags')->insert(['books_id'=>$books_id,'tags_id'=>$tag_v,'created_at'=>$date]);
            }
        }
        return back()->with('msg','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id <= 0) redirect('books');
        $book = DB::table('books')->where('id',$id)->first();
        $book_download_links = [];
        if ($book){
            $book_download_links = DB::table('book_download_links')->where('books_id',$book->id)->orderBy('download_count','desc')->orderBy('id','asc')->get();
        }
        $publishes = DB::table('publishes')->pluck('name','id')->toArray();
        $tags = DB::table('tags')->where('books_id',$id)->join('books_tags','books_tags.tags_id','=','tags.id')->pluck('tags.name','tags.id');
        return view('books.show',['book'=>$book,'tags'=>$tags,'publishes'=>$publishes,'book_download_links'=>$book_download_links,'type'=>BookDownloadLinksController::$type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
