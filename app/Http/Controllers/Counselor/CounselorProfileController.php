<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CounselorProfileController extends Controller
{
    public function profile()
    {
        return view('counselor.profile.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'avatar' => ['nullable', 'string'], // Validate avatar as a string (filename)
        ]);

        $user = auth()->user();

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
                // Fallback to default if avatar file doesn't exist
                $updateData['avatar'] = null;
            }
        } elseif ($user->gender !== $request->gender) {
            // Reset avatar if gender changes and no avatar is selected
            $updateData['avatar'] = null;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('counselor.profile')->with('success', 'Profile updated successfully.');
    }

    public function getAvatars(Request $request)
    {
        $gender = $request->query('gender', 'male');
        $folder = in_array($gender, ['male', 'female']) ? $gender : 'male';
        $avatars = File::files(public_path("img/avatar/{$folder}"));
        return response()->json(array_map(fn($file) => $file->getFilename(), $avatars));
    }
}