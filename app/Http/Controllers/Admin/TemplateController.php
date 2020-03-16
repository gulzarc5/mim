<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;
use DB;

class TemplateController extends Controller
{
    public function addTemplateForm()
    {
        return view('admin.add_template');
    }

    public function addTemplate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'template' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        $name = $request->input('name');
        $image = $request->file('template');
        $image_name = null;
        if($request->hasfile('template')){
            $destination = public_path('admin/images/template/');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time()).".".$image_extension;
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);
            $thumb_path = public_path('admin/images/template/thumb/').$image_name;
            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path);         
        }

        DB::table('templates')
            ->insert([
                'name' => $name,
                'image' => $image_name,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Template Added Successfully');
    }

    public function templateList()
    {
        $templates = DB::table('templates')->get();
        return view('admin/template_list',compact('templates'));
    }

    public function deleteTemplate($id)
    {
        $sticker = DB::table('templates')->where('id',$id)->first();
        if ($sticker) {
            DB::table('templates')->where('id',$id)->delete();
            $path = public_path('admin\images\template\\'.$sticker->image);
            if (File::exists($path)){
                File::delete($path);
            }

            $path = public_path('admin\images\template\thumb\\'.$sticker->image);
            if (File::exists($path)){
                File::delete($path);
            }
        }
        return redirect()->back();
    }
}
