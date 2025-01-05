<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    public function login(Request $request)
    {
        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::attempt($data)) {
                $user = Auth::user();
                if ($user->role == '1') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role == '2') {
                    return redirect()->route('user.dashboard');
                }
            }
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {

        }
    }

    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 2,
            ];

            User::create($data);

            return redirect()->route('login');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registration failed', 'details' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
