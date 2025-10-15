<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
     * Update the student's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($user->gender !== $request->gender) {
            $genderMap = [
                'male' => 'boy',
                'female' => 'girl',
            ];
            $gender = $request->gender ? ($genderMap[$request->gender] ?? 'boy') : 'boy';
            $updateData['avatar'] = "https://avatar.iran.liara.run/public/{$gender}?seed={$user->id}";
        }

        $user->update($updateData);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }
}