<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;
use DB;

class StickerController extends Controller
{
    public function addStickerForm()
    {
        return view('admin.add_sticker');
    }

    public function addSticker(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sticker' => 'required|image|mimes:jpeg,png,jpg,svg|max:10240',
        ]);
        $name = $request->input('name');
        $image = $request->file('sticker');
        $image_name = null;
        if($request->hasfile('sticker')){
            $destination = public_path('admin/images/sticker/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('admin/images/sticker/thumb/').$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);         
        }

        DB::table('stickers')
            ->insert([
                'name' => $name,
                'image' => $image_name,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Sticker Added Successfully');
    }

    public function stickerList()
    {
        $stickers = DB::table('stickers')->get();
        return view('admin/sticker_list',compact('stickers'));
    }

    public function deleteSticker($id)
    {
        $sticker = DB::table('stickers')->where('id',$id)->first();
        if ($sticker) {
            DB::table('stickers')->where('id',$id)->delete();
            $path = public_path('admin\images\sticker\\'.$sticker->image);
            if (File::exists($path)){
                File::delete($path);
            }

            $path = public_path('admin\images\sticker\thumb\\'.$sticker->image);
            if (File::exists($path)){
                File::delete($path);
            }
        }
        return redirect()->back();
    }
}
