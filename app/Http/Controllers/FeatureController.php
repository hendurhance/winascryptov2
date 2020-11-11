<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BasicSetting;
use App\Feature;

class FeatureController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   
    public function index()
    {
        $general_all = BasicSetting::first();
        $data['site_title'] = $general_all->title;
        $data['page_title'] = "Manage Features";
        $data['features'] = Feature::all();
        return view('webControl.feature', $data);
    }

    
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
                'title' => 'nullable',
                'description' => 'nullable'
            ]);

        if($request->hasFile('photo'))
        {

            $feature['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/features',$feature['photo']);
        }
        $feature['title']		 = $request->title;
        $feature['description'] 	= $request->description;

        Feature::create($feature);

        return back()->with('success', 'New Features Created Successfully!');
    }


    public function update(Request $request, $id)
    {
        $feature = Feature::find($id);
        $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
                'title' => 'nullable',
                'description' => 'nullable'
            ]);

        if($request->hasFile('photo'))
        {
            unlink('assets/images/features/'.$feature->photo);
            $feature['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/features',$feature['photo']);
        }


        $feature['title'] = $request->title;
        $feature['description'] = $request->description;
        $feature->save();

        return back()->with('success', 'Slide Updated Successfully!');
    }

  
    public function destroy(Feature $feature)
    {
        $feature->delete();
        unlink('assets/images/features/'.$feature->photo);
        return back()->with('success', 'Slider Deleted Successfully!');
    }


}
