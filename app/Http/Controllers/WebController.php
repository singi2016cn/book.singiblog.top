<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RightsMail;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Model\Feedback;
use App\Model\Rights;

class WebController extends Controller
{
    public static $to_mail = [
        '787575327@qq.com',
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function feedback(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:9999',
            'contact' => 'nullable||max:255',
        ]);
        $request_data = $request->except('_token');
        $request_data['created_at'] = date('Y-m-d H:i:s');
        $feedback_id = DB::table('feedback')->insertGetId($request_data);

        $feedback = Feedback::find($feedback_id);
        Mail::to(self::$to_mail)->send(new FeedbackMail($feedback));
        return back()->with('msg','添加成功');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rights(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'reason' => 'required|max:9999',
            'contact' => 'nullable|max:255',
        ]);
        $request_data = $request->except('_token');
        $request_data['created_at'] = date('Y-m-d H:i:s');
        $rights_id = DB::table('rights')->insert($request_data);

        $rights = Rights::find($rights_id);
        Mail::to(self::$to_mail)->send(new RightsMail($rights));
        return back()->with('msg','添加成功');
    }
}
