<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'student') {
                return redirect()->route('student.about');
            } elseif ($user->role === 'counselor') {
                return redirect()->route('counselor.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Invalid role. Only students and counselors are allowed.');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function register(Request $request)
    {
        // Validate the input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => ['required', Rule::in(['male', 'female'])],
        ]);

        // Map gender to API-compatible values
        $genderMap = [
            'male' => 'boy',
            'female' => 'girl',
        ];
        $gender = $data['gender'] ? ($genderMap[$data['gender']] ?? 'boy') : 'boy';

        // Create the user with default role 'student'
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
            'gender' => $data['gender'],
        ]);

        // Generate and save the avatar URL after creation (since ID is now available)
        $user->update([
            'avatar' => "https://avatar.iran.liara.run/public/{$gender}?seed={$user->id}",
        ]);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}