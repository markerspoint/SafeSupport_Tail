@extends('layout.master-counselor')
@section('title', 'Dashboard')

@section('body')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center space-x-6 custom-shadow transition">
            <div class="bg-gray-100 p-4 rounded-md">
                <img src="{{ asset('img/icons/briefcase.svg') }}" alt="Total Appointments" class="w-6 h-6">
            </div>
            <div class="flex-1">
                <h2 class="text-gray-500 text-sm font-medium">Total Appointments</h2>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-bold text-gray-700">{{ $totalAppointments ?? 0 }}</span>
                    <div class="flex items-center">
                        <span class="text-xs font-medium {{ $appointmentChange >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full flex items-center">
                            {{ $appointmentChange >= 0 ? '+' : '' }}{{ number_format($appointmentChange, 1) }}%
                            <svg class="w-3 h-3 ml-1 {{ $appointmentChange >= 0 ? 'text-green-800' : 'text-red-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path {{ $appointmentChange >= 0 ? 'd="M10 15l-5-5h10l-5 5z"' : 'd="M10 5l5 5H5l5-5z"' }} />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center space-x-6 custom-shadow transition">
            <div class="bg-gray-100 p-4 rounded-md">
                <img src="{{ asset('img/icons/check-circle.svg') }}" alt="Completed Sessions" class="w-6 h-6">
            </div>
            <div class="flex-1">
                <h2 class="text-gray-500 text-sm font-medium">Completed Sessions</h2>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-bold text-gray-700">{{ $completedSessions ?? 0 }}</span>
                    <div class="flex items-center">
                        <span class="text-xs font-medium {{ $completedChange >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full flex items-center">
                            {{ $completedChange >= 0 ? '+' : '' }}{{ number_format($completedChange, 1) }}%
                            <svg class="w-3 h-3 ml-1 {{ $completedChange >= 0 ? 'text-green-800' : 'text-red-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path {{ $completedChange >= 0 ? 'd="M10 15l-5-5h10l-5 5z"' : 'd="M10 5l5 5H5l5-5z"' }} />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center space-x-6 custom-shadow transition">
            <div class="bg-gray-100 p-4 rounded-md">
                <img src="{{ asset('img/icons/clock.svg') }}" alt="Pending Sessions" class="w-6 h-6">
            </div>
            <div class="flex-1">
                <h2 class="text-gray-500 text-sm font-medium">Pending Sessions</h2>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-bold text-gray-700">{{ $pendingSessions ?? 0 }}</span>
                    <div class="flex items-center">
                        <span class="text-xs font-medium {{ $pendingChange >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full flex items-center">
                            {{ $pendingChange >= 0 ? '+' : '' }}{{ number_format($pendingChange, 1) }}%
                            <svg class="w-3 h-3 ml-1 {{ $pendingChange >= 0 ? 'text-green-800' : 'text-red-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path {{ $pendingChange >= 0 ? 'd="M10 15l-5-5h10l-5 5z"' : 'd="M10 5l5 5H5l5-5z"' }} />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center space-x-6 custom-shadow transition">
            <div class="bg-gray-100 p-4 rounded-md">
                <img src="{{ asset('img/icons/users.svg') }}" alt="Cancelled Sessions" class="w-6 h-6">
            </div>
            <div class="flex-1">
                <h2 class="text-gray-500 text-sm font-medium">Cancelled Sessions</h2>
                <div class="flex items-center justify-between mt-1">
                    <span class="text-xl font-bold text-gray-700">{{ $cancelledSessions ?? 0 }}</span>
                    <div class="flex items-center">
                        <span class="text-xs font-medium {{ $cancelledChange >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-3 py-1 rounded-full flex items-center">
                            {{ $cancelledChange >= 0 ? '+' : '' }}{{ number_format($cancelledChange, 1) }}%
                            <svg class="w-3 h-3 ml-1 {{ $cancelledChange >= 0 ? 'text-green-800' : 'text-red-800' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path {{ $cancelledChange >= 0 ? 'd="M10 15l-5-5h10l-5 5z"' : 'd="M10 5l5 5H5l5-5z"' }} />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- chart --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 custom-shadow transition" x-data="{ filter: 'monthly' }">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-gray-700 font-semibold text-lg">Appointments</h2>
                    <p class="text-gray-600 text-xs" x-text="filter === 'monthly' ? 'Total Appointments this month' : 'Total Appointments this week'"></p>
                </div>
                <div class="flex space-x-2">
                    <button 
                        @click="filter = 'monthly'" 
                        :class="{ 'bg-emerald-500 text-white': filter === 'monthly', 'bg-gray-100 text-gray-700': filter !== 'monthly' }" 
                        class="px-4 py-1 text-sm font-medium rounded-full transition"
                    >
                        Monthly
                    </button>
                    <button 
                        @click="filter = 'weekly'" 
                        :class="{ 'bg-emerald-500 text-white': filter === 'weekly', 'bg-gray-100 text-gray-700': filter !== 'weekly' }" 
                        class="px-4 py-1 text-sm font-medium rounded-full transition"
                    >
                        Weekly
                    </button>
                </div>
            </div>
            <canvas id="appointmentsChart" class="w-full h-64"></canvas>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 custom-shadow transition">
            <h2 class="text-gray-700 font-semibold mb-1 text-lg">Session Completion Rate</h2>
            <p class="text-gray-600 mb-4 text-xs">Percentage of completed sessions</p>
            <canvas id="completionChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-5 custom-shadow transition">
        <h2 class="text-gray-700 font-semibold mb-4 text-lg">Recent Appointments</h2>

        <hr>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="">
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                    </tr>   
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentAppointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2">
                            <div class="flex flex-col">
                                <span class="text-gray-700">{{ $appointment->user->name }}</span>
                                <span class="text-xs text-gray-500">{{ $appointment->user->email }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-gray-600">{{ $appointment->appointment_date_time->format('d M, Y h:i A') }}</td>
                        <td class="px-4 py-2 capitalize">
                            @php
                            $statusColors = [
                                'upcoming' => 'bg-green-200 text-gray-800',
                                'past' => 'bg-gray-100 text-gray-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                'pending' => 'bg-green-300 text-gray-800',
                            ];
                            @endphp
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full shadow-sm {{ $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $appointment->reason }}</td>
                    </tr>
                    @endforeach
                    @if(count($recentAppointments) === 0)
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                            No recent appointments
                        </td>
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
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyLabels = @json($monthlyLabels ?? []);
        const monthlyData = @json($monthlyData ?? []);
        const sessionLabels = @json($sessionCompletion['labels'] ?? []);
        const sessionData = @json($sessionCompletion['data'] ?? []);

        const ctx = document.getElementById('appointmentsChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);
        gradient.addColorStop(0, 'rgba(52, 211, 153, 0.9)'); 
        gradient.addColorStop(1, 'rgba(52, 211, 153, 0.1)');   

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Appointments',
                    data: monthlyData,
                    borderColor: '#34d399',
                    backgroundColor: gradient, 
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12,
                                weight: '500'
                            },
                            color: '#1f2937'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            },
                            color: '#4b5563'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(209, 213, 219, 0.3)',
                            borderDash: [4, 4]
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            },
                            color: '#4b5563'
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Session Completion Bar Chart
        const completionCtx = document.getElementById('completionChart').getContext('2d');
        if (!completionCtx) {
            console.error('Canvas #completionChart not found');
        } else {
            const safeMax = sessionData.length ? Math.max(...sessionData) : 10;
            new Chart(completionCtx, {
                type: 'bar',
                data: {
                    labels: ['Past', 'Cancelled', 'Upcoming', 'Pending'], // X-axis labels
                    datasets: [
                        {
                            label: 'Past',
                            data: [sessionData[0] || 0, 0, 0, 0], // Only Past has value
                            backgroundColor: '#ecfdf5', // emerald-50
                            borderColor: '#a7f3d0', // emerald-200
                            borderWidth: 1,
                            borderRadius: 8,
                            barThickness: 20
                        },
                        {
                            label: 'Cancelled',
                            data: [0, sessionData[1] || 0, 0, 0], // Only Cancelled has value
                            backgroundColor: '#d1fae5', // emerald-100
                            borderColor: '#6ee7b7', // emerald-300
                            borderWidth: 1,
                            borderRadius: 8,
                            barThickness: 20
                        },
                        {
                            label: 'Upcoming',
                            data: [0, 0, sessionData[2] || 0, 0], // Only Upcoming has value
                            backgroundColor: '#a7f3d0', // emerald-200
                            borderColor: '#34d399', // emerald-400
                            borderWidth: 1,
                            borderRadius: 8,
                            barThickness: 20
                        },
                        {
                            label: 'Pending',
                            data: [0, 0, 0, sessionData[3] || 0], // Only Pending has value
                            backgroundColor: '#6ee7b7', // emerald-300
                            borderColor: '#10b981', // emerald-500
                            borderWidth: 1,
                            borderRadius: 8,
                            barThickness: 20
                        }
                    ]
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
                    barPercentage: 0.2, // Reduce bar width
                    categoryPercentage: 0.8, // Add spacing between bars
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }
        
    });
</script>
@endpush
