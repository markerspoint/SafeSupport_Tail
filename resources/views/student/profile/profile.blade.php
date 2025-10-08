@extends('layout.master-student')
@section('title', 'Profile')

@section('body')
<div class="bg-pine-50 min-h-full p-6">
    <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-pine-900 mb-6">Your Profile</h1>
        <div class="space-y-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Name:</strong> {{ auth()->user()->name }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Email:</strong> {{ auth()->user()->email }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('student.profile.edit') }}" class="h-10 px-4 py-2 text-sm font-medium text-white bg-[#171717] rounded-lg hover:bg-[#2d2d2d] transition">Edit Profile</a>
        </div>
    </div>
</div>
@endsection