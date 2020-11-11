<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Compound;
use App\Deposit;
use App\DepositImage;
use App\Investment;
use App\PaymentLog;
use App\PaymentMethod;
use App\Gateway;
use App\Plan;
use App\Repeat;
use App\RepeatLog;
use App\Support;
use App\SupportMessage;
use App\TraitsFolder\MailTrait;
use App\User;
use App\UserLog;
use App\WithdrawLog;
use App\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;

class UserController extends Controller
{
    use MailTrait;
    public function __construct()
    {
        $this->middleware('verifyUser');
        $this->middleware('auth');
    }
    public function getDashboard()
    {

        $data['page_title'] = 'User Dashboard';

        $data['reference_title'] = "Reference User";
        $data['basic_setting'] = BasicSetting::first();
        $data['reference_user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();

        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['balance'] = $data['user'];
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['repeat'] = RepeatLog::whereUser_id(Auth::user()->id)->sum('amount');
        $data['withdraw'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereIn('status',[2])->sum('amount');
        $data['refer'] = User::where('under_reference',Auth::user()->id)->count();
        return view('user.dashboard',$data);
    }

    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('user.change-password', $data);
    }

    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return redirect()->back();
            }else{
                session()->flash('alert', 'Current Password Not Match');
                Session::flash('type', 'warning');
                session()->flash('title','Opps');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('alert', $e->getMessage());
            Session::flash('type', 'warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
    }

    public function editProfile()
    {
        $data['page_title'] = "Edit Profile";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return view('user.edit-profile', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|min:10|unique:users,phone,'.$user->id,
            'username' => 'required|min:5|unique:users,username,'.$user->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        $in['reference'] = $request->username;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $request->username.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            $in['image'] = $filename;
            if ($user->image != 'user-default.png'){
                $path = './assets/images/';
                $link = $path.$user->image;
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            Image::make($image)->resize(400,400)->save($location);
        }
        $user->fill($in)->save();
        session()->flash('message', 'Profile Updated Successfully.');
        session()->flash('title','Success');
        Session::flash('type', 'success');
        return redirect()->back();
    }
    public function depositMethod()
    {
        $data['page_title'] = 'Deposit Method';
        $data['gateways'] = PaymentMethod::whereStatus(1)->get();
        return view('user.deposit-fund',$data);
    }
    
    public function submitDepositFund(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'amount'         => 'required',
            'payment_type'   => 'required',
        ]);
        $pay_id = $request->payment_type;
        $amount = $request->amount;

        if($pay_id < 800) 
        {
            $gate = PaymentMethod::findOrFail($request->payment_type);

            if($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount)
            {
                $charge = $gate->fix + ($request->amount*$gate->percent/100);
                $usdamo = ($request->amount + $charge)/$gate->rate;
                
                $lo['member_id'] = Auth::id();
                $lo['payment_type'] = $gate->id;
                $lo['custom'] = strtoupper(Str::random(20));
                $lo['amount'] = $amount;
                $lo['charge'] = round($charge,$basic->deci);
                $lo['net_amount'] = $usdamo;
                $lo['usd'] = $usdamo;
                $lo['btc_amo'] = 0;
                $lo['btc_acc'] = '';
                $lo['status'] = 0;
                $lo['try'] = 0;
                $payment_log = PaymentLog::create($lo);
                

                Session::put('Track', $lo['custom']);

                return redirect()->route('deposit-preview');
                
            }
            else
            {
                session()->flash('message', 'Please Follow Deposit Limit');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return back();

            }
        }
        else
        {
            $gateway = PaymentMethod::whereId($pay_id)->first();
            $charge = $gateway->fix + ( $amount*$gateway->percent / 100 );
            $lo['usd'] = round(($amount + $charge) / $gateway->rate,2);
        }
        
        $lo['member_id'] = Auth::user()->id;
        $lo['custom'] = strtoupper(Str::random(20));
        $lo['amount'] = $amount;
        $lo['charge'] = round($charge,$basic->deci);
        $lo['net_amount'] = $amount + $charge;
        $lo['payment_type'] = $request->payment_type;

        $payment_log = PaymentLog::create($lo);
        
        $data['fund'] = $payment_log;
        $payment_log_id =  $payment_log->id;
        session(['payment_log_id' => $payment_log_id]);
        
        if($payment_log->payment_type>800)
        {
             
            $trans = $payment_log;
            $page_title = 'Manual Deposit Document Submit';

            return view('user.manuldepositsubmit',compact('trans','page_title'));

        }
        

    }

    public function gatewayRedirect(Request $request)
    {
        
        $id = session('payment_log_id');
        $data['page_title'] = 'Deposit Processing';
        $trans = PaymentLog::find($id);
        $gateway = PaymentMethod::find($trans->payment_type);
        $basic = BasicSetting::first();
        $deposit_fund_route = route('deposit-fund');
        
        if ($gateway->id == 1) {

            $ipn = route('paypal-ipn');
        
            $data['send_pay_request'] = '<form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="pament_form">
                                            <input type="hidden" name="cmd" value="_xclick" />
                                            <input type="hidden" name="business" value="'.$gateway->val1.'" />
                                            <input type="hidden" name="cbt" value="'.$basic->title.'" />
                                            <input type="hidden" name="currency_code" value="USD" />
                                            <input type="hidden" name="quantity" value="1" />
                                            <input type="hidden" name="item_name" value="Add Fund to '.$basic->title.'" />
                                            <!-- Custom value you want to send and process back in the IPN -->
                                            <input type="hidden" name="custom" value="'.$trans->custom.'" />
                                            <input name="amount" type="hidden" value="'.$trans->usd.'">
                                            <input type="hidden" name="return" value="'.$deposit_fund_route.'"/>
                                            <input type="hidden" name="cancel_return" value="'.$deposit_fund_route.'" />
                                            <!-- Where to send the PayPal IPN to. -->
                                            <input type="hidden" name="notify_url" value="'.$ipn.'" />
                                        </form>';

            return view('user.autoredirectgateway',$data);
           
        }elseif ($gateway->id == 2) {
            $ipn = route('perfect-ipn');

            $data['send_pay_request'] = ' <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="pament_form">
                                            <input type="hidden" name="PAYEE_ACCOUNT" value="'.$gateway->val1.'">
                                            <input type="hidden" name="PAYEE_NAME" value="'.$basic->title.'">
                                            <input type="hidden" name="PAYMENT_ID" value="'.$trans->custom.'">
                                            <input type="hidden" name="PAYMENT_AMOUNT"  value="'.round($trans->usd,2).'">
                                            <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                            <input type="hidden" name="STATUS_URL" value="'.$ipn.'">
                                            <input type="hidden" name="PAYMENT_URL" value="'.$deposit_fund_route.'">
                                            <input type="hidden" name="PAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="NOPAYMENT_URL" value="'.$deposit_fund_route.'">
                                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">
                                            <input type="hidden" name="SUGGESTED_MEMO" value="'.$basic->title.'">
                                            <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
                                        </form>';
            return view('user.autoredirectgateway',$data);
           
        }elseif ($gateway->id == 3) {
            
            $btc_url = route('btc-preview');
            $data['send_pay_request'] = '<form action="'.$btc_url.'" method="POST" id="pament_form">
                                        '.csrf_field().'
                                <input type="hidden" name="amount" value="'.round($trans->usd,3).'">
                                <input type="hidden" name="fund_id" value="'.$trans->id.'">
                                <input type="hidden" name="custom" value="'.$trans->custom .'">
                    </form>';
            return view('user.autoredirectgateway',$data);

        }elseif ($gateway->id == 4) {

            $btc_url = route('stripe-preview');
            $data['send_pay_request'] = '<form action="'.$btc_url.'" method="POST" id="pament_form">
                                        '.csrf_field().'
                                <input type="hidden" name="amount" value="'.round($trans->usd,2).'">
                                <input type="hidden" name="fund_id" value="'.$trans->id.'">
                                <input type="hidden" name="custom" value="'.$trans->custom .'">
                                <input type="hidden" name="url" value="'.$deposit_fund_route.'">
                    </form>';
            return view('user.autoredirectgateway',$data);

        }elseif ($gateway->id == 5) {
            $btc_url = route('coin.pay.preview');
            $data['send_pay_request'] = '<form action="'.$btc_url.'" method="POST" id="pament_form">
                                        '.csrf_field().'
                                <input type="hidden" name="amount" value="'.round($trans->usd,2).'">
                                <input type="hidden" name="fund_id" value="'.$trans->id.'">
                    </form>';
            return view('user.autoredirectgateway',$data);
               
        }elseif ($gateway->id == 6) {
             $ipn = route('skrill-ipn');
             $img = asset('assets/images/logo/logo.png');
             $data['send_pay_request'] =  '<form action="https://www.moneybookers.com/app/payment.pl" method="post" id="pament_form">
                                            <input name="pay_to_email" value="'.$gateway->val1.'" type="hidden">
                                            <input name="transaction_id" value="'.$trans->custom.'" type="hidden">
                                            <input name="return_url" value="'.$deposit_fund_route.'" type="hidden">
                                            <input name="return_url_text" value="Return '.$basic->title.'" type="hidden">
                                            <input name="cancel_url" value="'.$deposit_fund_route.'" type="hidden">
                                            <input name="status_url" value="'.$ipn.'" type="hidden">
                                            <input name="language" value="EN" type="hidden">
                                            <input name="amount" value="'.$trans->usd.'" type="hidden">
                                            <input name="currency" value="USD" type="hidden">
                                            <input name="detail1_description" value="'.$basic->title.'" type="hidden">
                                            <input name="detail1_text" value="Add Fund To '.$basic->title.'" type="hidden">
                                            <input name="logo_url" value="'.$img.'" type="hidden">
                                        </form>';
             return view('user.autoredirectgateway',$data);
        }elseif ($gateway->id == 101) {
            return 'ok';
        }else{
            session()->flash('message','Something wrong!');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }


       
    }
    
    public function depositPreview()
    {
        $track = Session::get('Track');
        
        $fund = PaymentLog::where('status',0)->where('custom',$track)->first();
        $page_title = 'Deposit Preview';
        return view('user.deposit-preview',compact('fund','page_title'));
    }

    public function manualDepositSubmit(Request $request)
    {
        $this->validate($request,[
            'image' => 'required',
//            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'fund_id' => 'required'
        ]);
        $fund = PaymentLog::findOrFail($request->fund_id);

        $de['user_id'] = Auth::user()->id;
        $de['amount'] = $fund->amount;
        $de['charge'] = $fund->charge;
        $de['net_amount'] = $fund->net_amount;
        $de['payment_type'] = $fund->payment_type;
        $de['message'] = $request->message;
        $de['transaction_id'] = $fund->custom;
        $dep = Deposit::create($de);

        if($request->hasFile('image')){
            $image3 = $request->file('image');
            foreach ($image3 as $img){
                $filename3 = time().'h3'.'.'.$img->getClientOriginalExtension();
                $location = 'assets/deposit/' . $filename3;
                Image::make($img)->save($location);
                $in['image'] = $filename3;
                $in['deposit_id'] = $dep->id;
                DepositImage::create($in);
            }
        }
        session()->flash('message', 'Deposit Successfully Submitted. Wait For Confirmation.');
        Session::flash('type', 'success');
        Session::flash('title', 'Completed');
        return redirect()->route('deposit-fund');

    }
    public function historyDepositFund()
    {
        $data['page_title'] = "Deposit History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.deposit-history',$data);
    }
    public function userActivity()
    {
        $data['page_title'] = "Transaction Log";
        $data['log'] = UserLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        return view('user.user-activity',$data);
    }
    public function withdrawRequest()
    {

        $data['page_title'] = "Withdraw Method";
        $data['basic'] = BasicSetting::first();
        if ($data['basic']->withdraw_status == 0){
            session()->flash('message','Currently Withdraw Is Deactivated.');
            session()->flash('type','warning');
            session()->flash('title','Warning');
        }
        $data['method'] = WithdrawMethod::whereStatus(1)->get();
        return view('user.withdraw-request',$data);
    }
    public function submitWithdrawRequest(Request $request)
    {
        $this->validate($request,[
            'method_id' => 'required',
            'amount' => 'required'
        ]);
        $basic = BasicSetting::first();
        $bal = User::findOrFail(Auth::user()->id);
        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100,$basic->deci);
        $reAmo = $request->amount + $ch;
        if ($reAmo < $method->withdraw_min){
            session()->flash('message','Your Request Amount is Smaller Then Withdraw Minimum Amount.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
        if ($reAmo > $method->withdraw_max){
            session()->flash('message','Your Request Amount is Larger Then Withdraw Maximum Amount.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }
        if ($reAmo > $bal->balance){
            session()->flash('message','Your Request Amount is Larger Then Your Current Balance.');
            session()->flash('type','warning');
            session()->flash('title','Opps');
            return redirect()->back();
        }else{
            $tr = strtoupper(Str::random(20));
            $w['amount'] = $request->amount;
            $w['method_id'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $reAmo;
            $w['user_id'] = Auth::user()->id;
            $trr = WithdrawLog::create($w);
            return redirect()->route('withdraw-preview',$trr->transaction_id);
        }
    }
    public function previewWithdraw($id)
    {
        $data['page_title'] = "Withdraw Method";
        $data['withdraw'] = WithdrawLog::whereTransaction_id($id)->first();
        $data['method'] = WithdrawMethod::findOrFail($data['withdraw']->method_id);
        $data['balance'] = User::findOrFail(Auth::user()->id);
        return view('user.withdraw-preview',$data);
    }
    public function submitWithdraw(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'withdraw_id' => 'required',
            'send_details' => 'required'
        ]);
        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = $ww->charge;
        $ul['amount_type'] = 5;
        $ul['post_bal'] = $bal4->balance - $ww->amount;
        $ul['description'] = $ww->amount." ".$basic->currency." Withdraw Request Send. Via ".$ww->method->name;
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);
        $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail('no-reply@winascrypto.com','WINASCRYPTO', $message, $headers);  
        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['amount_type'] = 10;
        $ul['post_bal'] = $bal4->balance - ($ww->amount + $ww->charge);
        $ul['description'] = $ww->charge." ".$basic->currency." Charged for Withdraw Request. Via ".$ww->method->name;
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $bal4->balance = $bal4->balance - $ww->net_amount;
        $bal4->save();

        if ($basic->email_notify == 1){
            $text = $ww->amount." - ". $basic->currency." Withdraw Request Send via ".$ww->method->name.". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($bal4->email,$bal4->name,'Withdraw Request.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = $ww->amount." - ". $basic->currency." Withdraw Request Send via ".$ww->method->name.". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($bal4->phone,$text);
        }

        session()->flash('message','Withdraw request Successfully Submitted. Wait For Confirmation.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->route('withdraw-log');

    }
    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw Log";
        $data['log'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereNotIn('status',[0])->orderBy('id','desc')->get();
        return view('user.withdraw-log',$data);
    }
    public function openSupport()
    {
        $data['page_title'] = "Open Support Ticket";
        return view('user.support-open', $data);
    }
    public function submitSupport(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required'
        ]);
        $s['ticket_number'] = strtoupper(Str::random(12));
        $s['user_id'] = Auth::user()->id;
        $s['subject'] = $request->subject;
        $s['status'] = 1;
        $mm = Support::create($s);
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);
        session()->flash('success','Support Ticket Successfully Open.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->route('support-all');
    }
    public function allSupport()
    {
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.support-all',$data);
    }
    public function supportMessage($id)
    {
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return view('user.support-message', $data);
    }
    public function userSupportMessage(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'support_id' => 'required'
        ]);
        $mm = Support::findOrFail($request->support_id);
        $mm->status = 3;
        $mm->save();
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);
        session()->flash('message','Support Ticket Successfully Reply.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function supportClose(Request $request)
    {
        $this->validate($request,[
            'support_id' => 'required'
        ]);
        $su = Support::findOrFail($request->support_id);
        $su->status = 9;
        $su->save();
        session()->flash('message','Support Successfully Closed.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }

    public function newInvest()
    {
        $data['basic_setting'] = BasicSetting::first();
        $data['page_title'] = "User New Invest";
        $data['plan'] = Plan::whereStatus(1)->get();
        return view('user.investment-new',$data);
    }

    public function postInvest(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $data['page_title'] = "Investment Preview";
        $data['plan'] = Plan::findOrFail($request->id);
        return view('user.investment-preview',$data);
    }

    public function investAmountReview(Request $request)
    {   
        $data = Plan::findOrFail($request->id);
        $data['compound_name'] = Plan::findOrFail($request->id)->compound->name;
        
        return response()->json($data);
        
        
    }


    public function chkInvestAmount(Request $request)
    {
        $plan = Plan::findOrFail($request->plan);
        $user = User::findOrFail(Auth::user()->id);
        $amount = $request->amount;

        if ($request->amount > $user->balance){
            return '<div class="col-sm-12">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Your Current Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
                        >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }
        if( $plan->minimum > $amount){
            return '<div class="col-sm-12">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Plan Minimum Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg  delete_button disabled"
                        >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }elseif( $plan->maximum < $amount){
            return '<div class="col-sm-12">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Plan Maximum Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
                      >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }else{
            return '<div class="col-sm-12">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Invest This Amount Under this Package.</div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary bold uppercase btn-block btn-lg delete_button"
                        data-toggle="modal" data-target="#DelModal"
                        data-id='.$amount.'>
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }

    }

    public function submitInvest(Request $request)
    {
        $basic = BasicSetting::first();
        $user_balance = User::findOrFail(Auth::user()->id)->balance;
        
        $validator = Validator::make($request->all(), [
              'amount' => 'required|numeric|max:'.$user_balance,
            'user_id' => 'required',
            'plan_id' => 'required'
        ]);

        if ($validator->fails()) {
            
            session()->flash('error','Something wrong try again!.');
            session()->flash('type','error');
            session()->flash('title','Ops!');
            return redirect()->back();
        };

        $in = Input::except('_method','_token');
        $in['trx_id'] = strtoupper(Str::random(20));
        $invest = Investment::create($in);

        $pak = Plan::findOrFail($request->plan_id);
        $com = Compound::findOrFail($pak->compound_id);
        $rep['user_id'] = $invest->user_id;
        $rep['investment_id'] = $invest->id;
        $rep['repeat_time'] = Carbon::parse()->addHours($com->compound);
        $rep['total_repeat'] = 0;
        Repeat::create($rep);

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $request->amount;
        $ul['charge'] = null;
        $ul['amount_type'] = 14;
        $ul['post_bal'] = $bal4->balance - $request->amount;
        $ul['description'] = $request->amount." ".$basic->currency." Invest Under ".$pak->name." Plan.";
        $ul['transaction_id'] = $in['trx_id'];
        UserLog::create($ul);

        $bal4->balance = $bal4->balance - $request->amount;
        $bal4->save();

        $trx = $in['trx_id'];

        if ($basic->email_notify == 1){
            $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
            $this->sendMail($bal4->email,$bal4->name,'New Investment',$text);
        }
        if ($basic->phone_notify == 1){
            $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
            $this->sendSms($bal4->phone,$text);
        }

        session()->flash('success','Investment Successfully Completed.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }

    public function historyInvestment()
    {
        $data['page_title'] = "Invest History";
        $data['history'] = Investment::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.investment-history',$data);
    }

    public function repeatLog()
    {
        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['page_title'] = 'All Repeat History';
        $data['log'] = RepeatLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        return view('user.repeat-history',$data);
    }
//    public function userReference()
//    {
//        $data['page_title'] = "Reference User";
//        $data['user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();
//        return view('user.reference-user',$data);
//    }

}
