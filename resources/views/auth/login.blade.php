<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'SafeSupport') }}</title>
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pine-50 flex flex-col items-center min-h-screen">

    <!-- Navbar -->
    <nav class="w-full bg-white shadow-sm px-[10rem] py-3">
        <a href="{{ route('welcome') }}" class="flex items-center">
            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo" class="w-[7rem] h-[3rem] object-contain">
        </a>
    </nav>

    <!-- Login Card -->
    <div class="w-full max-w-md p-6 mt-[5rem] pt-6">
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-xl font-bold text-center text-gray-900 mb-1">Welcome back!</h2>
            <p class="text-sm font-sans text-center mb-3">You're in a SafeSpace!</p>

            <div x-data="{ showError: @entangle('error') }" x-show="showError" class="mb-4 p-4 bg-pine-100 text-pine-700 rounded-lg" x-transition>
                {{ session('error') }}
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-4 w-full max-w-xs mx-auto">
                    <label for="email" class="block mb-1 text-sm font-medium text-pine-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" required />
                    @error('email')
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

                <!-- Submit button -->
                <div class="w-full max-w-xs mx-auto">
                    <button type="submit" class="w-full h-10 bg-[#171717] text-white rounded-lg hover:bg-[#2d2d2d] transition">
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-4 text-center text-pine-600">
                Don't have an account? <a href="{{ route('register') }}" class="text-pine-500 hover:underline">Register</a>
            </p>
        </div>
    </div>
</body>
</html>
