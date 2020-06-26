@extends('frontend.master')
@section('title', 'Resume')
@section('content')
<div class="row">
    <div class="resume_area mt-5 mb-5 col-md-10 offset-md-1" style="border:1px solid #ddd">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mt-3">{{$user->name}}</h3>
                <span>Cell: {{$user->phone}}</span> <br>
                <span>Email: {{$user->email}}</span> <br>
                <span>Web: {{$user->EmployeeBasicInfo->website}}</span>    
                <h3 class="mt-3" style="text-decoration: underline;">Career Objective:</h3>
                <p style="text-align: justify;">
                    {{$user->EmployeeBasicInfo->career_object}}  
                </p>
            </div>
            <div class="col-md-4">
                <img src="/uploads/{{$user->image}}" alt="" style="width: 200px; height:200px;margin-top: 22px;">
            </div>
        </div>

        <h3 class="mt-3" style="text-decoration: underline;">Work’s Experience:</h3>
        @foreach($user->WorkExperience as $work)
            <div style="margin-left:10px">
                Company: {{$work->company_name}} <br>
                Position: {{$work->designation}} <br>
                Session:   {{$work->form_date }} -  <?php echo $work->is_present ? 'Present' : $work->to_date ; ?>
            </div>
            <hr>
        @endforeach

        <h3 class="mt-3" style="text-decoration: underline;">Education:</h3>
        <div style="margin-left: 10px;">
            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Exam</th>
                        <th>Institute</th>
                        <th>Passing Year</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->Education as $key=>$education)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$education->exam_name}}</td>
                        <td>{{$education->institute}}</td>
                        <td>{{$education->passing_year}}</td>
                        <td>{{$education->grade}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3 class="mt-3" style="text-decoration: underline;">Personal Info:</h3>
        <div style="margin-left:10px" class="mb-3">
            Name: {{$user->name}} <br>
            Phone: {{$user->phone}} <br>
            Email: {{$user->email}}
        </div>

    </div>
</div>
@endsection