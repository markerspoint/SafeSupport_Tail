@extends('layout.master-student')
@section('title', 'Appointment Details')

@section('body')
<div class="bg-pine-50 min-h-full p-6">
    <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-pine-900 mb-6">Appointment Details</h1>
        <div class="space-y-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Date:</strong> {{ $appointment->date->format('F j, Y') }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Time:</strong> {{ $appointment->time->format('h:i A') }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Counselor:</strong> {{ $appointment->counselor ? $appointment->counselor->name : 'Counselor Unavailable' }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pine-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-sm text-gray-600"><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('student.appointments') }}" class="h-10 px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100">Back to Appointments</a>
            @if ($appointment->status === 'upcoming')
                <form action="{{ route('student.appointments.destroy', $appointment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="h-10 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel Appointment</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection