@extends('layout.master-student')
@section('title', 'About')

@section('body')
<section class="px-4 sm:px-6 md:px-8 lg:px-12 max-w-7xl mx-auto">
    <div class="bg-white border border-gray-300 rounded-xl p-6 flex flex-col justify-between relative shadow-sm transition-all duration-300 group">
        <div class="relative z-10 pr-32">
            <h2 class="text-xl font-bold text-gray-700 mb-3 group-hover:text-[#1cd799] transition-colors">Appointments</h2>
            <p class="text-sm text-gray-600 leading-relaxed">Book, manage, and view your counseling appointments easily.</p>
        </div>
        <div class="absolute top-1/2 right-6 -translate-y-1/2 opacity-20 text-[#1cd799] group-hover:opacity-30 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
        </div>
        <div class="mt-6 z-10">
            <a href="{{ route('student.appointments') }}" class="inline-flex items-center text-[#1cd799] font-semibold hover:text-[#0f766e] hover:underline transition-colors">
                Go to Appointments
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
