<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\AdminUser;
use App\Models\Notice;

class NoticeController extends Controller
{
    //新闻列表页面
    public function news_list()
    {
        return view('admin.notice.news_list');
    }
    //获取新闻列表
    public function get_news(Request $request)
    {
        $count=News::count();

        $page=$this->my_page($request, $count);

        $news=News::orderBy('id', 'desc')->offset($page['page'])->limit($page['limit'])->select('id', 'title', 'created_at')->get();

        return $this->json_data($news, $count);
    }
    //新闻添加页面
    public function toaddnews()
    {
        return view('admin.notice.toaddnews');
    }
    //新闻添加
    public function news_add(Request $request)
    {
        $this->validate(
            $request,
            [
                'title'=>'required|min:2',
            ],
            [
                'title.required'=>'标题至少得2个字符啊',
            ]
        );

        $news=new News;
        $news->title=$request->title;
        $news->content=$request->content;
        $res=$news->save();
        if ($res) {
            return $this->success('添加成功');
        } else {
            return $this->error('添加失败');
        }
    }
    //新闻编辑页面
    public function news_edit(Request $request)
    {
        $news=News::where('id', $request->id)->first();
        return view('admin.notice.news_edit')->with('news', $news);
    }
    //更新新闻
    public function news_update(Request $request)
    {
        $news=News::where('id', $request->id)->first();

        $news->title=$request->title;
        $news->content=$request->content;
        $res=$news->save();
        if ($res) {
            return $this->success('添加成功');
        } else {
            return $this->error('添加失败');
        }
    }
    //删除新闻
    public function news_delete(Request $request)
    {
        $news=News::find($request->id);
        $res=$news->delete();
        if ($res) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
    //内部消息管理页面
    public function inbox(Request $request)
    {
        $admin_id = $request->session()->get('admin_id');
        $admin=AdminUser::where('id', $admin_id)->first();

        return view('admin.notice.inbox')->with('admin', $admin);
    }
    //获取收件箱
    public function get_inbox(Request $request)
    {
        $count=Notice::where('receive_type', 1)->where('receive_user', 'A00000000')->count();
        $page=$this->my_page($request, $count);
        $notice=Notice::where('receive_type', 1)->where('receive_user', 'A00000000')->orderBy('is_read', 'asc')->offset($page['page'])->limit($page['limit'])->select('id', 'send_user as senduserinfo', 'created_at as creattime', 'is_read as status')->get();
        return $this->json_data($notice, $count);
    }
    //查看收件箱消息
    public function look_notice(Request $request)
    {
        $notice=Notice::find($request->id);
        if ($notice->is_read==0) {
            $admin_id = $request->session()->get('admin_id');
            $admin=AdminUser::where('id', $admin_id)->first();
            if ($notice->receive_user == 'A00000000'|| $notice->receive_user == $admin->username) {
                $notice->is_read=1;
                $notice->save();
            }
        }
        return view('admin.notice.look_notice')->with('notice', $notice);
    }
    //删除收件箱消息
    public function inbox_delete(Request $request)
    {
        $notice=Notice::find($request->id);
        $res=$notice->delete();
        if ($res) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
    //发件箱页面
    public function get_outbox(Request $request)
    {
        $admin_id = $request->session()->get('admin_id');
        $admin=AdminUser::where('id', $admin_id)->first();
        $count=Notice::where('send_type', 1)->where('send_user', $admin->username)->count();
        $page=$this->my_page($request, $count);
        $notice=Notice::where('send_type', 1)->where('send_user', $admin->username)->orderBy('is_read', 'asc')->offset($page['page'])->limit($page['limit'])->select('id', 'send_user as senduserinfo', 'created_at as creattime', 'is_read as status')->get();

        return $this->json_data($notice, $count);
    }

    //发送消息
    public function send_make(Request $request)
    {
        $this->validate(
            $request,
            [
                'receive' => 'required|exists:users,username',
                'title' => 'required|max:255',
                'content' => 'required|max:1000'
            ],
            [
                'receive.required'=>'请输入收件人编号',
                'receive.exists'=>'没有接收该会员编号！',
                'title.required'=>'请输入消息标题',
                'title.max'=>'消息标题最大为255',
                'content.required'=>'请输入消息内容',
                'content.max'=>'消息内容最大为1000',
            ]
        );
        $admin_id = $request->session()->get('admin_id');
        $admin_user=AdminUser::where('id', $admin_id)->select('username')->first();

        $notice=new Notice;
        $notice->send_user=$admin_user->username;
        $notice->send_type=1;
        $notice->receive_user=$request->receive;
        $notice->receive_type=0;
        $notice->title=$request->title;
        $notice->content=$request->content;
        $notice->is_read=0;

        $res=$notice->save();
        if ($res) {
            return $this->success('发送成功');
        } else {
            return $this->error('发送失败');
        }
    }
}
