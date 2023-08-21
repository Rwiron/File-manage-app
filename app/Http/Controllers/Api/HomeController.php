<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function getDataHome()
    {
        // dd("ok");
        $folders = DB::table('folders')->get();
        $file = DB::table('files')->orderBy('id', 'desc')->get();
        //dd($forders);
        return [
            'folders' => $folders,
            'files' => $file
        ];
    }
}
