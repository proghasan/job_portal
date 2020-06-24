<?php

namespace App\Http\Controllers;

use App\Apply;
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
        $check = Apply::where('user_id', Auth::user()->id)
                ->where('job_id', $id)
                ->count();
        if($check == 0){
            $apply = new Apply();
            $apply->entry_date = date('Y-m-d');
            $apply->user_id = Auth::user()->id;
            $apply->job_id = $id;
            $apply->save();

            session()->flash('success', 'Job was apply');
        }else{
            session()->flash('warning', 'You already applied');
        }

        return redirect()->back();
    }

    public function appliedJob(){
        $jobs = Apply::with(['Job'])
                ->where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get();

        return view('frontend.employee.applied_job', compact('jobs', $jobs));
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
