<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookDownloadLinksController extends Controller
{
    public static $type = [
        1 => '云盘',
        2 => 'BT',
        3 => 'FTP',
        4 => '缓存',
        5 => '其他',
    ];

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $books_id = $request->input('books_id');
        if ($books_id <= 0) redirect('books');
        return view('book_download_link.create', ['books_id' => $books_id, 'type' => BookDownloadLinksController::$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'books_id' => 'required|numeric',
            'type' => 'required|numeric|between:1,5',
            'url' => 'required|url|active_url|max:255',
            'url_key' => 'nullable|max:255',
        ]);
        $request_data = $request->except('_token');
        $request_data['created_at'] = date('Y-m-d H:i:s');
        DB::table('book_download_links')->insert($request_data);
        return back()->with('msg', '添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 增加下载次数
     * @param $id
     * @param int $type
     * @return string
     */
    public function update_download_count($id, $type=1)
    {
        if ($id <= 0) return json_encode(['msg' => 'failed']);
        $book_download_link = DB::table('book_download_links')->where('id', $id)->first();
        if ($book_download_link) {
            if ($type == 1) {
                DB::table('book_download_links')->where('id', $id)->increment('download_count');
                DB::table('books')->where('id', $book_download_link->books_id)->increment('download_count');
            } else {
                DB::table('book_download_links')->where('id', $id)->decrement('download_count');
                DB::table('books')->where('id', $book_download_link->books_id)->decrement('download_count');
            }
        }

        return json_encode(['msg' => 'success','download_count'=>$book_download_link->download_count,'type'=>$type]);
    }
}
