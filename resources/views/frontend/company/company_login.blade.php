@extends('frontend.master')
@section('title', 'Company Login ')
@section('content')
    <h4 class="text-center mt-5 mb-5">Company Login Area</h4>
    <div class="row">
        <div class="col-md-6">
        <h4>Login From</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('company_login_process') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        </div>
        <div class="col-md-6">
        <h4>Registration From</h4>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <form action="{{ url('company_registration') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-success">Registration</button>
        </form>
        </div>
    </div>

@endsection