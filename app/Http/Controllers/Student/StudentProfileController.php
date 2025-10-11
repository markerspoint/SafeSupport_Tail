<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    /**
     * Display the authenticated student's profile.
     */
    public function show()
    {
        return view('student.profile.profile');
    }

    /**
     * Show the form for editing the student's profile.
     */
    public function edit()
    {
        return view('student.profile.edit-profile', ['user' => Auth::user()]);
    }

    /**
     * Update the student's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);
        Auth::user()->update($request->only('name', 'email'));
        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }
}