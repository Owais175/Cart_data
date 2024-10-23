<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function signup()
    {
        return view('account.signup');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        auth()->login($user);

        session()->flash('Success', 'Sign In Succussfully!');
        return redirect()->route('account.dashboard', $user);
    }

    public function loginuser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:250',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt($credentials)) {
            session()->flash('Success', 'Sign In Succussfully!');
            return redirect()->intended('dashboard');
        }
        session()->flash('Success', 'Invalid Credentials!');
        return redirect()->back();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        session()->flash('Success', 'Logout Succussfully!');
        return redirect()->route('account.signup');
    }
    public function dashboard(Request $request)
    {
        return view('account.dashboard');
    }

    public function accountdetails()
    {
        $account = Auth::user();
        return view('account.account-details', compact('account'));
    }

    public function updateaccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        // dd($user);
        if (!Hash::check($request->current_password, $user->password)) {
            Session()->flash('Error', 'Your current password is incorrect!');
            return back();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        Session()->flash('Success', 'Your password has been updated successfully!');

        return back();
    }

}
