<?php

namespace App\Http\Controllers\User;

use App\Models\News;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('userLogin');
    }

    public function index()
    {
        return view('user.notice');
    }

    public function news(Request $request)
    {
        $limit = $request->query('limit', 10);
        $news = News::orderBy('id', 'desc')->paginate($limit);
        return $this->responseList($news);
    }

    public function newsDetail(Request $request)
    {
        $id = $request->input('id');
        $news = News::find($id);

        return view('user.notice.newsDetail')->with('news', $news);
    }

    public function sendNotice(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.notice.sendNotice');
        }
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $notice = new Notice;
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->send_user = $request->user->username;
        $notice->receive_user = 'A00000000';
        $notice->save();

        return redirect('/sendlists');
    }

    public function sendLists(Request $request)
    {
        return view('user.notice.sendList');
    }
    public function sendListJson(Request $request)
    {
        $limit = (int) $request->query('limit', 10);
        $list = Notice::where('send_user', $request->user->username)->orderBy('id', 'desc')->paginate($limit);
        return $this->responseList($list);
    }

    public function collectLists(Request $request)
    {
        return view('user.notice.collectList');

    }

    public function noticeDetail(Request $request)
    {
        $notice = Notice::find($request->id);
        if ($request->user->username === $notice->receive_user && $notice->is_read == Notice::STATUS_UNREAD) {
            $notice->is_read = Notice::STATUS_READED;
            $notice->save();
        }
        return view('user.notice.noticeDetail', compact('notice'));
    }

    public function collectListJson(Request $request)
    {
        $limit = (int) $request->query('limit', 10);
        $list = Notice::where('receive_user', $request->user->username)->orderBy('id', 'desc')->paginate($limit);
        return $this->responseList($list);
    }

    public function delNotice(Request $request)
    {
        Notice::where('id', $request->id)->delete();
        return $this->success('删除成功');
    }
}
