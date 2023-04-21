<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\user;

class userController extends Controller
{
    public function change_password()
    {
        return view('user.change_password');
    }//end method

    public function change_password_process(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
            'password1' => 'required|min:4',
            'password2' => 'required|min:4|same:password1',
        ]);

        if (! Hash::check($validated['password'], $request->user()->password)) {

            return redirect('/change_password')->with('error','current password not match')->onlyInput('password1','password2','password');
        }

        $pass = Hash::make($validated['password1']);

        $users = user::find(auth()->user()->id);
        $users->password = $pass;
        $users->save();

        $request->session()->passwordConfirmed();

        return back()->with('success','current password is update now');

        
    }//end method

    public function profile()
    {
        return view('user.profile');
    }//end method

    public function profile_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
         }

         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
    
            $file->move(public_path('assets/profiles/'), $fileName);

            if(auth()->user()->picture != 'empty.png')
            {
                
                $filePath = public_path('assets/profiles/'.auth()->user()->picture);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

            }
    
            // you can store fileName to database here

            //Get the authenticated user
             auth()->user()->picture = $fileName;

             //auth()->user()->save();

             $users = user::find(auth()->user()->id);
             $users->picture = $fileName;
             $users->save();

            return back()->with('success',$fileName)->onlyInput('file');;
            
        }

        return back()->with('error','fail something wrong with images');
    }//end method

    public function edit_profile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => [
                'required',Rule::unique('users')->ignore( auth()->user()->email,'email')],
            'phone' => 'required|numeric',
        ]);

        $user = user::find(auth()->user()->id);
        $user->email = $validated['email'];
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->save();

        auth()->user()->email = $validated['email'];
        auth()->user()->name = $validated['name'];
        auth()->user()->phone = $validated['phone'];
        auth()->user()->save();

        return redirect(route('user.profile'))->with('success','finish edit profile');
    }//end method

}//end class
