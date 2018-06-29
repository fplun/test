<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    }

    public function error($msg = '')
    {
        return response()->json([
            'Erro' => $msg,
            'Status' => 'Erro',
        ]);
    }

    public function my_page($request, $count)
    {
        $data['limit'] = empty($request->limit) ? 10 : $request->limit;
        $page = empty($request->page) ? 1 : $request->page;
        $page = ($page < 1) ? 1 : $page;
        $sum_page = ceil($count / $data['limit']);
        $page = ($page > $sum_page) ? $sum_page : $page;
        $data['page'] = ($page - 1) * $data['limit'];

        return $data;
    }

    public function success($msg = '')
    {
        return response()->json([
            'Text' => $msg,
            'Status' => 'ok',
        ]);
    }

    public function json_data($data, $count)
    {
        return response()->json([
            'data' => $data,
            'code' => '0',
            'count' => $count,
            'msg' => '',
        ]);
    }
}
