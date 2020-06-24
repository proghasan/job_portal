@extends('frontend.master')
@section('title', 'Employee Dashboard ')
@section('content')
    <h4 class="text-center mt-5 mb-5">Welcome back <span style="font-weight: bold;">{{ ucfirst(Auth()->user()->name) }}</span></h4>
    <hr>
    <div class="row">
        @include('frontend/layouts/leftbar')
        <div class="col-md-9" style="border-left: 1px solid #ddd;">
            Find Your Perfect Employee
        </div>
    </div>

@endsection