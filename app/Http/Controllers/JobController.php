<?php

namespace App\Http\Controllers;

use App\Category;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(){
        $categories = Category::where('active', true)->get();
        return view('frontend.company.job', compact('categories',$categories));
    }

    public function jobPost(Request $request){
        $job = new Job();
        $job->entry_date = date('Y-m-d');
        $job->user_id = Auth::user()->id;
        $job->title = $request->title;
        $job->vacancy = $request->vacancy;
        $job->category_id = $request->category;
        $job->experience = $request->experience;
        $job->description = $request->description;
        $job->company_policy = $request->company_policy;
        $job->deadline = $request->deadline;
        $job->save();

        $request->session()->flash('success', "Job was post");

        return redirect()->back();
         
    }
}
