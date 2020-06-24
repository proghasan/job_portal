<?php

namespace App\Http\Controllers;

use App\Apply;
use App\Company;
use App\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(){
        $jobs = Job::where('active', true)
                ->where('user_id', Auth::user()->id)
                ->get();

        return view('frontend.company.dashboard', compact('jobs', $jobs));
        
    }
    public function appliedList(){

       // user id
       // all job id
       // all applied list using job id
    
       $jobs = Job::select("id")
                ->where('active', true)
                ->where('user_id', Auth::user()->id)
                ->get();
        $appliedJob = Apply::with(['Job', 'User'])
                    ->whereIn('job_id', $jobs)
                    ->get();
        // echo "<pre>";
        // print_r($appliedJob);
        // return $appliedJob;

        return view('frontend.company.applied_list', compact('appliedJob', $appliedJob));
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
        $lastId = $user->id;
        // company information
        $company = new Company();
        $company->user_id = $lastId;
        $company->name = $request->company_name;
        $company->phone = $request->company_phone;
        $company->location = $request->company_location;
        $company->website = $request->website;
        $company->save();


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
