@extends('frontend.master')
@section('title', 'Job Portal')
@section('content')
<style>
    .job a {
        text-decoration: none;
    }
</style>
<div class="row mt-5 mb-5">
    @if(count($jobs) ==0)
    <li class="alert alert-warning col-md-12">No job found</li>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('warning'))
        <div class="alert alert-warning">{{ Session::get('warning') }}</div>
    @endif


    @foreach($jobs as $job)
    <div class="job col-md-12 p-3 mb-3" style="border: 1px solid #ddd;">

        <a href="{{ url('single_job/'.$job->id) }}">
            <h5>Job: {{ $job->title }}</h5>
            <span>Company: {{$job->user->company->name}}</span> <br>
            <span>Location: {{$job->user->company->location}}</span> <br>
            <span>Experience: {{$job->experience}}</span>
        </a>

    </div>
    @endforeach
    <div class="mt-5">
        {{ $jobs->links() }}
    </div>
</div>

@endsection