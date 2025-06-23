<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{

   public function login(){
    return view('admin.login');
   }

   public function signin(Request $request){
          // Validate the incoming request
           $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $guards = ['teacher','manager']; // Add more guards here if needed

    foreach ($guards as $guard) {

        if (Auth::guard($guard)->attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            // Optional: store which guard was used
            session(['guard' => $guard]);

            // Redirect to guard-specific dashboard
            return match ($guard) {
                'teacher' => redirect('teacher/dashboard'),
                'manager' => redirect('manager/dashboard'),
                default   => redirect('/dashboard'),
            };
        }
    }
    if (!Auth::guard($guard)->attempt($request->only('email', 'password'))) {
    dd("Failed login attempt for guard: $guard");
}

    return back()->withErrors([
        'email' => 'Invalid credentials for all roles.',
    ]);
   }
public function dashboard(){
    if (Auth::guard('teacher')->check()) {
    $user = Auth::guard('teacher')->user();
    $type='teacher';
} elseif (Auth::guard('manager')->check()) {
    $user = Auth::guard('manager')->user();
    $type='manager';

}
    return view('admin.dashboard',compact('user','type'));
}
}