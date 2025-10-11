<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            ...( $request->filled('password') ? ['password' => Hash::make($request->password)] : [] ),
        ]);

        return redirect()->route('counselor.profile')->with('success', 'Profile updated successfully.');
    }
}