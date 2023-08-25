<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForderController extends Controller
{
    //checking niba iraza kuyi saving

    public function create(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
        ]);

        $forder = DB::table('folders')->insert($request->all());
        return $forder;
    }

    public function edit($id)
    {
        // dd($id);
        $forder = DB::table('folders')->where('id', $id)->first();
        return $forder;
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
        ]);

        $forder = DB::table('folders')->where('id', $id)->update($request->all());
        return $forder;
    }

    public function delete($id)
    {
        $files = DB::table('files')->where('forder_id', $id)->get();
        foreach ($files as $file) {
            unlink(storage_path('app/public/uploads/'.$file->name));
        }
        $forder = DB::table('folders')->where('id', $id)->delete();
        $files = DB::table('files')->where('forder_id', $id)->delete();
    
        return $forder;
    }
}
