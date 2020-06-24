<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(){
        // if(Auth::check()){ return back();}
        return view('frontend.employee.dashboard');
        
    }

    public function login(){
        return view('frontend.employee.employee_login');
    }

    public function loginProcess(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/employee_dashboard');
        }
        return redirect()->back();
    }

    public function registration(Request $request){
       $user = new User();
       $user->username = $request->username;
       $user->name = $request->name;
       $user->phone = $request->phone;
       $user->role = "EMPLOYEE";
       $user->password = Hash::make($request->password);
       $user->save();

       $request->session()->flash('success', "Employee registration successfully. Please login.");
       return redirect()->back();
    }

    public function applyJob($id){
        echo $id;
    }

    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        Auth::logout();
        return Redirect('employee_login');
    }
}
