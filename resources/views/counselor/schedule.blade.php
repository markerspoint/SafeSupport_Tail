@extends('layout.master-counselor')
@section('title', 'Schedule')

@section('body')
<section class="relative py-24 border border-gray-300 rounded-2xl">
    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
        <div class="flex flex-col md:flex-row max-md:gap-3 items-center justify-between mb-5">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M17 4.5H7V6H17V4.5ZM3.65 8.5V17H20.35V8.5H3.65ZM7 20.35C6.03882 20.35 5.38332 20.3486 4.89207 20.2826C4.41952 20.2191 4.1974 20.1066 4.04541 19.9546L3.12617 20.8739C3.55996 21.3077 4.10214 21.4881 4.71885 21.571C5.31685 21.6514 6.07557 21.65 7 21.65H17C17.9244 21.65 18.6831 21.6514 19.2812 21.571C19.8979 21.4881 20.44 21.3077 20.8738 20.8739L19.9546 19.9546C19.8026 20.1066 19.5805 20.2191 19.1079 20.2826C18.6167 20.3486 17.9612 20.35 17 20.35H7ZM3 10.65H21V9.35H3V10.65Z" fill="#111827"/>
                </svg>
                <h6 class="text-xl leading-8 font-semibold text-gray-900" id="calendar-title"></h6>
            </div>
            <div class="flex items-center gap-px rounded-lg bg-gray-100 p-1">
                <button data-view="timeGridDay" class="view-btn rounded-lg py-2.5 px-5 text-sm font-medium text-gray-500 transition-all duration-300 hover:bg-white hover:text-success-600">Day</button>
                <button data-view="timeGridWeek" class="view-btn rounded-lg py-2.5 px-5 text-sm font-medium text-success-600 bg-white transition-all duration-300 hover:bg-white hover:text-success-600">Week</button>
                <button data-view="dayGridMonth" class="view-btn rounded-lg py-2.5 px-5 text-sm font-medium text-gray-500 transition-all duration-300 hover:bg-white hover:text-success-600">Month</button>
            </div>
            <button id="new-event-btn" class="py-2.5 pr-7 pl-5 bg-success-600 rounded-xl flex items-center gap-2 text-base font-semibold text-white transition-all duration-300 hover:bg-success-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 5V15M15 10H5" stroke="white" stroke-width="1.6" stroke-linecap="round"></path>
                </svg>
                New Availability
            </button>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <div id="calendar" class="min-h-screen"></div>
        </div>

        <!-- Flowbite Modal -->
        <div id="new-event-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-900">
                    <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add/Edit Availability</h3>
                        <button type="button" class="text-gray-400 hover:text-gray-900 dark:hover:text-white" data-modal-hide="new-event-modal" data-modal-target="new-event-modal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="new-event-form" class="p-4">
                        <div class="mb-4">
                            <label for="event-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" id="event-title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="event-start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                            <input type="datetime-local" id="event-start" name="start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="event-end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                            <input type="datetime-local" id="event-end" name="end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-success-500 focus:border-success-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-white" required>
                        </div>
                        <input type="hidden" id="event-id" name="id">
                        <div class="flex items-center gap-3">
                            <button type="submit" id="save-event-btn" class="w-full text-white bg-success-600 hover:bg-success-700 focus:ring-4 focus:outline-none focus:ring-success-300 font-medium rounded-lg text-sm px-5 py-2.5">Save</button>
                            <button type="button" id="delete-event-btn" class="hidden w-full text-white bg-error-600 hover:bg-error-700 focus:ring-4 focus:outline-none focus:ring-error-300 font-medium rounded-lg text-sm px-5 py-2.5">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendarTitle = document.getElementById('calendar-title');
            const viewButtons = document.querySelectorAll('.view-btn');
            const newEventBtn = document.getElementById('new-event-btn');
            const newEventModal = new window.Modal(document.getElementById('new-event-modal'));
            const newEventForm = document.getElementById('new-event-form');
            const eventTitleInput = document.getElementById('event-title');
            const eventStartInput = document.getElementById('event-start');
            const eventEndInput = document.getElementById('event-end');
            const eventIdInput = document.getElementById('event-id');
            const saveEventBtn = document.getElementById('save-event-btn');
            const deleteEventBtn = document.getElementById('delete-event-btn');
            let isInitialLoad = true;

            const forceBackdropClear = () => {
                const backdrops = document.querySelectorAll('.flowbite-modal-overlay');
                backdrops.forEach(backdrop => backdrop.remove());
            };

            const modalElement = document.getElementById('new-event-modal');
            const closeButtons = modalElement.querySelectorAll('[data-modal-hide="new-event-modal"]');
            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    newEventModal.hide();
                    forceBackdropClear();
                });
            });
            modalElement.addEventListener('click', (e) => {
                if (e.target === modalElement) {
                    newEventModal.hide();
                    forceBackdropClear();
                }
            });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [window.FullCalendar.dayGridPlugin, window.FullCalendar.timeGridPlugin, window.FullCalendar.interactionPlugin],
                initialView: 'timeGridWeek',
                headerToolbar: false,
                editable: true,
                selectable: true,
                selectMirror: true,
                allDaySlot: false,
                slotMinTime: '07:00:00',
                slotMaxTime: '18:00:00',
                height: 'auto',
                timeZone: 'Asia/Manila',
                events: {
                    url: '{{ url('/counselor/schedules') }}',
                    timeout: 10000,
                    success: function(events) {
                        console.log('Events fetched:', events);
                        return Array.isArray(events) ? events : [];
                    },
                    failure: function(error) {
                        console.error('Error fetching events:', error);
                        let message = error.xhr
                            ? `Failed to load events: ${error.xhr.status} ${error.xhr.statusText}`
                            : 'Failed to load events. Possible network issue or server error. Please check your connection or try again later.';
                        if (isInitialLoad && error.xhr && error.xhr.status === 401) {
                            console.log('Unauthorized, redirecting to login...');
                            setTimeout(() => window.location.href = '/login', 2000);
                        } else {
                            console.error('Error details:', error.message || error);
                            alert(message);
                        }
                        isInitialLoad = false;
                    }
                },
                select: function (info) {
                    eventIdInput.value = '';
                    eventTitleInput.value = '';
                    eventStartInput.value = info.startStr.slice(0, 16);
                    eventEndInput.value = info.endStr.slice(0, 16);
                    saveEventBtn.textContent = 'Add Availability';
                    deleteEventBtn.classList.add('hidden');
                    newEventModal.show();
                },
                eventClick: function (info) {
                    eventIdInput.value = info.event.id;
                    eventTitleInput.value = info.event.title;
                    eventStartInput.value = info.event.startStr.slice(0, 16);
                    eventEndInput.value = info.event.endStr ? info.event.endStr.slice(0, 16) : info.event.startStr.slice(0, 16);
                    saveEventBtn.textContent = 'Update Availability';
                    deleteEventBtn.classList.remove('hidden');
                    newEventModal.show();
                },
                eventDrop: function (info) {
                    console.log('Event drop triggered', {
                        id: info.event.id,
                        start: info.event.startStr,
                        end: info.event.endStr
                    });
                    fetch(`{{ url('/counselor/schedules') }}/${info.event.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            start: info.event.startStr,
                            end: info.event.endStr
                        })
                    }).then(response => {
                        if (!response.ok) {
                            return response.json().then(error => {
                                throw new Error(`HTTP error ${response.status}: ${error.message || response.statusText}`);
                            });
                        }
                        return response.json();
                    }).then(data => {
                        console.log('Event updated:', data);
                    }).catch(error => {
                        console.error('Error updating event:', error);
                        alert(`Failed to update event: ${error.message}`);
                        info.revert();
                    });
                },
                eventResize: function (info) {
                    console.log('Event resize triggered', {
                        id: info.event.id,
                        start: info.event.startStr,
                        end: info.event.endStr
                    });
                    fetch(`{{ url('/counselor/schedules') }}/${info.event.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            start: info.event.startStr,
                            end: info.event.endStr
                        })
                    }).then(response => {
                        if (!response.ok) {
                            return response.json().then(error => {
                                throw new Error(`HTTP error ${response.status}: ${error.message || response.statusText}`);
                            });
                        }
                        return response.json();
                    }).then(data => {
                        console.log('Event resized:', data);
                    }).catch(error => {
                        console.error('Error resizing event:', error);
                        alert(`Failed to resize event: ${error.message}`);
                        info.revert();
                    });
                },
                datesSet: function (info) {
                    calendarTitle.textContent = info.view.title;
                }
            });

            calendar.render();

            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const view = this.dataset.view;
                    calendar.changeView(view);
                    viewButtons.forEach(btn => {
                        btn.classList.remove('text-success-600', 'bg-white');
                        btn.classList.add('text-gray-500');
                    });
                    this.classList.add('text-success-600', 'bg-white');
                    this.classList.remove('text-gray-500');
                });
            });

            newEventForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const id = eventIdInput.value;
                const title = eventTitleInput.value;
                const start = eventStartInput.value;
                const end = eventEndInput.value;

                if (title && start && end) {
                    const url = id ? `{{ url('/counselor/schedules') }}/${id}` : '{{ url('/counselor/schedules') }}';
                    const method = id ? 'PATCH' : 'POST';

                    fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ title, start, end })
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(error => {
                                throw new Error(`HTTP error ${response.status}: ${error.message || response.statusText}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (id) {
                            const event = calendar.getEventById(id);
                            event.setProp('title', data.title);
                            event.setDates(data.start, data.end);
                        } else {
                            calendar.addEvent(data);
                        }
                        newEventModal.hide();
                        forceBackdropClear();
                        newEventForm.reset();
                    })
                    .catch(error => {
                        console.error('Error saving event:', error);
                        alert(`Failed to save availability: ${error.message}`);
                    });
                } else {
                    alert('Please fill in all fields.');
                }
            });

            deleteEventBtn.addEventListener('click', function () {
                const id = eventIdInput.value;
                if (id && confirm('Delete this availability?')) {
                    fetch(`{{ url('/counselor/schedules') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(error => {
                                throw new Error(`HTTP error ${response.status}: ${error.message || response.statusText}`);
                            });
                        }
                        calendar.getEventById(id).remove();
                        newEventModal.hide();
                        forceBackdropClear();
                        newEventForm.reset();
                    })
                    .catch(error => {
                        console.error('Error deleting event:', error);
                        alert(`Failed to delete availability: ${error.message}`);
                    });
                }
            });

            newEventBtn.addEventListener('click', function () {
                eventIdInput.value = '';
                eventTitleInput.value = '';
                eventStartInput.value = '';
                eventEndInput.value = '';
                saveEventBtn.textContent = 'Add Availability';
                deleteEventBtn.classList.add('hidden');
                newEventModal.show();
            });
        });
    </script>
@endpush