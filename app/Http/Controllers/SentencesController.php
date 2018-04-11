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
        //
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
            'book_id' => 'nullable|numeric',
            'author' => 'nullable|max:255',
            'tag_ids' => 'nullable|array',
        ]);
        $request_data = $request->except('_token');
        if (is_numeric($request_data['book_id'])){
            $request_data['book'] = DB::table('books')->where('id',$request_data['book_id'])->value('title');
        }else{

        }

        if (is_numeric($request_data['tag_ids'])){

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
}
