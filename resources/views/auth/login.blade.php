<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'SafeSupport') }}</title>
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white flex">

    <div
        class="relative hidden lg:flex items-center justify-center flex-1 bg-gradient-to-r from-green-100 via-green-200 to-white overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-30"
            style="background-image:
        repeating-linear-gradient(135deg, rgba(0,0,0,0.1) 0px, rgba(0,0,0,0.1) 1px, transparent 4px, transparent 10px);">
        </div>

        <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo"
            class="relative w-64 h-auto drop-shadow-md opacity-90 select-none" />
    </div>


    <!-- Right Side (Login form) -->
    <div class="flex flex-col justify-center items-center w-full lg:w-1/2 px-6 py-12">
        <div class="max-w-md w-full space-y-6">
            <div class="text-center">
                <h1 class="text-3xl font-semibold text-green-800 mb-1">Welcome back!</h1>
                <p class="text-sm text-gray-600">Log in to continue to your account</p>
            </div>

            <!-- Error message -->
            @if (session('error'))
                <div class="p-3 text-sm bg-green-100 text-green-800 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="mt-1 w-full p-2 border rounded-md border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password"
                        class="mt-1 w-full p-2 border rounded-md border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                        required>
                    @error('password')
                        <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-end">
                    <a href="#" class="text-sm text-green-700 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-green-700 text-white py-2 rounded-md border-b-4 border-green-800 transform transition duration-300 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-800">
                        Log in
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="text-center text-sm text-gray-600 mt-6 space-y-1">
                <p>
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-green-700 font-medium hover:underline">Sign up here
                        for free</a>
                </p>
                <p>
                    Need help? Contact us at
                    <a href="mailto:support@safesupport.com"
                        class="text-green-700 font-medium hover:underline">support@safesupport.com</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
