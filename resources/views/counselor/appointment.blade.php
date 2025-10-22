@extends('layout.master-counselor')
@section('title', 'Appointments')

@section('body')
<div x-data="appointmentHandler()" x-cloak class="max-w-7xl mx-auto space-y-6">

    <!-- Flash Messages -->
    @if (session('success'))
    <div class="bg-[#A7F3D0] border border-[#6EE7B7] text-gray-800 px-4 py-3 rounded-md">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-md">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl p-4 custom-shadow mb-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <h1 class="text-gray-800 font-bold text-xl flex items-center">
                <img src="{{ asset('img/icons/calendar.svg') }}" class="w-6 h-6 mr-2" alt="Appointments Icon">
                Appointments Repository
            </h1>
            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">
                <span x-text="filteredAppointments.length"></span> Appointments
            </span>
        </div>

        <div class="flex space-x-2">
            <input type="search" placeholder="Search appointments..." class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-[#6EE7B7] focus:border-[#6EE7B7]" x-model="searchQuery" @keyup="filterAppointments">
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-4 custom-shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-gray-700 font-semibold text-lg">Appointments</h2>
            <div class="flex space-x-2">
                <button @click="statusFilter = ''; applyFilters()" :class="{ 'bg-emerald-500 text-white': statusFilter === '', 'bg-gray-100 text-gray-700': statusFilter !== '' }" class="px-3 py-1 text-sm font-medium rounded-full transition">
                    All Statuses
                </button>
                <button @click="statusFilter = 'upcoming'; applyFilters()" :class="{ 'bg-emerald-500 text-white': statusFilter === 'upcoming', 'bg-gray-100 text-gray-700': statusFilter !== 'upcoming' }" class="px-3 py-1 text-sm font-medium rounded-full transition">
                    Upcoming
                </button>
                <button @click="statusFilter = 'past'; applyFilters()" :class="{ 'bg-emerald-500 text-white': statusFilter === 'past', 'bg-gray-100 text-gray-700': statusFilter !== 'past' }" class="px-3 py-1 text-sm font-medium rounded-full transition">
                    Past
                </button>
                <button @click="statusFilter = 'cancelled'; applyFilters()" :class="{ 'bg-emerald-500 text-white': statusFilter === 'cancelled', 'bg-gray-100 text-gray-700': statusFilter !== 'cancelled' }" class="px-3 py-1 text-sm font-medium rounded-full transition">
                    Cancelled
                </button>
                <button @click="statusFilter = 'pending'; applyFilters()" :class="{ 'bg-emerald-500 text-white': statusFilter === 'pending', 'bg-gray-100 text-gray-700': statusFilter !== 'pending' }" class="px-3 py-1 text-sm font-medium rounded-full transition">
                    Pending
                </button>
            </div>
        </div>
        <hr>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Student</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Time</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <template x-for="appointment in filteredAppointments" :key="appointment.id">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 overflow-hidden border border-gray-200 rounded-full">
                                        <img :src="appointment.user.avatar_url" :alt="appointment.user.name" class="object-cover w-full h-full" />
                                    </div>
                                    <div class="flex flex-col">
                                        <span x-text="appointment.user.name" class="text-gray-700 font-medium"></span>
                                        <span x-text="appointment.user.email" class="text-xs text-gray-500"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-gray-700" x-text="new Date(appointment.date).toLocaleDateString('en-US', {day: '2-digit', month: 'short', year: 'numeric'})"></td>
                            <td class="px-4 py-2 text-gray-700" x-text="new Date('1970-01-01T' + appointment.time).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit', hour12: true})"></td>
                            <td class="px-4 py-2 capitalize">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-sm" :class="{
                                    'bg-[#A7F3D0] text-gray-800': appointment.status === 'upcoming',
                                    'bg-gray-100 text-gray-700': appointment.status === 'past',
                                    'bg-red-100 text-red-700': appointment.status === 'cancelled',
                                    'bg-[#6EE7B7] text-gray-800': appointment.status === 'pending'
                                }" x-text="appointment.status">
                                </span>
                            </td>
                            <td class="px-4 py-2 flex flex-wrap gap-2">
                                <template x-if="appointment.status === 'pending'">
                                    <button @click="openApproveModal(appointment.id)" class="bg-[#6EE7B7] text-gray-800 p-2 rounded-full hover:bg-[#34D399] transition" title="Accept">
                                        <img src="{{ asset('img/icons/check-circle.svg') }}" class="w-5 h-5" alt="Accept">
                                    </button>
                                </template>
                                <template x-if="appointment.status === 'pending'">
                                    <button @click="openRejectModal(appointment.id)" class="bg-red-400 text-white p-2 rounded-full hover:bg-red-700 transition" title="Reject">
                                        <img src="{{ asset('img/icons/x-circle.svg') }}" class="w-5 h-5" alt="Reject">
                                    </button>
                                </template>
                                <template x-if="appointment.status!=='cancelled' && appointment.status!=='past'">
                                    <button @click="$nextTick(() => openRescheduleModal(appointment.id, appointment.date, appointment.time))" class="bg-[#6EE7B7] text-gray-800 p-2 rounded-full hover:bg-[#34D399] transition" title="Reschedule">
                                        <img src="{{ asset('img/icons/repeat.svg') }}" class="w-5 h-5" alt="Reschedule">
                                    </button>
                                </template>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredAppointments.length === 0">
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="block text-sm">No appointments found</span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            {{-- pagination --}}
            <div class="flex items-center justify-between w-full h-16 px-3 border-t border-neutral-200">
                <p class="pl-2 text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $appointments->firstItem() }}</span> to 
                    <span class="font-medium">{{ $appointments->lastItem() }}</span> of 
                    <span class="font-medium">{{ $appointments->total() }}</span> results
                </p>
                <nav>
                    <ul class="flex items-center text-sm leading-tight bg-white border divide-x rounded h-9 text-neutral-500 divide-neutral-200 border-neutral-200">
                        
                        {{-- Previous Page Link --}}
                        <li class="h-full">
                            @if($appointments->onFirstPage())
                                <span class="relative inline-flex items-center h-full px-3 ml-0 rounded-l text-gray-300 cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $appointments->previousPageUrl() }}" class="relative inline-flex items-center h-full px-3 ml-0 rounded-l group hover:text-neutral-900">Previous</a>
                            @endif
                        </li>

                        {{-- Page Links --}}
                        @foreach ($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                            @if ($page == $appointments->currentPage())
                                <li class="hidden h-full md:block">
                                    <span class="relative inline-flex items-center h-full px-3 text-neutral-900 group bg-gray-50">{{ $page }}</span>
                                </li>
                            @elseif ($page == 1 || $page == $appointments->lastPage() || ($page >= $appointments->currentPage() - 1 && $page <= $appointments->currentPage() + 1))
                                <li class="hidden h-full md:block">
                                    <a href="{{ $url }}" class="relative inline-flex items-center h-full px-3 group hover:text-neutral-900">{{ $page }}</a>
                                </li>
                            @elseif ($page == 2 && $appointments->currentPage() > 3)
                                <li class="hidden h-full md:block"><div class="relative inline-flex items-center h-full px-2.5 group"><span>...</span></div></li>
                            @elseif ($page == $appointments->lastPage() - 1 && $appointments->currentPage() < $appointments->lastPage() - 2)
                                <li class="hidden h-full md:block"><div class="relative inline-flex items-center h-full px-2.5 group"><span>...</span></div></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        <li class="h-full">
                            @if($appointments->hasMorePages())
                                <a href="{{ $appointments->nextPageUrl() }}" class="relative inline-flex items-center h-full px-3 rounded-r group hover:text-neutral-900">Next</a>
                            @else
                                <span class="relative inline-flex items-center h-full px-3 rounded-r text-gray-300 cursor-not-allowed">Next</span>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <template x-if="open">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" @click.away="open=false">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
                <h2 class="text-gray-700 font-semibold mb-4 text-lg">Reschedule Appointment</h2>

                <form method="POST" :action="'{{ url('counselor/appointments') }}/' + appointmentId + '/reschedule'">
                    @csrf
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-500">Date</label>
                        <input type="date" id="date" name="date" x-model="date" class="mt-1 block w-full border border-gray-200 rounded-md p-2 focus:ring-[#6EE7B7] focus:border-[#6EE7B7] bg-gray-50 transition" required min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                    </div>
                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium text-gray-500">Time</label>
                        <input type="time" id="time" name="time" x-model="time" class="mt-1 block w-full border border-gray-200 rounded-md p-2 focus:ring-[#6EE7B7] focus:border-[#6EE7B7] bg-gray-50 transition" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="open = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="bg-[#6EE7B7] text-gray-800 px-4 py-2 rounded-md hover:bg-[#34D399] transition text-sm font-medium">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Approve Modal -->
    <div x-show="showApproveModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" @click.away="showApproveModal = false">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h2 class="text-gray-700 font-semibold mb-4 text-lg">Confirm Approval</h2>
            <p class="text-gray-600 mb-4">Are you sure you want to approve this appointment?</p>
            <form method="POST" :action="'{{ url('counselor/appointments') }}/' + appointmentId + '/status'">
                @csrf
                <input type="hidden" name="status" value="upcoming">
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="showApproveModal = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm font-medium">
                        Cancel
                    </button>
                    <button type="submit" class="bg-[#6EE7B7] text-gray-800 px-4 py-2 rounded-md hover:bg-[#34D399] transition text-sm font-medium">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showRejectModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" @click.away="showRejectModal = false">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h2 class="text-gray-700 font-semibold mb-4 text-lg">Confirm Rejection</h2>
            <p class="text-gray-600 mb-4">Are you sure you want to reject this appointment?</p>
            <form method="POST" :action="'{{ url('counselor/appointments') }}/' + appointmentId + '/status'">
                @csrf
                <input type="hidden" name="status" value="cancelled">
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="showRejectModal = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm font-medium">
                        Cancel
                    </button>
                    <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded-md hover:bg-red-500 transition text-sm font-medium">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function appointmentHandler() {
        return {
            open: false,
            showApproveModal: false,
            showRejectModal: false,
            appointmentId: null,
            date: '',
            time: '',
            searchQuery: '',
            statusFilter: '',
            appointments: @json($appointments->items()),
            filteredAppointments: @json($appointments->items()),

            init() {
                // console.log('Appointment Handler Initialized', this.appointments);
            },

            openRescheduleModal(id, date, time) {
                this.appointmentId = id;
                this.date = date;
                this.time = time;
                this.open = true;
            },

            openApproveModal(id) {
                console.log('Opening approve modal for ID:', id);
                this.appointmentId = id;
                this.showApproveModal = true;
                // console.log('showApproveModal:', this.showApproveModal); 
            },

            openRejectModal(id) {
                console.log('Opening reject modal for ID:', id);
                this.appointmentId = id;
                this.showRejectModal = true;
                // console.log('showRejectModal:', this.showRejectModal); 
            },

            applyFilters() {
                console.log('Applying filters:', this.statusFilter, this.searchQuery);
                this.filteredAppointments = this.appointments.filter(a => {
                    const matchesStatus = this.statusFilter === '' || a.status === this.statusFilter;
                    const matchesSearch = a.user.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                    return matchesStatus && matchesSearch;
                });
            },

            filterAppointments() {
                this.applyFilters();
            }
        }
    }
</script>
@endpush