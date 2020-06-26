<?php

namespace App\Http\Controllers;

use App\Category;
use App\Job;
use App\User;
use Illuminate\Http\Request;

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
        $user = User::with(['EmployeeBasicInfo','Education','WorkExperience'])
                ->where('role', 'EMPLOYEE')
                ->where('id', $id)
                ->first();

        return view('frontend.employee.view_resume', compact('user',$user));
    }
}
