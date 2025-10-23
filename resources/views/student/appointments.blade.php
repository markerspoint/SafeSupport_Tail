@extends('layout.master-student')
@section('title', 'Appointments')

@section('body')

<div class="min-h-full p-6 border border-gray-300 rounded-2xl" x-data="{ openModal: false, selectedAppointment: null, filter: '{{ $filter ?? 'upcoming' }}' }">
    @if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-600 p-4 rounded-lg mb-6 shadow-sm">
        {{ session('success') }}
    </div>
    @endif
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-700 mb-4 sm:mb-0 flex items-center gap-3">
            <svg class="w-7 h-7 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
                <circle cx="16" cy="16" r="3" />
                <polyline points="16 14 16 16 18 16" />
            </svg>
            Your Appointments
        </h1>

        <a href="{{ route('student.appointments.book') }}" class="mt-4 sm:mt-0 w-full sm:w-auto h-12 bg-gradient-to-r from-[#171717] to-[#2d2d2d] text-white rounded-lg px-6 py-3 text-sm font-medium hover:from-[#2d2d2d] hover:to-[#171717] transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
            Book New Appointment
        </a>
    </div>

    {{-- hr line--}}
    <hr class="w-full border-t border-gray-300 mb-8">

    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
        <div class="flex space-x-3 mb-4 sm:mb-0">
            <button @click="filter = 'upcoming'; window.location.href = '{{ route('student.appointments') }}?filter=upcoming'" :class="{ 'bg-teal-100 text-teal-900 font-semibold border-teal-300': filter === 'upcoming', 'text-gray-600 hover:bg-gray-50 border-gray-200': filter !== 'upcoming' }" class="px-5 py-2.5 text-sm rounded-lg border transition-all duration-200 shadow-sm hover:shadow-md">
                Upcoming
            </button>
            <button @click="filter = 'past'; window.location.href = '{{ route('student.appointments') }}?filter=past'" :class="{ 'bg-teal-100 text-teal-900 font-semibold border-teal-300': filter === 'past', 'text-gray-600 hover:bg-gray-50 border-gray-200': filter !== 'past' }" class="px-5 py-2.5 text-sm rounded-lg border transition-all duration-200 shadow-sm hover:shadow-md">
                Past
            </button>
            <button @click="filter = 'pending'; window.location.href = '{{ route('student.appointments') }}?filter=pending'" :class="{ 'bg-teal-100 text-teal-900 font-semibold border-teal-300': filter === 'pending', 'text-gray-600 hover:bg-gray-50 border-gray-200': filter !== 'pending' }" class="px-5 py-2.5 text-sm rounded-lg border transition-all duration-200 shadow-sm hover:shadow-md">
                Pending
            </button>
        </div>
        <div x-show="filter === 'pending'" x-cloak class="mt-2 sm:mt-0">
            <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Showing pending appointments</span>
        </div>
        <div x-show="filter === 'upcoming'" x-cloak class="mt-2 sm:mt-0">
            <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Showing upcoming appointments</span>
        </div>
        <div x-show="filter === 'past'" x-cloak class="mt-2 sm:mt-0">
            <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Showing past appointments</span>
        </div>
    </div>
    @if ($appointments->isEmpty())
    <div class="bg-whiterounded-xl p-8 text-center shadow-sm">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <h2 class="mt-4 text-xl font-semibold text-gray-900">No Appointments Yet</h2>
        <p class="mt-2 text-sm text-gray-600">Check pending if you've already booked or</p>
        <p class="mt-2 text-sm text-gray-600">Get started by booking your first counseling session.</p>
        <a href="{{ route('student.appointments.book') }}" class="mt-6 inline-block h-12 bg-gradient-to-r from-[#171717] to-[#2d2d2d] text-white rounded-lg px-6 py-3 text-sm font-medium hover:from-[#2d2d2d] hover:to-[#171717] transition-all duration-200 shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
            Book Appointment
        </a>
    </div>
    @else

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($appointments as $appointment)
        <div class="bg-white border border-gray-200 rounded-xl p-5 custom-shadow flex flex-col justify-between relative">
            <div class="relative z-10 pr-32">
                <div class="flex items-center mb-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-teal-50 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <h2 class="text-md font-semibold text-gray-900">{{ $appointment->date->format('F j, Y') }}</h2>
                </div>
                <div class="flex items-center mb-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-teal-50 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-base text-gray-700">{{ $appointment->time->format('h:i A') }}</p>
                </div>
                <div class="flex items-center mb-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-teal-50 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <p class="text-base text-gray-700">{{ $appointment->counselor ? $appointment->counselor->name : 'Counselor Unavailable' }}</p>
                </div>
            </div>
            <div class="absolute top-1/2 right-4 -translate-y-1/2 opacity-20 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
            <div class="mt-6 z-10 flex space-x-3">
                <button @click="openModal = true; selectedAppointment = { id: {{ $appointment->id }}, date: '{{ $appointment->date->format('F j, Y') }}', time: '{{ $appointment->time->format('h:i A') }}', counselor: '{{ addslashes($appointment->counselor ? $appointment->counselor->name : 'Counselor Unavailable') }}', statusHistory: {{ $appointment->statusHistory->map(fn($history) => ['status' => $history->status, 'changed_at' => $history->changed_at->format('F j, Y h:i A')])->toJson() }} }; console.log('Modal opened, openModal:', openModal, 'selectedAppointment:', selectedAppointment)" class="relative px-4 py-2 bg-gray-50 border border-gray-200 text-teal-600 rounded-lg hover:bg-teal-50 hover:text-teal-700 transition-all duration-200 shadow-sm hover:shadow-md" x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <span x-show="tooltip" class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs font-medium px-3 py-1.5 rounded-lg shadow-md whitespace-nowrap z-20">
                        View Appointment
                    </span>
                </button>
                @if ($appointment->status === 'upcoming')
                <div x-data="{ showCancelModal: false }">
                    <form action="{{ route('student.appointments.destroy', $appointment->id) }}" method="POST" x-ref="cancelForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="showCancelModal = true" class="relative px-4 py-2 bg-gray-50 border border-gray-200 text-red-600 rounded-lg hover:bg-red-50 hover:text-red-700 transition-all duration-200 shadow-sm hover:shadow-md" x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M10 11v6" />
                                <path d="M14 11v6" />
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                <path d="M3 6h18" />
                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            </svg>
                            <span x-show="tooltip" class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs font-medium px-3 py-1.5 rounded-lg shadow-lg whitespace-nowrap z-20">
                                Cancel Appointment
                            </span>
                        </button>
                    </form>

                    <!-- Cancel Confirmation Modal -->
                    <div x-show="showCancelModal" x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50" @click="showCancelModal = false">
                        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md" @click.stop>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirm Cancellation</h3>
                            <p class="text-gray-600 mb-6">Are you sure you want to cancel this appointment?</p>
                            <div class="flex justify-end space-x-3">
                                <button @click="showCancelModal = false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">No, Keep Appointment</button>
                                <button @click="$refs.cancelForm.submit()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">Yes, Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div x-show="openModal" x-cloak @keydown.escape="openModal = false" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl p-8 w-full max-w-lg shadow-2xl transform scale-95 transition-transform duration-300" x-show="openModal" x-transition:enter="scale-100" x-transition:leave="scale-95">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Appointment Details</h2>
                <button @click="openModal = false; console.log('Modal closed, openModal:', openModal)" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
            <div x-show="selectedAppointment" class="space-y-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Date</h3>
                    <p class="text-gray-600 mt-1" x-text="selectedAppointment?.date"></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Time</h3>
                    <p class="text-gray-600 mt-1" x-text="selectedAppointment?.time"></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Counselor</h3>
                    <p class="text-gray-600 mt-1" x-text="selectedAppointment?.counselor"></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Status Timeline</h3>
                    <div x-show="selectedAppointment?.statusHistory?.length" class="relative mt-6">
                        <div class="flex flex-col space-y-6">
                            <template x-for="(history, index) in selectedAppointment?.statusHistory" :key="index">
                                <div class="flex items-start">
                                    <div class="flex flex-col items-center mr-6">
                                        <div class="w-5 h-5 rounded-full bg-teal-600 shadow-md"></div>
                                        <div class="w-1 flex-1 bg-gray-300" x-show="index < selectedAppointment.statusHistory.length - 1"></div>
                                    </div>
                                    <div class="flex-1 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                                        <p class="text-sm font-medium text-gray-900" x-text="history.status.charAt(0).toUpperCase() + history.status.slice(1)"></p>
                                        <p class="text-xs text-gray-500 mt-1" x-text="history.changed_at"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <div x-show="!selectedAppointment?.statusHistory?.length" class="text-sm text-gray-600 mt-6">
                        No status history available.
                    </div>
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <button @click="openModal = false; console.log('Modal closed, openModal:', openModal)" class="px-6 py-3 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
