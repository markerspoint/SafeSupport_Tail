<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'SafeSupport') }}</title>
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white flex flex-col">

    <!-- Main Two-Pane Layout -->
    <main class="flex flex-1">
        <div
            class="relative hidden lg:flex flex-1 items-center justify-center bg-gradient-to-r from-green-100 via-green-200 to-white overflow-hidden">
            <div class="pointer-events-none absolute inset-0 opacity-25"
                style="background-image:
             repeating-linear-gradient(135deg, rgba(22,163,74,0.12) 0px, rgba(22,163,74,0.12) 2px, transparent 4px, transparent 8px);">
            </div>
            <!-- centered logo -->
            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo"
                class="relative w-64 h-auto drop-shadow-md opacity-90 select-none" />
        </div>

        <!-- Right Pane (form) -->
        <div class="flex flex-col justify-center items-center w-full lg:w-1/2 px-6 py-12">
            <div class="max-w-md w-full space-y-6">
                <div class="text-center">
                    <h1 class="text-3xl font-semibold text-green-800 mb-1">Create your account</h1>
                    <p class="text-sm text-gray-600">Join the SafeSpace community</p>
                </div>

                <!-- Success / Error Messages -->
                @if (session('success'))
                    <div class="p-3 text-sm bg-green-100 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-3 text-sm bg-red-100 text-red-700 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            placeholder="Enter your name"
                            class="mt-1 w-full p-2 border rounded-md bg-white text-sm text-neutral-800 border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                            required />
                        @error('name')
                            <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="mt-1 w-full p-2 border rounded-md bg-white text-sm text-neutral-800 border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                            required />
                        @error('email')
                            <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div hidden>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select id="gender" name="gender"
                            class="mt-1 w-full p-2 border rounded-md bg-white text-sm text-neutral-800 border-gray-300 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                            required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender
                            </option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" placeholder="Enter your password"
                            class="mt-1 w-full p-2 border rounded-md bg-white text-sm text-neutral-800 border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                            required />
                        @error('password')
                            <p class="mt-1 text-sm text-green-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Confirm your password"
                            class="mt-1 w-full p-2 border rounded-md bg-white text-sm text-neutral-800 border-gray-300 placeholder:text-gray-500 focus:border-green-700 focus:ring-2 focus:ring-green-700 focus:ring-offset-1 focus:outline-none"
                            required />
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full bg-green-700 text-white py-2 rounded-md border-b-4 border-green-800 transform transition duration-300 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-800">
                            Register
                        </button>
                    </div>
                </form>

                <div class="text-center text-sm text-gray-600 mt-6">
                    <p>
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-green-700 font-medium hover:underline">Login
                            here</a>
                    </p>
                </div>

                <div class="text-center text-sm text-gray-600 mt-6 space-y-1">
                    <p>
                        Need help? Contact us at
                        <a href="mailto:support@safesupport.com"
                            class="text-green-700 font-medium hover:underline">support@safesupport.com</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
