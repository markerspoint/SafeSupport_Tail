@extends('layout.master-student')
@section('title', 'About')

{{-- Option A: simple (title + subtitle) --}}
@section('page_title', 'About SafeSupport')
@section('page_subtitle',
    'Book, manage, and view your counseling appointments with counselors in a secure,
    student-friendly platform.')

@section('page_actions')
    <div class="flex items-center gap-2">
        {{-- Book Appointment --}}
        <button
            class="inline-flex items-center gap-2 h-9 px-4 rounded-md text-sm font-semibold
           bg-green-500 text-white border-b-4 border-green-700 shadow-sm
           focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2
           transform transition-all duration-200 ease-out
           hover:-translate-y-[2px] hover:shadow-md active:translate-y-[1px]
           disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 7V3M16 7V3M4 11h16M5 21h14a2 2 0 0 0 2-2V7H3v12a2 2 0 0 0 2 2z" />
            </svg>
            <span class="hidden sm:inline">Book Appointment</span>
            <span class="sm:hidden">Book</span>
        </button>

        {{-- Share --}}
        <div x-data="{ showToast: false }" class="relative">
            <button
                @click="
                    navigator.clipboard.writeText(window.location.href);
                    showToast = true;
                    setTimeout(() => showToast = false, 3000);"
                class="inline-flex items-center gap-2 h-9 px-3 rounded-md text-sm font-medium transition-all duration-200
                bg-white text-green-800 border border-green-200
                hover:bg-green-700 hover:text-white focus-visible:outline-none
                focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2
                transform hover:-translate-y-[2px] hover:shadow-md active:translate-y-[1px]
                disabled:opacity-50 disabled:pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="18" cy="5" r="3" />
                    <circle cx="6" cy="12" r="3" />
                    <circle cx="18" cy="19" r="3" />
                    <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                    <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
                </svg>
                <span class="hidden sm:inline">Share</span>
            </button>

            {{-- Modern Toast --}}
            <template x-if="showToast">
                <div x-transition
                    class="fixed top-5 right-5 flex items-center gap-3 px-5 py-3 rounded-xl shadow-lg
                bg-white/80 backdrop-blur-md border border-green-200
                text-green-800 font-medium text-sm z-[100] animate-slideIn">
                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span>Link copied to clipboard!</span>
                </div>
            </template>

            {{-- Animation --}}
            <style>
                @keyframes slideIn {
                    0% {
                        opacity: 0;
                        transform: translateY(-10px) translateX(10px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0) translateX(0);
                    }
                }

                .animate-slideIn {
                    animation: slideIn 0.3s ease-out forwards;
                }
            </style>
        </div>

        {{-- More Options --}}
        <div x-data="{ open: false }" class="relative">
            <button type="button" @click="open = !open"
                class="inline-flex items-center justify-center h-9 w-9 rounded-md border border-gray-200 bg-white
             text-green-700 hover:bg-green-700 hover:text-white
             focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-400 focus-visible:ring-offset-2
             shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="5" r="1" />
                    <circle cx="12" cy="19" r="1" />
                </svg>
                <span class="sr-only">More options</span>
            </button>

            {{-- Dropdown --}}
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                <button @click="alert('Report Issue feature coming soon!')"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4 mr-2 text-green-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 9v2m0 4h.01M12 19a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" />
                    </svg>
                    Report Issue
                </button>
            </div>
        </div>
    </div>
@endsection


@section('body')
    <div class="relative m-0">
        <div class="w-full space-y-6">
            <h1 class="text-2xl -mb-3 font-[700] text-green-800">About SafeSupport</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-green-800 mb-6">Platform Details</h2>

                    <div class="space-y-5">
                        <div>
                            <div class="text-xs uppercase tracking-wide text-green-800">Name</div>
                            <div class="mt-1 font-[600] text-green-800">
                                {{ config('app.name', 'SafeSupport') }}
                            </div>
                        </div>

                        <div x-data="{ open: false }">
                            <div class="text-xs uppercase tracking-wide text-green-800">Description</div>
                            <p class="mt-1 text-green-800 max-w-3xl" :class="open ? '' : 'line-clamp-3'">
                                SafeSupport is a student-focused mental health platform for booking counseling appointments,
                                managing schedules, and accessing wellness resources. Students can find
                                available counselors, book sessions, receive reminders, and keep a secure history of their
                                progress.
                                Counselors manage availability, sessions, and notes. Admins oversee users, calendars, and
                                platform-wide configuration.
                            </p>

                            <button type="button"
                                class="mt-2 inline-flex items-center gap-1 text-sm font-medium text-green-700 hover:underline"
                                @click="open = !open">
                                <span x-text="open ? 'See less' : 'See more'"></span>
                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div>
                                <div class="text-xs uppercase tracking-wide text-gray-500">Type</div>
                                <span
                                    class="mt-1 inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9V5h2v4h4v2h-4v4H9v-4H5V9h4z" />
                                    </svg>
                                    Free
                                </span>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-gray-500">Status</div>
                                <span
                                    class="mt-1 inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10 2a8 8 0 100 16 8 8 0 000-16zm.75 4.75a.75.75 0 00-1.5 0v4.5c0 .414.336.75.75.75h3a.75.75 0 000-1.5H10.75V6.75z" />
                                    </svg>
                                    Beta
                                </span>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-gray-500">Access</div>
                                <span
                                    class="mt-1 inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10 2a8 8 0 100 16A8 8 0 0010 2zm-1 5.5a1 1 0 112 0V10a1 1 0 01-.293.707l-2 2a1 1 0 11-1.414-1.414L9 9.586V7.5z" />
                                    </svg>
                                    Public
                                </span>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wide text-gray-500">Created</div>
                                <div class="mt-1 text-gray-800">
                                    {{ isset($createdAt) ? \Carbon\Carbon::parse($createdAt)->format('M d, Y') : now()->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Platform Stats --}}
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-green-800 mb-6">Platform Stats</h2>

                    <div class="space-y-6">

                        {{-- Active Students --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-600">
                                <!-- lucide: users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 1 1 0 7.75" />
                                </svg>
                                <span class="text-sm font-medium tracking-wide">Active Students</span>
                            </div>
                            <div class="text-2xl font-semibold text-green-900">
                                {{ \App\Models\User::where('role', 'student')->count() }}
                            </div>
                        </div>

                        {{-- Counselors --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-600">
                                <!-- lucide: user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                <span class="text-sm font-medium tracking-wide">Counselors</span>
                            </div>
                            <div class="text-2xl font-semibold text-green-900">
                                {{ \App\Models\User::where('role', 'counselor')->count() }}
                            </div>
                        </div>

                        {{-- Total Appointments --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-600">
                                <!-- lucide: calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                <span class="text-sm font-medium tracking-wide">Total Appointments</span>
                            </div>
                            <div class="text-2xl font-semibold text-green-900">
                                {{ $stats['appointments'] ?? 0 }}
                            </div>
                        </div>

                        {{-- Completed Sessions --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-600">
                                <!-- lucide: check-circle-2 -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span class="text-sm font-medium tracking-wide">Completed Sessions</span>
                            </div>
                            <div class="text-2xl font-semibold text-green-900">
                                {{ $stats['completed'] ?? 0 }}
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        <div class="text-xs uppercase tracking-wide text-gray-500">Platform Owner</div>
                        <div class="mt-3 flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-green-100 text-green-800 flex items-center justify-center font-semibold">
                                SS
                            </div>
                            <div class="text-sm text-gray-800">SafeSupport Team</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
