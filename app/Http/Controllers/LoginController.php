<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add the DB facade

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
       
        $logins = DB::table('logins')->where('email', $email)->first();
    
        if ($logins && $logins->password === $password) {
            // Login success, redirect to dashboard
            return redirect('/dashboard'); // Fixed the redirect URL
        } else {
            // Login fail, back to login page with error
            return back()->with('error', 'Invalid credentials.');
        }
    }
   // Logout method
   public function logout()
   {
     
       return view('/login');  // Redirect to login page
   }
}
