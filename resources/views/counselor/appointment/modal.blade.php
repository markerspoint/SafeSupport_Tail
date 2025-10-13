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