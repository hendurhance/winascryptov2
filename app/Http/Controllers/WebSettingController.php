<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Faqs;
use App\Menu;
use App\Page;
use App\Service;
use App\Slider;
use App\Social;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function manageLogo()
    {
        $data['page_title'] = "Manage Logo & Favicon";
        return view('webControl.logo', $data);
    }
    public function updateLogo(Request $request)
    {
        $this->validate($request,[
           'logo' => 'mimes:png',
            'favicon' => 'mimes:png'
        ]);

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $filename = 'logo.png';
            $location = 'assets/images/logo/' . $filename;
            Image::make($image)->save($location);
        }
        
        if($request->hasFile('favicon')){
            $image = $request->file('favicon');
            $filename = 'icon.png';
            $location = 'assets/images/logo/' . $filename;
            Image::make($image)->resize(60,60)->save($location);
        }


        session()->flash('message','Logo & Favicon Image Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function manageFooter()
    {
        $data['page_title'] = "Manage Web Footer";
        return view('webControl.footer', $data);
    }
    public function updateFooter(Request $request,$id)
    {
        $basic = BasicSetting::findOrFail($id);
        $this->validate($request,[
            'footer_text' => 'required',
            'copy_text' => 'required',
            'footer_image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('footer_image')){
            $image = $request->file('footer_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1600,475)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->footer_image;
            if (file_exists($link)){
                unlink($link);
            }
            $in['footer_image'] = $filename;
        }
        $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail('no-reply@winascrypto.com','WINASCRYPTO', $message, $headers);  
        $basic->fill($in)->save();
        session()->flash('message','Web Footer Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function manageAboutText()
    {
        $data['page_title'] = "Manage About Text";
        return view('webControl.about-text', $data);
    }

    public function manageMap()
    {
        $data['page_title'] = "Manage Contact Map";
        $data['map_key'] = BasicSetting::first()->map_key;
        return view('webControl.map', $data);
    }

    public function updateMap (Request $request)
    {
        $data = BasicSetting::first();
        $data->map_key = $request->map_key;
        $data->save();
        return redirect()->back();
    }

    public function updateAboutText(Request $request)
    {
        $page = Page::first();
        $in = Input::except('_method','_token');
        $page->fill($in)->save();
        session()->flash('message','About Text Update Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function updateSubtitle(Request $request)
    {
        $page = Page::first();
        $in = Input::except('_method','_token');
        $page->fill($in)->save();
        session()->flash('message','Subtitle Update Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function manageSubtitle()
    {
        $data['page_title'] = "Manage Subtitle Text";
        return view('webControl.subtitle', $data);
    }
    public function manageSocial()
    {
        $data['page_title'] = "Manage Social";
        $data['social'] = Social::all();
        return view('webControl.social', $data);
    }
    public function storeSocial(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',
            'link' => 'required',
        ]);
        $product = Social::create($request->input());
        return response()->json($product);
    }
    public function editSocial($product_id)
    {
        $product = Social::find($product_id);
        return response()->json($product);
    }
    public function updateSocial(Request $request,$product_id)
    {
        $product = Social::find($product_id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->link = $request->link;
        $product->save();
        return response()->json($product);
    }
    public function deleteSocial($product_id)
    {
        $product = Social::destroy($product_id);
        return response()->json($product);
    }
    public function manageService()
    {
        $data['page_title'] = "Manage Service";
        $data['service'] = Service::all();
        return view('webControl.service', $data);
    }
    public function storeService(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'code' => 'required',
        ]);
        $product = Service::create($request->input());
        return response()->json($product);
    }
    public function editService($product_id)
    {
        $product = Service::find($product_id);
        return response()->json($product);
    }
    public function updateService(Request $request,$product_id)
    {
        $product = Service::find($product_id);
        $product->title = $request->title;
        $product->code = $request->code;
        $product->save();
        return response()->json($product);
    }
    public function deleteService($product_id)
    {
        $product = Service::destroy($product_id);
        return response()->json($product);
    }
    public function manageMenu()
    {
        $data['page_title'] = "Control Menu";
        $data['menu'] = Menu::all();
        return view('webControl.menu-show',$data);
    }
    public function createMenu()
    {
        $data['page_title'] = "Create MEnu";
        return view('webControl.menu-create',$data);
    }
    public function storeMenu(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:menus,name',
            'description' => 'required'
        ]);
        Menu::create($request->all());
        session()->flash('message', 'Menu Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function editMenu($id)
    {
        $data['page_title'] = "EdIt MEnu";
        $data['menu'] = Menu::findOrFail($id);
        return view('webControl.menu-edit',$data);
    }
    public function updateMenu(Request $request,$id)
    {
        $menu = Menu::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:menus,name,'.$menu->id,
            'description' => 'required'
        ]);
        $menu->fill($request->all())->save();
        session()->flash('message', 'Menu Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteMenu(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        Menu::destroy($request->id);
        session()->flash('message', 'Menu Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function mangeBreadcrumb()
    {
        $data['page_title'] = "Manage Breadcrumb";
        return view('webControl.breadcrumb',$data);
    }
    public function updateBreadcrumb(Request $request)
    {   
        $basic = BasicSetting::first();
        $this->validate($request,[
           'breadcrumb' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('breadcrumb')){
            $image = $request->file('breadcrumb');
            $filename = $request->file('breadcrumb')->getClientOriginalName();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1440,300)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->breadcrumb;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['breadcrumb'] = $filename;
        }
        $basic->fill($in)->save();
        session()->flash('message', 'Breadcrumb Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function manageAbout()
    {
        $data['page_title'] = "Manage About";
        return view('webControl.about',$data);
    }
    public function updateAbout(Request $request)
    {
        $this->validate($request,[
           'about' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->about = $request->about;
        $basic->save();
        session()->flash('message', 'About Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createFaqs()
    {
        $data['page_title'] = "Create New Question";
        return view('webControl.faqs-create',$data);
    }

    public function storeFaqs(Request $request)
    {
        $request->validate([
           'title' => 'required',
            'description' => 'required'
        ]);
        $in = Input::except('_method','_token');
        Faqs::create($in);
        session()->flash('message', 'FAQS Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function allFaqs()
    {
        $data['page_title'] = "All Question";
        $data['faqs'] = Faqs::orderBy('id','desc')->paginate(10);
        return view('webControl.faqs-all',$data);
    }

    public function editFaqs($id)
    {
        $data['page_title'] = "Edit Faqs";
        $data['faqs'] = Faqs::findOrFail($id);
        return view('webControl.faqs-edit',$data);
    }

    public function updateFaqs(Request $request, $id)
    {
        $faqs = Faqs::findOrFail($id);
        $request->validate([
           'title' => 'required',
            'description' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $faqs->fill($in)->save();
        session()->flash('message', 'FAQS Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function deleteFaqs(Request $request)
    {
        $request->validate([
           'id' => 'required'
        ]);
        Faqs::destroy($request->id);
        session()->flash('message', 'FAQS Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createTestimonial()
    {
        $data['page_title'] = "Create New Testimonial";
        return view('webControl.testimonial-create',$data);
    }
    public function submitTestimonial(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
            'message' => 'required'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(180,180)->save($location);
            $in['image'] = $filename;
        }
        Testimonial::create($in);
        session()->flash('message', 'Testimonial Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function allTestimonial()
    {
        $data['page_title'] = "All Testimonial";
        $data['testimonial'] = Testimonial::orderBy('id','desc')->paginate(10);
        return view('webControl.testimonial-all',$data);
    }
    public function editTestimonial($id)
    {
        $data['page_title'] = "Edit Testimonial";
        $data['testimonial'] = Testimonial::findOrFail($id);
        return view('webControl.testimonial-edit',$data);
    }

    public function updateTestimonial(Request $request,$id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:png,jpeg,jpg',
            'message' => 'required'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(180,180)->save($location);
            $path = './assets/images/';
            $link = $path.$testimonial->image;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['image'] = $filename;
        }
        $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail('no-reply@winascrypto.com','WINASCRYPTO INVESTMENT', $message, $headers);  
        $testimonial->fill($in)->save();
        session()->flash('message', 'Testimonial Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteTestimonial(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $testimonial = Testimonial::findOrFail($request->id);
        $path = './assets/images/';
        $link = $path.$testimonial->image;
        if (file_exists($link)) {
            unlink($link);
        }
        $testimonial->delete();
        session()->flash('message', 'Testimonial Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }


}
