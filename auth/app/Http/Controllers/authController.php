<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Mail\forgot_password;
use Illuminate\Support\Facades\Mail;

class authController extends Controller
{
    public function index()
    {
        DB::table('password_reset_tokens')->where('token_expired','<' , time())->delete();

        return view('auth.index');
    }// end method

    public function login(Request $request)
    {
        $remember = $request->input('remember_token ');

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($validated, $remember)) 
        {
            $request->session()->regenerate();
            return redirect()->intended('change_password');
        }

        return back()->with('error','accout or password wrong')->onlyInput('email');

    }//end method

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect(route('auth'))->with('success','logout');

    }// end method

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }//end method

    public function forgot_password_email(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:password_reset_tokens,email',
        ],[
            'email.unique' => 'This email address has already been registered.',
        ]);

        $token_data = Str::random(32);
        $token = Hash::make($token_data);
        $domain = url('/');

        DB::table('password_reset_tokens')->insert([
            'email' => $validated['email'],
            'token' => $token,
            'token_expired' => time() + 60 *2, //2 minute will be delete back
        ]);

        Mail::to($validated['email'])->send(new forgot_password($validated['email'],$token_data,$domain));

        return back()->with('success','check email for reset password');

    }//end method

    public function reset(Request $request)
    {   
        if (!$request->has('token') && !$request->has('email')) {
            return redirect(route('auth'));
        }

        $token = $request->input('token');
        $email = $request->input('email');

        $users = DB::table('password_reset_tokens')->where('email', $email)->get()->first();

        if($users)
        {
            if(Hash::check($token, $users->token) && $users->token_expired >= time())
            {
                return view('auth.reset_forgot_password', ['email' => $email]);
            }
            return redirect(route('auth'))->with('error','token is expired try again later')->withInput();
        }

        return redirect(route('auth'))->withInput();


    }//end method

    public function reset_password(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password1' => 'required|min:8',
            'password2' => 'required|min:8|same:password1',
        ]);

        $pass = Hash::make($validated['password1']);
        DB::table('users')->where('email',  $validated['email'])->update(['password' => $pass]);

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect(route('auth'))->with('success','password change');
    }//end method

}//end class
