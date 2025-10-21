<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            'avatar' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
        ];

        // Handle avatar update
        if ($request->filled('avatar')) {
            $folder = $request->gender === 'male' ? 'male' : 'female';
            $avatarPath = public_path("img/avatar/{$folder}/{$request->avatar}");
            if (File::exists($avatarPath)) {
                $updateData['avatar'] = $request->avatar;
            } else {
                $updateData['avatar'] = null;
            }
        } elseif ($user->gender !== $request->gender) {
            // Reset avatar if gender changes and no avatar is selected
            $updateData['avatar'] = null;
        }

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Fetch avatars for the given gender.
     */
    public function getAvatars(Request $request)
    {
        $gender = $request->query('gender', 'male');
        $folder = in_array($gender, ['male', 'female']) ? $gender : 'male';
        $avatars = File::files(public_path("img/avatar/{$folder}"));
        return response()->json(array_map(fn($file) => $file->getFilename(), $avatars));
    }
}