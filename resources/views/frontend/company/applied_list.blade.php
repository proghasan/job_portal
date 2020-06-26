@extends('frontend.master')
@section('title', 'Employee Dashboard ')
@section('content')
    <h4 class="text-center mt-5 mb-5">Welcome back <span style="font-weight: bold;">{{ ucfirst(Auth()->user()->name) }}</span></h4>
    <hr>
    <div class="row">
        @include('frontend/layouts/leftbar')
        <div class="col-md-9" style="border-left: 1px solid #ddd;">
        <h4 class="mt-2 mb-4">Applied List</h4>
        <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Applied Date</th>
                        <th>Applier Name</th>
                        <th>Job title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // echo "<pre>";
                    // print_r($appliedJob);
                    ?>
                    @foreach($appliedJob as $key=>$job)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$job->entry_date}}</td>
                        <td><a href="{{url('view_resume/'.$job->user->id)}}">{{$job->user->name}}</a></td>
                        <td> <a href="{{url('single_job/'.$job->job_id)}}">
                        {{$job->job->title}}
                        </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection