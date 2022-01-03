<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * This is Auth controller.
 */
class AuthController extends Controller
{
    /**
     * To show login view
     * 
     * @return View login view
     */
    public function showLoginView()
    {
        return view('auth.login');
    }

    /**
     * To check login success or not
     * 
     * @param UserLoginRequest $request
     * @return View post list view
     */
    public function authenticate(UserLoginRequest $request)
    {
        $validated = $request->validated();
        if (Auth::attempt(['email' => $validated["email"], 'password' => $validated["password"]], ($request->has('rememberMe') ? $validated["rememberMe"] : 'false'))) {
            $request->session()->regenerate();
            return redirect('/post/list');
        }
        return back()->withErrors([
            'email' => 'The provided email or password do not match our records.',
        ]);
    }

    /**
     * To log out user
     * 
     * @param Request $request
     * @return View login view
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }
}
