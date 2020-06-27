<?php

namespace App\Http\Controllers;

use App\Category;
use App\Education;
use App\EmployeeBasicInfo;
use App\Job;
use App\User;
use App\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::where('active', true)->get();
        return view('frontend.index', compact('categories',$categories));
    }

    public function jobs($id){
        $jobs = Job::with(['User','User.Company'])
                ->whereDate('deadline', '>', date('Y-m-d'))
                ->where('active', true)
                ->where('category_id', $id)
                ->paginate(10);

        return view('frontend.show_job', compact('jobs',$jobs));
    }

    public function showSingleJob($id){
        $job = Job::with(['User','User.Company'])
                ->where('id', $id)
                ->first();

        return view('frontend.single_job', compact('job',$job));
    }

    public function viewResume($id){
        $basic = EmployeeBasicInfo::where("user_id", $id)->count();
        if($basic ==0){
            echo "This employee basic info  not set";
            return;
        }
        $education = Education::where("user_id", $id)->count();
        if($education ==0){
            echo "This employee education info  not set";
            return;
        }

        $work = WorkExperience::where("user_id", $id)->count();
        if($work ==0){
            echo "This employee work info  not set";
            return;
        }
        
        $user = User::with(['EmployeeBasicInfo','Education','WorkExperience'])
                ->where('role', 'EMPLOYEE')
                ->where('id', $id)
                ->first();

        return view('frontend.employee.view_resume', compact('user',$user));
    }
}
