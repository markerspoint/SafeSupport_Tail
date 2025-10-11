@extends('layout.master-student')
@section('title', 'Appointments')

@section('body')

<div class="min-h-full p-6" x-data="{ openModal: false, selectedAppointment: null, filter: '{{ $filter ?? 'upcoming' }}' }">
    @if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-600 p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Your Appointments</h1>
        <a href="{{ route('student.appointments.book') }}" class="mt-4 sm:mt-0 w-full sm:w-auto h-10 bg-[#171717] text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-[#2d2d2d] transition">
            Book New Appointment
        </a>
    </div>

    {{-- hr line--}}
    <hr class="w-full border-t border-gray-200 -mt-3 mb-6">

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button @click="filter = 'upcoming'; window.location.href = '{{ route('student.appointments') }}?filter=upcoming'" :class="{ 'bg-teal-100 text-teal-900 font-semibold': filter === 'upcoming', 'text-gray-600 hover:bg-gray-50': filter !== 'upcoming' }" class="px-4 py-2 text-sm rounded-lg border border-gray-200">
                Upcoming
            </button>
            <button @click="filter = 'past'; window.location.href = '{{ route('student.appointments') }}?filter=past'" :class="{ 'bg-teal-100 text-teal-900 font-semibold': filter === 'past', 'text-gray-600 hover:bg-gray-50': filter !== 'past' }" class="px-4 py-2 text-sm rounded-lg border border-gray-200">
                Past
            </button>
        </div>
        <div x-show="filter === 'upcoming'" x-cloak class="mt-2 sm:mt-0">
            <span class="text-sm text-gray-600">Showing upcoming appointments</span>
        </div>
        <div x-show="filter === 'past'" x-cloak class="mt-2 sm:mt-0">
            <span class="text-sm text-gray-600">Showing past appointments</span>
        </div>
    </div>
    @if ($appointments->isEmpty())
    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
        <svg class="w-12 h-12 mx-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h2 class="mt-4 text-lg font-semibold text-gray-900">No Appointments Yet</h2>
        <p class="mt-2 text-sm text-gray-600">Get started by booking your first counseling session.</p>
        <a href="{{ route('student.appointments.book') }}" class="mt-4 inline-block h-10 bg-[#171717] text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-[#2d2d2d] transition">
            Book Appointment
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($appointments as $appointment)
        <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col justify-between relative hover:scale-103 transition-transform duration-200">
            <div class="relative z-10 pr-28">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-teal-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $appointment->date->format('F j, Y') }}</h2>
                </div>
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-teal-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="text-sm text-gray-600">{{ $appointment->time->format('h:i A') }}</p>
                </div>
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-teal-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <p class="text-sm text-gray-600">{{ $appointment->counselor ? $appointment->counselor->name : 'Counselor Unavailable' }}</p>
                </div>
            </div>
            <div class="absolute top-1/2 right-4 -translate-y-1/2 opacity-40 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
            <div class="mt-4 z-10 flex space-x-2">
                <button @click="openModal = true; selectedAppointment = { id: {{ $appointment->id }}, date: '{{ $appointment->date->format('F j, Y') }}', time: '{{ $appointment->time->format('h:i A') }}', counselor: '{{ addslashes($appointment->counselor ? $appointment->counselor->name : 'Counselor Unavailable') }}', statusHistory: {{ $appointment->statusHistory->map(fn($history) => ['status' => $history->status, 'changed_at' => $history->changed_at->format('F j, Y h:i A')])->toJson() }} }; console.log('Modal opened, openModal:', openModal, 'selectedAppointment:', selectedAppointment)" class="relative px-3 py-1 bg-gray-50 border border-gray-200 text-teal-600 rounded-lg hover:bg-gray-100 hover:text-teal-900 transition" x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <span x-show="tooltip" class="absolute bottom-full mb-0.5 left-1/2 -translate-x-1/2 bg-[#171717] text-white text-xs font-medium px-2 py-1 rounded-lg shadow-lg whitespace-nowrap z-20">
                        View Appointment
                    </span>
                </button>
                @if ($appointment->status === 'upcoming')
                <form action="{{ route('student.appointments.destroy', $appointment->id) }}" method="POST" x-data="{ tooltip: false }">
                    @csrf
                    @method('DELETE')
                    <button type="submit" @click="if (!confirm('Are you sure you want to cancel this appointment?')) return false;" class="relative px-3 py-1 bg-gray-50 border border-gray-200 text-red-600 rounded-lg hover:bg-red-50 hover:text-red-900 transition" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                            <path d="M3 6h18" />
                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        </svg>
                        <span x-show="tooltip" class="absolute bottom-full mb-0.5 left-1/2 -translate-x-1/2 bg-[#171717] text-white text-xs font-medium px-2 py-1 rounded-lg shadow-lg whitespace-nowrap z-20">
                            Cancel Appointment
                        </span>
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div x-show="openModal" x-cloak @keydown.escape="openModal = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Appointment Details</h2>
                <button @click="openModal = false; console.log('Modal closed, openModal:', openModal)" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <div x-show="selectedAppointment" class="space-y-4">
                <div>
                    <h3 class="text-sm font-[600] text-gray-700">Date</h3>
                    <p class="text-gray-600" x-text="selectedAppointment?.date"></p>
                </div>
                <div>
                    <h3 class="text-sm font-[600] text-gray-700">Time</h3>
                    <p class="text-gray-600" x-text="selectedAppointment?.time"></p>
                </div>
                <div>
                    <h3 class="text-sm font-[600] text-gray-700">Counselor</h3>
                    <p class="text-gray-600" x-text="selectedAppointment?.counselor"></p>
                </div>
                <div>
                    <h3 class="text-sm font-[600] text-gray-700">Status Timeline</h3>
                    <div x-show="selectedAppointment?.statusHistory?.length" class="relative mt-4">
                        <div class="flex flex-col space-y-6">
                            <template x-for="(history, index) in selectedAppointment?.statusHistory" :key="index">
                                <div class="flex items-start">
                                    <div class="flex flex-col items-center mr-4">
                                        <div class="w-4 h-4 rounded-full bg-teal-600"></div>
                                        <div class="w-0.5 flex-1 bg-gray-200" x-show="index < selectedAppointment.statusHistory.length - 1"></div>
                                    </div>
                                    <div class="flex-1 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                        <p class="text-sm font-medium text-gray-900" x-text="history.status.charAt(0).toUpperCase() + history.status.slice(1)"></p>
                                        <p class="text-xs text-gray-500" x-text="history.changed_at"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div x-show="!selectedAppointment?.statusHistory?.length" class="text-sm text-gray-600 mt-4">
                        No status history available.
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button @click="openModal = false; console.log('Modal closed, openModal:', openModal)" class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
