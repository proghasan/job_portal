<?php

namespace App\Http\Controllers;

use App\Apply;
use App\Education;
use App\EmployeeBasicInfo;
use App\User;
use App\WorkExperience;
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

    // build resume
    public function buildResume(){
        return view('frontend.employee.build_resume');
    }

    public function getUserInfo(){
        $user = User::where("id", Auth::user()->id)->first();
        return response()->json($user);
    }

    public function saveEducationInfo(Request $request){
        foreach($request->education as $edu){
            if($edu['id'] == 0 && $edu['exam_name'] !==''){
                $education = new Education();
                $education->user_id = Auth::user()->id;
                $education->exam_name = $edu['exam_name'];
                $education->institute = $edu['institute'];
                $education->grade = $edu['grade'];
                $education->passing_year = $edu['passing_year'];
                $education->save();
            }else{
                $education = Education::find($edu['id']);
                $education->exam_name = $edu['exam_name'];
                $education->institute = $edu['institute'];
                $education->grade = $edu['grade'];
                $education->passing_year = $edu['passing_year'];
                $education->save();
            }
            
        }

        return  response()->json("Education skill was add.");
    }

    public function getEducationInfo(){
        $educations = Education::where('user_id', Auth::user()->id)->get();
        return response()->json($educations);
    }

    public function saveWorkInfo(Request $request){
        foreach($request->works as $work){
            if($work['id'] == 0){
                $workObj = new WorkExperience();
                $workObj->user_id = Auth::user()->id;
                $workObj->company_name = $work['company_name'];
                $workObj->designation = $work['designation'];
                $workObj->from_date = $work['from_date'];
                $workObj->to_date = $work['is_present'] == true ? null : $work['to_date'];
                $workObj->is_present = $work['is_present'];
                $workObj->save();
            }else{
                $workObj = WorkExperience::find($work['id']);
                $workObj->company_name = $work['company_name'];
                $workObj->designation = $work['designation'];
                $workObj->from_date = $work['from_date'];
                $workObj->to_date = $work['is_present'] == true ? null : $work['to_date'];
                $workObj->is_present = $work['is_present'];
                $workObj->save();
            }
        }

        return  response()->json("Work was add.");
    }

    public function getWorkInfo(){
        $educations = WorkExperience::where('user_id', Auth::user()->id)->get();
        return response()->json($educations);
    }

    public function saveBasicInfo(Request $request){
        $data = $request->info;
        if($data['id'] == 0){
            $basic = new EmployeeBasicInfo();
            $basic->user_id = Auth::user()->id;
            $basic->website = $data['website'];
            $basic->career_object = $data['career_object'];
            $basic->save();
        }else{
            $basic = EmployeeBasicInfo::find($data['id']);
            $basic->website = $data['website'];
            $basic->career_object = $data['career_object'];
            $basic->save();
        }
        return  response()->json("Other information was add.");
    }

    public function getBasicInfo(){
        $other = EmployeeBasicInfo::where('user_id', Auth::user()->id)->get();
        return response()->json($other);
    }

    public function UpdateUserInfo(Request $request){
        $id = Auth::user()->id;
        $data= $request->sendData;
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->save();
        return response()->json("Information updated");
    }
}
