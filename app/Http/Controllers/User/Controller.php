<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Routing\Controller as BaseController;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('userLogin');
    }

    public function error($msg = '')
    {
        return response()->json([
            'Erro' => $msg,
            'Status' => 'Erro',
        ]);
    }

    public function success($msg)
    {
        return response()->json([
            'Text' => $msg,
            'Status' => 'ok',
        ]);
    }

    protected function responseList(AbstractPaginator $list)
    {
        return response()->json([
            'code' => 0,
            'count' => $list->count(),
            'data' => $list->all(),
            'msg' => '',
        ]);
    }

    protected function uploadImage(Request $request, string $fieldName)
    {
        $dir = public_path('upload/' . date('Ymd') . '/');
        $filename = date('Ymdhis') . rand(100, 999);
        $ext = $request->file($fieldName)->getClientOriginalExtension();

        if (!is_dir($dir)) {
            // Storage::makeDirectory($dir);
        }
        $outPath = $dir . $filename . '.jpg';
        $isTrue = Storage::putFileAs(date('Ymd'), $request->file($fieldName), $filename . '.' . $ext);
        $localurl = '/' . date('Ymd') . '/' . $filename . '.' . $ext;
        $url = '/upload' . $localurl;
        return $url;
    }
}
