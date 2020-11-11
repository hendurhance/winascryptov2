<?php

namespace App\Http\Controllers\Auth;

use App\BasicSetting;
use App\GeneralSetting;
use App\Menu;
use App\TraitsFolder\MailTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    use MailTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getEmailVerification()
    {
        if (Auth::user()->email_verify != 1){
            $data['page_title'] = "Email Verification";
            return view('auth.email-verify',$data);
        }else{
            return redirect('user/dashboard');
        }
    }
    public function emailVerifySubmit(Request $request)
    {
        $this->validate($request,[
            'code' => 'required',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        if ($user->email_code == $request->code)
        {
            $useOwner = User::findOrFail(Auth::user()->id);
            $useOwner->email_verify = 1;
            $useOwner->save();
            return redirect()->route('user-dashboard');
        }else{
            session()->flash('message','Verification Code in Invalid');
            session()->flash('type','danger');
            return redirect()->route('email-verify');
        }
    }
    public function resendEmail(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->email_time > Carbon::now())
        {
            $tt = Carbon::parse($user->email_time)->diffForHumans();
            session()->flash('message',"Please Try Again. After $tt.");
            session()->flash('type','danger');
            return redirect()->route('email-verify');
        }else{
            $email_code = strtoupper(Str::random(6));
            $text = "Your Verification Code Is: <b>$email_code</b>";
            $this->sendMail($user->email,$user->name,'Email verification',$text);
            $useOwner = User::findOrFail($user->id);
            $useOwner->email_code = $email_code;
            $useOwner->email_time = Carbon::parse()->addMinutes(5);
            $useOwner->save();
            session()->flash('message',"New Email Verification Code Send Your Email Address.");
            session()->flash('type','success');
            return redirect()->route('email-verify');
        }
    }
    public function getPhoneVerification()
    {
        if (Auth::user()->phone_verify != 1){
            $data['page_title'] = "Phone Verification";
            return view('auth.phone-verify',$data);
        }else{
            return redirect('user/dashboard');
        }
    }
    public function phoneVerifySubmit(Request $request)
    {
        $this->validate($request,[
            'code' => 'required',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        if ($user->phone_code == $request->code)
        {
            $useOwner = User::findOrFail($user->id);
            $useOwner->phone_verify = 1;
            $useOwner->save();
            return redirect('user/dashboard');
        }else{
            session()->flash('message','Verification Code in Invalid');
            session()->flash('type','danger');
            return redirect()->back();
        }
    }
    public function changePhone()
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->phone_time > Carbon::now())
        {
            $tt = Carbon::parse($user->phone_time)->diffForHumans();
            session()->flash('message',"Please Try Again. After $tt.");
            session()->flash('type','danger');
            return redirect()->back();
        }
        if (Auth::user()->phone_verify != 1){
            $data['page_title'] = "Change Verification Phone";
            return view('auth.phone-change',$data);
        }else{
            return redirect('user/dashboard');
        }
    }

    public function resendPhone(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->phone_time > Carbon::now())
        {
            $tt = Carbon::parse($user->phone_time)->diffForHumans();
            session()->flash('message',"Please Try Again. After $tt.");
            session()->flash('type','danger');
            return redirect()->back();
        }else{
            $phone_code = strtoupper(Str::random(6));
            $txt = "Your Verification Code is: $phone_code";
            $txt = urlencode($txt);
            $to = $user->phone;
            $this->sendSms($to,$txt);
            $useOwner = User::findOrFail($user->id);
            $useOwner->phone_code = $phone_code;
            $useOwner->phone_time = Carbon::parse()->addMinutes(5);
            $useOwner->save();
            session()->flash('message',"New Phone Verification Code Send Your Phone Number.");
            session()->flash('type',"success");
            return redirect()->back();
        }
    }
    public function submitChangePhone(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request,[
           'phone' => 'required|min:10|unique:users,phone,'.$user
        ]);
        $useOwner = User::findOrFail(Auth::user()->id);
        $useOwner->phone = $request->phone;
        $phone_code = strtoupper(Str::random(6));
        $txt = "Your Verification Code is: $phone_code";
        $txt = urlencode($txt);
        $to = $request->phone;
        $this->sendSms($to,$txt);
        $useOwner->phone_code = $phone_code;
        $useOwner->phone_time = Carbon::parse()->addMinutes(5);
        $useOwner->save();
        session()->flash('message','Your Phone Number Changes Successfully. Please verify Now.');
        session()->flash('type',"success");
        return redirect()->route('phone-verify');
    }




}
