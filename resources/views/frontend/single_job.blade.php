@extends('frontend.master')
@section('title', 'Job Portal')
@section('content')
<style>
    .job a {
        text-decoration: none;
    }
</style>
<div class="row mt-5 mb-5">
    <div class="job col-md-8 p-3 mb-3">

        <h5>Job: {{ $job->title }}</h5>
        <span>Company: {{$job->user->company->name}}</span> <br>
        <span>Location: {{$job->user->company->location}}</span> <br>
        <span>Experience: {{$job->experience}}</span> <br> <br>
        <h3>Job Description</h3>
        <p style="text-align: justify;">
            {{$job->description}}
        </p>
        <h3>Company Policy</h3>

        <p style="text-align: justify;">
            {{$job->company_policy}}
        </p>
        <a href="{{ url('apply_job/'.$job->id) }}" class="btn btn-sm btn-warning">Apply Now</a>
    </div>

    <div class="col-md-4">
        <div style="border: 1px solid #ddd;" class="p-4">
            <h5>Company: {{$job->user->company->name}}</h5>
            <span>Location: {{$job->user->company->location}}</span> <br>
            <span>Phone: {{$job->user->company->phone}}</span> <br>
            <span>Post Date: {{$job->entry_date}}</span> <br>
            <span>DeadLine: {{$job->deadline}}</span> <br> <br>
        </div>
    </div>
</div>
@endsection