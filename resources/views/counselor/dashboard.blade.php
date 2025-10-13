@extends('layout.master-counselor')
@section('title', 'Dashboard')

@section('body')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center space-x-6">
            <div class="bg-gray-100 p-4 rounded-md">
                <img src="{{ asset('img/icons/briefcase.svg') }}" alt="Total Appointments" class="w-6 h-6">
            </div>
            <div class="flex-1">
                <h2 class="text-gray-500 text-sm font-medium">Total Appointments</h2>
                <p class="text-2xl font-bold mt-1 text-gray-700">{{ $totalAppointments ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center space-x-6">
                <div class="bg-gray-100 p-4 rounded-md">
                    <img src="{{ asset('img/icons/check-circle.svg') }}" alt="Completed Sessions" class="w-6 h-6">
                </div>
                <div class="flex-1">
                    <h2 class="text-gray-500 text-sm font-medium">Completed Sessions</h2>
                    <p class="text-2xl font-bold mt-1 text-gray-700">{{ $completedSessions ?? 0 }}</p>
                </div>
            </div>


            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center space-x-6">
                <div class="bg-gray-100 p-4 rounded-md">
                    <img src="{{ asset('img/icons/clock.svg') }}" alt="Pending Sessions" class="w-6 h-6">
                </div>
                <div class="flex-1">
                    <h2 class="text-gray-500 text-sm font-medium">Pending Sessions</h2>
                    <p class="text-2xl font-bold mt-1 text-gray-700">{{ $pendingSessions ?? 0 }}</p>
                </div>
            </div>


            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center space-x-6">
                <div class="bg-gray-100 p-4 rounded-md">
                    <img src="{{ asset('img/icons/users.svg') }}" alt="New Students" class="w-6 h-6">
                </div>
                <div class="flex-1">
                    <h2 class="text-gray-500 text-sm font-medium">New Students</h2>
                    <p class="text-2xl font-bold mt-1 text-gray-700">{{ $newStudents ?? 0 }}</p>
                </div>
            </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border border-gray-200 rounded-xl p-4 ">
            <h2 class="text-gray-700 font-semibold mb-4">Monthly Appointments</h2>
            <canvas id="appointmentsChart" class="w-full h-64"></canvas>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 ">
            <h2 class="text-gray-700 font-semibold mb-4">Session Completion Rate</h2>
            <canvas id="completionChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-4 ">
        <h2 class="text-gray-700 font-semibold mb-4">Recent Appointments</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentAppointments as $appointment)
                    <tr>
                        <td class="px-4 py-2">{{ $appointment->user->name }}</td>
                        <td class="px-4 py-2">
                            {{ $appointment->appointment_date_time->format('d M, Y h:i A') }}
                        </td>
                        <td class="px-4 py-2 capitalize">{{ $appointment->status }}</td>
                        <td class="px-4 py-2">{{ $appointment->reason }}</td>
                    </tr>
                    @endforeach
                    @if(count($recentAppointments) === 0)
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-400">No recent appointments</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthlyLabels = @json($monthlyLabels ?? []);
    const monthlyData = @json($monthlyData ?? []);
    const sessionLabels = @json($sessionCompletion['labels'] ?? []);
    const sessionData = @json($sessionCompletion['data'] ?? []);

    // Monthly Appointments Line Chart
    const appointmentsChart = new Chart(document.getElementById('appointmentsChart'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Appointments',
                data: monthlyData,
                borderColor: '#047857',
                backgroundColor: 'rgba(4, 120, 87, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Session Completion Bar Chart
    const safeMax = sessionData.length ? Math.max(...sessionData) : 10;
    const completionChart = new Chart(document.getElementById('completionChart'), {
        type: 'bar',
        data: {
            labels: sessionLabels,
            datasets: [{
                label: 'Sessions',
                data: sessionData,
                backgroundColor: [
                    '#a7f3d0',
                    '#34d399', 
                    '#1ab394'  
                ],
                borderColor: [
                    '#34d399',
                    '#10b981',
                    '#047857'
                ],
                borderWidth: 1,
                borderRadius: 8,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            layout: { padding: 10 },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: { family: "'Inter', sans-serif", size: 12, weight: '500' },
                        color: '#1f2937'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(31, 41, 55, 0.9)',
                    titleFont: { family: "'Inter', sans-serif", size: 14, weight: '600' },
                    bodyFont: { family: "'Inter', sans-serif", size: 12 },
                    padding: 12,
                    cornerRadius: 6
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: "'Inter', sans-serif", size: 12 }, color: '#4b5563' }
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: safeMax * 1.2,
                    grid: { color: 'rgba(209, 213, 219, 0.3)', borderDash: [4, 4] },
                    ticks: {
                        font: { family: "'Inter', sans-serif", size: 12 },
                        color: '#4b5563',
                        stepSize: Math.ceil(safeMax / 5) || 1
                    }
                }
            },
            animation: { duration: 1000, easing: 'easeOutQuart' }
        }
    });
});
</script>
@endpush

