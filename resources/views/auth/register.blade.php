<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'SafeSupport') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pine-50 flex flex-col items-center min-h-screen">

    <nav class="w-full bg-white shadow-sm px-[10rem] py-3">
        <a href="{{ route('welcome') }}" class="flex items-center">
            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo" class="w-[7rem] h-[3rem] object-contain">
        </a>
    </nav>

    <!-- Register Card -->
    <div class="w-full max-w-md p-6 mt-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold text-center text-gray-900 mb-1">Create your account now!</h2>
            <p class="text-sm font-sans text-center mb-3">You're in a SafeSpace!</p>

            <div x-data="{ showError: @entangle('error') }" x-show="showError" class="mb-4 p-4 bg-pine-100 text-pine-700 rounded-lg" x-transition>
                {{ session('error') }}
            </div>

            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="name" class="block mb-1 text-sm font-medium text-pine-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter your name" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required />
                    @error('name')
                    <p class="mt-1 text-sm text-pine-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="email" class="block mb-1 text-sm font-medium text-pine-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required />
                    @error('email')
                    <p class="mt-1 text-sm text-pine-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="gender" class="block mb-1 text-sm font-medium text-pine-700">Gender</label>
                    <select id="gender" name="gender" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required>
                        <option value="" {{ old('gender') ? '' : 'selected' }} disabled>Select gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                    <p class="mt-1 text-sm text-pine-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="password" class="block mb-1 text-sm font-medium text-pine-700">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required />
                    @error('password')
                    <p class="mt-1 text-sm text-pine-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="password_confirmation" class="block mb-1 text-sm font-medium text-pine-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required />
                </div>

                <!-- Submit button -->
                <div class="w-full max-w-xs mx-auto">
                    <button type="submit" class="w-full h-10 bg-[#171717] text-white rounded-lg hover:bg-[#2d2d2d] transition">
                        Register
                    </button>
                </div>
            </form>

            <p class="mt-4 text-center text-pine-600">
                Already have an account? <a href="{{ route('login') }}" class="text-pine-500 hover:underline">Login</a>
            </p>
        </div>
    </div>
</body>
</html>