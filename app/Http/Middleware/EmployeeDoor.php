<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeDoor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('employee_login');
        }
        elseif(Auth::check() && Auth::user()->role == "EMPLOYEE"){
            return $next($request);    
        }
        
        return redirect()->back()->withWarning('You have no permission');
        
    }
}
