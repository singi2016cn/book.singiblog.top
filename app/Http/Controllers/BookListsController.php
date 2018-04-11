<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_lists = DB::table('book_lists')->paginate(16);
        return view('book_lists.index',['book_lists'=>$book_lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = DB::table('books')->pluck('title','id');
        return view('book_lists.create',['books'=>$books]);
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
            'name' => 'required',
            'book_id' => 'required',
        ]);
        $request_data = $request->except('_token');
        $request_data['book_ids'] = implode(',',$request_data['book_id']);
        unset($request_data['book_id']);
        $request_data['created_at'] = date('Y-m-d H:i:s');
        DB::table('book_lists')->insert($request_data);
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
        $book_list = DB::table('book_lists')->where('id',$id)->first();
        if ($book_list){
            $books = DB::table('books')
                ->select('books.*','publishes.name as publish')
                ->join('publishes','publishes.id','=','books.publish_id')
                ->whereIn('books.id',explode(',',$book_list->book_ids))
                ->paginate(10);
            if ($books){
                foreach($books as $book){
                    $book->tags = DB::table('books')
                        ->select('tags.id','tags.name')
                        ->join('books_tags','books.id','=','books_tags.books_id')
                        ->join('tags','tags.id','=','books_tags.tags_id')
                        ->where('books.id',$book->id)
                        ->limit(15)
                        ->get();
                }
                $book_list->books = $books;
            }
        }
        return view('book_lists.show',['book_list'=>$book_list]);
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
     * 搜索书单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $search_data = $request->all();
        $db_instance = DB::table('book_lists');
        if (!empty($search_data['search_value'])){
            $db_instance->where('name','like','%'.$search_data['search_value'].'%');
        }else{
            $search_data['search_value'] = '';
        }
        $book_lists = $db_instance->orderBy('id','desc')->paginate(12);
        return view('book_lists.search',['book_lists'=>$book_lists,'search_data'=>$search_data]);
    }
}
