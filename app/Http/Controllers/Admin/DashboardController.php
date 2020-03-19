<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function dashboardView()
    {
    	$stickers = DB::table('stickers')->count();
    	$templates = DB::table('templates')->count();
        return view('admin.dashboard',compact('stickers','templates'));
    }
}
