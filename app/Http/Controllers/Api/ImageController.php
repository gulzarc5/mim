<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ImageController extends Controller
{
    public function templates()
    {
        $template = DB::table('templates')->orderBy('id','desc')->get();
        $response = [
            'status' => true,
            'message' => 'template List',
            'data' => $template,
        ];    	
        return response()->json($response, 200);
    }

    public function stickers()
    {
        $stickers = DB::table('stickers')->orderBy('id','desc')->get();
        $response = [
            'status' => true,
            'message' => 'Sticker List',
            'data' => $stickers,
        ];    	
        return response()->json($response, 200);
    }
}
