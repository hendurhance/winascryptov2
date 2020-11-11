<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrFail(Auth::user()->id);

        if ($user->email_verify != 1) {
            return redirect()->route('email-verify');
        }
        if ($user->phone_verify != 1) {
            return redirect()->route('phone-verify');
        }
        if ($user->status == 1) {
            Auth::logout();
            session()->flash('message','Sorry Your Account is Block Now..!');
            session()->flash('type','danger');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
