@extends('layout.master-student')
@section('title', 'Book Appointment')

@section('body')
<div class="bg-pine-50 min-h-full p-6">
    <div class="max-w-md mx-auto bg-white border custom-shadow border-gray-200 rounded-lg p-6">
        <h1 class="text-2xl font-bold text-pine-900 mb-6">Book a New Appointment</h1>
        @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('student.appointments.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="counselor_id" class="block text-sm font-medium text-gray-700">Counselor</label>
                    <select name="counselor_id" id="counselor_id" class="mt-1 w-full border border-gray-200 rounded-lg p-2 text-sm text-gray-600 focus:ring-gray-600 focus:border-gray-600">
                        <option value="" disabled selected>Select a counselor</option>
                        @foreach ($counselors as $counselor)
                        <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                        @endforeach
                    </select>
                    @error('counselor_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" class="mt-1 w-full border border-gray-200 rounded-lg p-2 text-sm text-gray-600 focus:ring-gray-600 focus:border-gray-600">
                    @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                    <input type="time" name="time" id="time" value="{{ old('time') }}" class="mt-1 w-full border border-gray-200 rounded-lg p-2 pr-10 text-sm text-gray-600 focus:ring-gray-600 focus:border-gray-600">
                    <div class="absolute inset-y-0 right-2 top-6 flex items-center pointer-events-none">
                        <img src="{{ asset('img/icons/clock.svg') }}" alt="Clock" class="h-5 w-5">
                    </div>
                    @error('time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('student.appointments') }}" class="h-10 px-4 py-2 text-sm font-medium text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100">Cancel</a>
                <button type="submit" class="h-10 px-4 py-2 text-sm font-medium text-white bg-[#2ba675] rounded-lg hover:bg-[#186f4c] transition">Book Appointment</button>
            </div>
        </form>
    </div>
</div>
@endsection
