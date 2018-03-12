<?php

namespace App\Http\Controllers;

use App\Banner;

use Illuminate\Http\Request;
use Session;

class BannerController extends Controller
{
    public function index()
    {
        //fetch all banners by date
        $banners = Banner::orderBy('created_at','desc')->get();
        
        //pass banners data to view and load list view
        return view('banners.index', ['banners' => $banners]);
    }
    
    public function details($id)
    {
        //fetch banner data
        $banner = Banner::find($id);
        
        //pass banner data to view and load list view
        return view('banners.details', ['banner' => $banner]);
    }
    
    public function add()
    {
        //load form view
        return view('banners.add');
    }
    
    public function insert(Request $request)
    {
        //validate banner data
        $this->validate($request, [
            'title' => 'required',
            'banner_image' => 'required'
        ]);
        
        //deal with the image
        if ($request->hasFile('banner_image')) {
            $imageName = time().'.'.$request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move(public_path('banners'), $imageName);
            $imageLocation = public_path('banners') . $imageName;
        }
        
        //get banner data
        $bannerData = [
            'title' => $request->input('title'),
            'imageLocation' => $imageLocation,
        ];
        
        //insert banner data
        Banner::create($bannerData);
        
        //store status message
        Session::flash('success_msg', 'Banner added successfully!');

        return redirect()->route('banners.index');
    }
    
    public function store(Request $request)
    {
    
        // get current time and append the upload file extension to it,
        // then put that name to $photoName variable.
        $photoName = time().'.'.$request->user_photo->getClientOriginalExtension();
    
        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->user_photo->move(public_path('banners'), $photoName);
    }
    
    public function edit($id)
    {
        //get banner data by id
        $banner = Banner::find($id);
        
        //load form view
        return view('banners.edit', ['banner' => $banner]);
    }
    
    public function update($id, Request $request)
    {
        //validate banner data
        $this->validate($request, [
            'title' => 'required',
            'imageLocation' => 'required'
        ]);
        
        //get banner data
        $bannerData = $request->all();
        
        //update banner data
        Banner::find($id)->update($bannerData);
        
        //store status message
        Session::flash('success_msg', 'Banner updated successfully!');

        return redirect()->route('banners.index');
    }
    
    public function delete($id)
    {
        //update banner data
        Banner::find($id)->delete();
        
        //store status message
        Session::flash('success_msg', 'Banner deleted successfully!');

        return redirect()->route('banners.index');
    }
    
}
