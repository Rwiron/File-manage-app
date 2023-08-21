<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForderController extends Controller
{
    //checking niba iraza kuyi saving

    public function create (Request $request) {
        //dd($request);
        $request -> validate([
            'name' => 'required',
        ]);

        $forder = DB::table('folders')->insert($request->all());
        return $forder;

    }
}
