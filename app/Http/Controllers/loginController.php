<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('login.login');
    }

    // Proses login
    public function process(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->level === 'admin') {
                return redirect('/family-graph');
            } elseif ($user->level === 'user') {
                return redirect('/family-table');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'phone' => 'Nomor HP atau password salah',
        ])->withInput();
    }

    // Logout
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
