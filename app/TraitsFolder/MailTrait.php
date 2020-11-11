<?php

namespace App\TraitsFolder;


use App\BasicSetting;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait MailTrait
{
    public function sendMail($email,$name,$subject,$text){
        $basic = BasicSetting::first();
        $body = $basic->email_body;
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->from_email,
            'g_title' => $basic->title,
            'subject' => $subject,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->from_email);
        Config::set('mail.name',$basic->title);

        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$text,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }
    public function sendSms($to,$text){
        $basic = BasicSetting::first();
        $appi = $basic->smsapi;
        $text = urlencode($text);
        $appi = str_replace("{{number}}",$to,$appi);
        $appi = str_replace("{{message}}",$text,$appi);
        $result = file_get_contents($appi);
    }

    public function sendContact($email,$name,$subject,$text,$phone)
    {
        $basic = BasicSetting::first();
        $body = $basic->email_body;
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->from_email,
            'g_title' => $basic->title,
            'subject' => 'Contact Message - '.$subject,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->from_email);
        Config::set('mail.name',$basic->title);

        $body = $basic->email_body;
        $body = str_replace("Hi",'Hi. I\'m',$body);
        $body = str_replace("{{name}}",$name." - ".$phone,$body);
        $body = str_replace("{{message}}",$text,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['email'], $mail_val['name']);
            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['subject']);
        });
    }
    public function userPasswordReset($email)
    {
        $basic = BasicSetting::first();
        $user = User::whereEmail($email)->first();
        $mail_val = [
            'email' => $email,
            'name' => $user->name,
            'g_email' => $basic->from_email,
            'g_title' => $basic->title,
            'subject' => 'Password Reset Request',
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->from_email);
        Config::set('mail.name',$basic->title);

        $reset = DB::table('password_resets')->whereEmail($email)->count();
        $token = Str::random(40);
        $bToken = bcrypt($token);
        if ($reset == 0){
            DB::table('password_resets')->insert(
                ['email' => $email, 'token' => $bToken]
            );
            $url = route('password.reset',$token);
            Mail::send('emails.reset-email', ['name' => $user->name,'link'=>$url,'footer'=>$basic->copy_text], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }else{
            $user = User::whereEmail($email)->first();
            DB::table('password_resets')
                ->where('email', $email)
                ->update(['email' => $email, 'token' => $bToken]);
            $url = route('password.reset',$token);
            Mail::send('emails.reset-email', ['name' => $user->name,'link'=>$url,'footer'=>$basic->copy_text], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }
    }

}