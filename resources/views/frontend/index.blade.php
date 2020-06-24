@extends('frontend.master')
@section('title', 'Job Portal')
@section('content')
    <h4 class="mt-5 mb-5 text-center">Choses Category</h4>
    <hr>
    <div class="row">
        <ul>
            @foreach($categories as $category)
            <li><a href="{{ url('show_job/'.$category->id) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>

@endsection