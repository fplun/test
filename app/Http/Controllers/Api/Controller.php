<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function error($msg = '',$data=[])
    {
        return response()->json([
            'message' => $msg,
            'status' => '300',
            'data'=>$data,
        ]);
    }

    public function success($msg = '',$data=[])
    {
        return response()->json([
            'message' => $msg,
            'status' => '200',
            'data'=>$data,
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

    

    public function json_data($data, $count)
    {
        return response()->json([
            'data' => $data,
            'code' => '0',
            'count' => $count,
            'msg' => '',
        ]);
    }
    //
}
