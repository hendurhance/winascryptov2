<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['page_title'] = "Slider Or Banner Manage";
         $data['slide'] = Slider::first();
         return view('webControl.slider', $data);
    }

    public function update(Request $request)
    {
        $slide = Slider::first();
        $this->validate($request,
            [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            ]);

       if($request->hasFile('image'))
        {
             $path = 'assets/images/slider/'.$slide->image;

                if(file_exists($path))
                {
                    unlink($path);
                }
                
            $slide['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images/slider',$slide['image']);
        }

        $slide['title'] = $request->bold;
        $slide['subtitle'] = $request->small;
        $slide->save();

        return back()->with('success', 'Banner Updated Successfully!');
    }
}
