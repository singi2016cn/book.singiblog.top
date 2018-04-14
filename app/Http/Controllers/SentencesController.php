<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SentencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sentences = DB::table('sentences')->orderBy('id','desc')->paginate(6);
        /*if ($sentences->all()){
            foreach($sentences->all() as &$sentence){
                $sentence->tags = DB::table('tags')->whereIn('id',$sentence->tag_ids)->get();
            }
        }*/
        return view('sentences.index',['sentences'=>$sentences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = DB::table('books')->pluck('title','id');
        $tags = DB::table('tags')->pluck('name','id');
        return view('sentences.create',['books'=>$books,'tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'author' => 'nullable|max:255',
            'tag_ids' => 'nullable|array',
        ]);
        $request_data = $request->except('_token');
        if (is_numeric($request_data['book_id'])){
            $request_data['book'] = DB::table('books')->where('id',$request_data['book_id'])->value('title');
        }else{
            $book = DB::table('books')->where('title',$request_data['book_id'])->first();
            if ($book){
                $request_data['book_id'] = $book->id;
                $request_data['book'] = $book->title;
            }else{
                $request_data['book'] = $request_data['book_id'];
                $request_data['book_id'] = 0;
            }
        }

        if ($request->has('tag_ids')){
            foreach($request_data['tag_ids'] as $k=>$tag_id){
                if (is_numeric($tag_id)){
                    if (!DB::table('tags')->where('id',$tag_id)->count()){
                        unset($request_data['tag_ids'][$k]);
                    }
                }else{
                    $tag = DB::table('tags')->where('name',$tag_id)->first();
                    if ($tag){
                        $request_data['tag_ids'][$k] = $tag->id;
                    }else{
                        $request_data['tag_ids'][$k] = DB::table('tags')->insertGetId(['name'=>$tag_id]);;
                    }
                }
            }
            if (is_array($request_data['tag_ids'])){
                $request_data['tag_ids'] = implode(',',$request_data['tag_ids']);
            }else{
                $request_data['tag_ids'] = '';
            }
        }
        $request_data['created_at'] = date('Y-m-d H:i:s');
        DB::table('sentences')->insert($request_data);
        return back()->with('msg', '添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * 搜索
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $search_data = $request->all();
        $db_instance = DB::table('sentences');
        if (!empty($search_data['search_value'])){
            $db_instance->where('content','like','%'.$search_data['search_value'].'%');
        }else{
            $search_data['search_value'] = '';
        }
        $sentences = $db_instance->orderBy('id','desc')->paginate(12);
        return view('sentences.search',['sentences'=>$sentences,'search_data'=>$search_data]);
    }
}
