@extends('frontend.master')
@section('title', 'Employee Dashboard ')
@section('content')
    <h4 class="text-center mt-5 mb-5">Welcome back <span style="font-weight: bold;">{{ ucfirst(Auth()->user()->name) }}</span></h4>
    <hr>
    <div class="row">
        @include('frontend/layouts/leftbar')
        <div class="col-md-9" style="border-left: 1px solid #ddd;">
        <h4>Entry job post</h4>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <form action="{{ url('job_post_process') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="username">Job Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="username">Vacancy</label>
                <input type="text" class="form-control" name="vacancy" id="vacancy" placeholder="Enter vacancy" required>
            </div>

            <div class="form-group">
                <label for="username">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="experience">Experience</label>
                <input type="text" class="form-control" name="experience" id="experience" placeholder="Enter experience" required>
            </div>

            <div class="form-group">
                <label for="description">Job description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="company_policy">Company Policy</label>
                <textarea name="company_policy" id="company_policy" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" class="form-control" name="deadline" id="deadline" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Job Post</button>
        </form>
        </div>
    </div>

@endsection