<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Log the attempt for debugging
        Log::info('Login attempt:', ['email' => $request->email]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role === 'customer') {
                $request->session()->regenerate();
                
                return redirect()->intended('dashboard')
                    ->with('success', 'Welcome, ' . $user->name . '!');
            }
            
            Auth::logout();
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'This account is not authorized to access the customer area.');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'The provided credentials do not match our records.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('welcome');
    }
} 