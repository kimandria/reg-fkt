<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AccessController extends Controller
{
    public function unauthorized()
    {
        return view('access.unauthorized');
    }

    public function showLoginForm()
    {
        return view('access.login');
    }

    public function loginAccount(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required|min:8',
            ]);

            $user = User::where('username', $request->input('username'))->first();
            if (!$user) {
                return redirect('/login')->with('error', 'Username not found. Please contact DSI.');
            }

            if (!password_verify($request->input('password'), $user->password)) {
                return redirect('/login')->with('error', 'Password is incorrect. Please try again.');
            }

            // Set a cookie with the user's ID
            $cookie = cookie('user_id', $user->id, 60 * 24 * 30); // Expires in 30 days

            if ($user->isAdmin()) {
                return redirect('/index')->cookie($cookie);
            }

            if ($user->fkt_id) {
                return redirect('/fokontany')->cookie($cookie);
            }

            if ($user->borough_id) {
                return redirect('/boroughs')->cookie($cookie);
            }

            if ($user->district_id) {
                return redirect('/districts')->cookie($cookie);
            }

            if ($user->prefecture_id) {
                return redirect('/prefectures')->cookie($cookie);
            }
        } catch (QueryException $e) {
            return redirect('/')->with('error', 'An error occurred while logging in.');
        }
    }

    public function logout()
    {
        Session::flush();
        $cookie = Cookie::forget('user_id');
        Session::flash('message', 'You have been logged out.');
        return redirect('/login')->cookie($cookie);
    }
}

