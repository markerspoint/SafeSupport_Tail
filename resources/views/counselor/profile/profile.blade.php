@extends('layout.master-counselor')
@section('title', 'Profile')

@section('body')
<div x-data="{ isProfileModal: false }">
    @if (session('success'))
    <div class="mb-4">
        <div class="bg-green-50 border border-gray-200 rounded-md p-4">
            <p class="text-sm text-green-600">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white p-5 lg:p-6">
        <h3 class="mb-5 text-lg font-semibold text-pine-900 lg:mb-7">Profile</h3>

        <!-- Profile Header -->
        <div class="p-5 mb-6 border border-gray-200 rounded-2xl lg:p-6">
            <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                    <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full">
                        <img src="{{ getUserAvatarUrl(auth()->user()) }}" alt="user" class="object-cover w-full h-full" />
                    </div>
                    <div class="order-3 xl:order-2">
                        <h4 class="mb-2 text-lg font-semibold text-center text-pine-900 xl:text-left">
                            {{ auth()->user()->name }}
                        </h4>
                        <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                            <p class="text-sm text-gray-500">Counselor</p>
                            <div class="hidden h-3.5 w-px bg-gray-300 xl:block"></div>
                            <p class="text-sm text-gray-500">
                                Joined: {{ auth()->user()->created_at->format('F j, Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center order-2 gap-2 grow xl:order-3 xl:justify-end">
                        <!-- Social Media Buttons (Placeholders) -->
                        <button class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800">
                            <img src="{{ asset('img/icons/facebook.svg') }}" alt="facebook-logo">
                        </button>
                        <button class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800">
                            <img src="{{ asset('img/icons/twitter.svg') }}" alt="twitter-logo">
                        </button>
                        <button class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800">
                            <img src="{{ asset('img/icons/linkedin.svg') }}" alt="linkedin-logo">
                        </button>
                        <button class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800">
                            <img src="{{ asset('img/icons/instagram.svg') }}" alt="instagram-logo">
                        </button>
                    </div>
                </div>
                <button x-on:click="isProfileModal = true" class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800 lg:inline-flex lg:w-auto">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" />
                    </svg>
                    Edit
                </button>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="p-5 mb-6 border border-gray-200 rounded-2xl lg:p-6">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <h4 class="text-lg font-semibold text-pine-900 lg:mb-6">Personal Information</h4>
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7">
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500">Name</p>
                            <p class="text-sm font-medium text-pine-900">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500">Email</p>
                            <p class="text-sm font-medium text-pine-900">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="mb-2 text-xs leading-normal text-gray-500">Gender</p>
                            <p class="text-sm font-medium text-pine-900">{{ auth()->user()->gender ? ucfirst(auth()->user()->gender) : 'Not set' }}</p>
                        </div>
                    </div>
                </div>
                <button x-on:click="isProfileModal = true" class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:text-gray-800 lg:inline-flex lg:w-auto">
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3962 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z" />
                    </svg>
                    Edit
                </button>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div x-show="isProfileModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[80vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-pine-900">Edit Profile</h2>
                    <button x-on:click="isProfileModal = false" class="text-gray-600 hover:text-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @include('counselor.profile._edit-profile-form')
            </div>
        </div>
    </div>
</div>
@endsection
