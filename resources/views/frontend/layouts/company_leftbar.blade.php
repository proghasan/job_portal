<div class="col-md-3">
<ul class="nav flex-column">
    <li class="nav-item">
        @if(Auth::user()->role == "COMPANY")
            <a class="nav-link" href="{{url('company_dashboard')}}">Dashboard</a>
            <a class="nav-link" href="{{url('job_post')}}">Job Post</a>
            <a class="nav-link" href="{{url('applied_list')}}">Applied</a>
        @endif

        @if(Auth::user()->role == "EMPLOYEE")
            <a class="nav-link" href="{{url('employee_dashboard')}}">Dashboard</a>
            <a class="nav-link" href="{{url('applied_job')}}">Applied Job</a>
        @endif
    </li>
</ul>
</div>