<?php

namespace App\Http\Controllers\backend;

use App\Models\Ads;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\traid\UserRole;
use App\Http\Controllers\traid\FileUpload;

class BannerController extends Controller
{
    use UserRole,FileUpload;

    public function index()
    {
        // if($this->isSuperAdmin()){
            $banner = Banner::latest()->paginate(4);
            return view('backend.banner.lists',compact('banner'));
        // }

    }


    public function all_ads()
    {
        // if($this->isSuperAdmin()){
            $ads = Ads::latest()->paginate(4);
            return view('backend.banner.ads_list',compact('ads'));
        // }
    }

    public function edit_ads($id)
    {
        // if($this->isSuperAdmin()){
            $ads = Ads::findOrFail($id);
             return view('backend.banner.ads_edit',compact('ads'));
        // }
    }


    public function create()
    {
        // if($this->isSuperAdmin()){
            return view('backend.banner.create');
        // }

    }

    public function create_ads()
    {
        // if($this->isSuperAdmin() || $this->isStaff()){
            return view('backend.banner.create_ads');
        // }
    }

    public function ads_store(Request $request)
    {
        $request->validate([
            'file' => 'required|dimensions:min_width=1810,min_height=184',
        ]);
        $file_path = 'images/banner/';
        $request->validate(['file' => 'required'],['file.required' => 'Image Required']);
        $file = $request->file('file');
        $banner = new Ads();
        $banner->image = $this->save_file_path($file,$file_path);
        $banner->page = $request->page;
        $banner->save();
        Session::flash('message', 'Ads was created successfully');
        return redirect('store-admin/ads/all');
    }
    public function update_ads(Request $request,$id)
    {
        $request->validate([
            'file' => 'required|dimensions:min_width=1810,min_height=184',
        ]);
        // if($this->isSuperAdmin()){
            $ads = Ads::findOrFail($id);
            $file = $request->file('file');
            if($file){
               if(File::exists(public_path($ads->image))){
                  File::delete(public_path($ads->image));
                }

                $newFileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banner/'), $newFileName);
                $ads->image = 'images/banner/' . $newFileName;
                $ads->page = $request->page;
                $ads->update();

            }

            Session::flash('message', 'Ads was updated successfully');
           return redirect('store-admin/ads/all');
        // }
    }

    public function store(Request $request)
    {
        $file_path = 'images/banner/';
        $request->validate(['file' => 'required'],['file.required' => 'Image Required']);
        $file = $request->file('file');
        $banner = new Banner();
        $banner->image = $this->save_file_path($file,$file_path);
        $banner->save();
        Session::flash('message', 'Banner was created successfully');
        return redirect('store-admin/banner/all');

    }

    public function edit($id)
    {

        if($this->isSuperAdmin()){
            $banner = Banner::findOrFail($id);
             return view('backend.banner.edit',compact('banner'));
        }
    }

    public function update(Request $request,$id)
    {

        $banner = Banner::findOrFail($id);
        $file = $request->file('file');
        if($file){
            if(File::exists(public_path($banner->image))){
                File::delete(public_path($banner->image));
            }

            $newFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/banner/'), $newFileName);
            $banner->image = 'images/banner/' . $newFileName;
            $banner->update();

        }

        Session::flash('message', 'Banner was updated successfully');
        return redirect('store-admin/banner/all');

    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        if($banner->image){
            if(File::exists(public_path($banner->image))){
                File::delete(public_path($banner->image));
            }
           $banner->delete();
        }
        Session::flash('message', 'Banner was deleted successfully');

        return redirect()->back();

    }
    public function delete_ads($id)
    {
        $banner = Ads::findOrFail($id);
        if($banner->image){
            if(File::exists(public_path($banner->image))){
                File::delete(public_path($banner->image));
            }
           $banner->delete();
        }
        Session::flash('message', 'Ads was deleted successfully');
        return redirect()->back();

    }
}
