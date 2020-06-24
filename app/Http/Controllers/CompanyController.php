<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(){
        return view('frontend.company.dashboard');
        
    }

    public function login(){
        return view('frontend.company.company_login');
    }

    public function loginProcess(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/company_dashboard');
        }
        return redirect()->back();
    }

    public function registration(Request $request){
       $user = new User();
       $user->username = $request->username;
       $user->name = $request->name;
       $user->phone = $request->phone;
       $user->role = "COMPANY";
       $user->password = Hash::make($request->password);
       $user->save();

       $request->session()->flash('success', "Company registration successfully. Please login.");
       return redirect()->back();
    }

    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        Auth::logout();
        return Redirect('company_login');
    }
}
