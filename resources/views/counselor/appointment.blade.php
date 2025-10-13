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

    <!-- Appointments Table -->
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <h2 class="text-gray-700 font-semibold mb-4 text-lg">Appointments</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($appointments as $appointment)
                    <tr>
                        <td class="px-4 py-2">{{ $appointment->user->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                        <td class="px-4 py-2 capitalize">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-md
                                {{ [
                                    'upcoming' => 'bg-[#A7F3D0] text-gray-800',
                                    'past' => 'bg-gray-100 text-gray-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    'pending' => 'bg-[#6EE7B7] text-gray-800'
                                ][$appointment->status] ?? 'bg-[#6EE7B7] text-gray-800' }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 flex flex-wrap gap-2">
                            {{-- Accept --}}
                            @if ($appointment->status === 'pending')
                            <form action="{{ route('counselor.appointments.status', $appointment) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="upcoming">
                                <button type="submit" class="bg-[#6EE7B7] text-gray-800 px-3 py-1 rounded-md text-sm hover:bg-[#34D399] transition">
                                    Accept
                                </button>
                            </form>
                            @endif

                            @if ($appointment->status !== 'cancelled' && $appointment->status !== 'past')
                            <form action="{{ route('counselor.appointments.status', $appointment) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md text-sm hover:bg-red-700 transition">
                                    Reject
                                </button>
                            </form>
                            @endif

                            @if ($appointment->status !== 'cancelled' && $appointment->status !== 'past')
                            <button @click="$nextTick(() => openRescheduleModal({{ $appointment->id }}, '{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}', '{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}'))">
                                Reschedule
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-400">No appointments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Reschedule Modal -->
    <template x-if="open">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50" @click.away="open = false">
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
</div>
@endsection

@push('scripts')
<script>
    function appointmentHandler() {
        return {
            open: false
            , appointmentId: null
            , date: ''
            , time: ''
            , openRescheduleModal(id, date, time) {
                this.appointmentId = id;
                this.date = date;
                this.time = time;
                this.open = true;
            }
        };
    }

</script>
@endpush
