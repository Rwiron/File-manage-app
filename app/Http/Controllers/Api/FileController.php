<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FileController extends Controller
{
    public function getData($forderId) {
        $files = DB::table('files')->where('forder_id', $forderId) ->orderBy('id','desc')->get();

        return $files;

    }
}
