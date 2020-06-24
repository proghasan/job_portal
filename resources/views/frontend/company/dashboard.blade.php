@extends('frontend.master')
@section('title', 'Employee Dashboard ')
@section('content')
    <h4 class="text-center mt-5 mb-5">Welcome back <span style="font-weight: bold;">{{ ucfirst(Auth()->user()->name) }}</span></h4>
    <hr>
    <div class="row">
        @include('frontend/layouts/leftbar')
        <div class="col-md-9" style="border-left: 1px solid #ddd;">
        <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Entry Date</th>
                        <th>Job title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $key=>$job)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $job->entry_date }}</td>
                        <td><a target="_blank" href="{{url('single_job/'.$job->id )}}">{{ $job->title }}</a></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection