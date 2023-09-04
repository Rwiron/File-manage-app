<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FileController extends Controller
{
    public function getData($forderId)
    {
        $files = DB::table('files')->where('forder_id', $forderId)->orderBy('id', 'desc')->get();

        return $files;
    }

    public function upload($id, Request $request)
    {
        // for taking any Files object 
        $request->validate([
            'file' => 'required|mimes:png,jpg,pdf,html,pptx,xlsx,docx|max:2048',
        ]);
        $file = $request->file('file');
        $filename = time() .  '_' . $file->getClientOriginalName();
        $file->storeAs('upload', $filename, 'public');

        DB::table('files')->insert([
            'name' => $file->getClientOriginalName(),
            'name_generate' => $filename,
            'type' => $file->guessExtension(),
            'size' => $file->getSize(),
            'forder_id' => $id,
        ]);
    }

    // public function download ($id) {
    //     $file = DB::table('files')->where('id',$id) -> first();
    //     $path = storage_path('app/public/upload/'. $file->name_generate);
    //     return response() -> download($path);
    // }
    // public function download($id, $action = 'download')
    // {
    //     $file = DB::table('files')->where('id', $id)->first();
    //     $path = storage_path('app/public/upload/' . $file->name_generate);

    //     if (!file_exists($path)) {
    //         return response()->json(['error' => 'File not found'], 404);
    //     }

    //     if ($action == 'view') {
    //         return response()->file($path);
    //     } else {
    //         return response()->download($path);
    //     }
    // }

    public function download($id, $action = 'download')
    {
        $file = DB::table('files')->where('id', $id)->first();
        $path = storage_path('app/public/upload/' . $file->name_generate);

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        if ($action == 'view') {
            return response()->file($path);  // This will display the file in browser
        } else {
            return response()->download($path);  // This will prompt the user to download the file
        }
    }


    public function delete($id)
    {
        $file = DB::table('files')->where('id', $id)->first();
        unlink(storage_path('app/public/upload/' . $file->name_generate));

        $result = DB::table('files')->where('id', $id)->delete();
        // it will return result 
        return $result;
    }

    public function search(Request $request)
    {
        $files = DB::table('files')->where('name', 'like', '%' . $request->keyword . '%')->get();
        return $files;
    }
}
