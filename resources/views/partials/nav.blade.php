{{-- nav --}}
<nav x-data="{
    navigationMenuOpen: false,       // desktop dropdown
    mobileMenuOpen: false,           // mobile menu toggle
    mobileDropdownOpen: '',          // mobile dropdown
    navigationMenu: '',
    navigationMenuCloseDelay: 200,
    navigationMenuCloseTimeout: null,
    navigationMenuLeave() {
        let that = this;
        this.navigationMenuCloseTimeout = setTimeout(() => {
            that.navigationMenuClose();
        }, this.navigationMenuCloseDelay);
    },
    navigationMenuReposition(navElement) {
        this.navigationMenuClearCloseTimeout();
        if(this.$refs.navigationDropdown){
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth/2) + 'px';
        }
    },
    navigationMenuClearCloseTimeout(){
        clearTimeout(this.navigationMenuCloseTimeout);
    },
    navigationMenuClose(){
        this.navigationMenuOpen = false;
        this.navigationMenu = '';
    },
    toggleMobileDropdown(menu){
        if(this.mobileDropdownOpen === menu){
            this.mobileDropdownOpen = '';
        } else {
            this.mobileDropdownOpen = menu;
        }
    },
    closeMobileMenu() {
        this.mobileMenuOpen = false;
        this.mobileDropdownOpen = '';
        this.navigationMenuClose(); // closes desktop dropdown if open
    }
}" class="sticky top-0 z-50 w-full border-b border-neutral-200 bg-white/40 backdrop-blur-md">

    <div class="flex items-center justify-between px-6 py-3">

        {{-- logo --}}
        <a href="{{ route('welcome') }}" class="flex items-center">
            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo" class="w-[7rem] h-[3rem] object-contain">
        </a>

        {{-- desktop menu --}}
        <ul class="hidden lg:flex space-x-2">
            <li>
                <button :class="{ 'bg-neutral-100' : navigationMenu=='getting-started', 'hover:bg-neutral-100' : navigationMenu!='getting-started' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='getting-started'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-green-800 hover:text-green-900 transition-colors">
                    Getting Started
                    <svg :class="{ '-rotate-180' : navigationMenuOpen && navigationMenu == 'getting-started' }" class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <button :class="{ 'bg-neutral-100' : navigationMenu=='learn-more', 'hover:bg-neutral-100' : navigationMenu!='learn-more' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='learn-more'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-green-800 hover:text-green-900 transition-colors">
                    Learn More
                    <svg :class="{ '-rotate-180' : navigationMenuOpen && navigationMenu == 'learn-more' }" class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <a href="{{ route('faqs') }}" class="relative inline-block px-4 py-2 text-sm font-medium text-green-800 hover:text-green-900 group">
                    FAQs
                    <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
        </ul>

        <div class="hidden lg:flex space-x-3">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-black border border-neutral-200 rounded hover:bg-neutral-100">Sign In</a>
            <x-button text="Sign Up" href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium" />
        </div>

        {{-- mobile burger --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen; if(!mobileMenuOpen) closeMobileMenu()" class="lg:hidden p-2 rounded-md focus:outline-none border border-neutral-200">
            <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- mobile menu --}}
    <div x-cloak x-show="mobileMenuOpen" class="lg:hidden border-t border-neutral-200" x-transition>
        <ul class="flex flex-col p-4 space-y-2">
            <li>
                <button @click="toggleMobileDropdown('getting-started')" class="w-full text-left px-3 py-2 rounded hover:bg-neutral-100 flex justify-between items-center">
                    Getting Started
                    <svg :class="{ '-rotate-180' : mobileDropdownOpen=='getting-started' }" class="h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div x-show="mobileDropdownOpen=='getting-started'" x-collapse class="overflow-hidden pl-6 pt-2 space-y-1">
                    <a href="#_" @click="mobileMenuOpen = false; mobileDropdownOpen=''" class="block px-3 py-2 text-sm rounded hover:bg-neutral-100">
                        <span class="block font-medium">Welcome to SafeSupport</span>
                        <span class="block text-xs opacity-50">Your safe space for mental health resources and support.</span>
                    </a>
                    <a href="#_" @click="mobileMenuOpen = false; mobileDropdownOpen=''" class="block px-3 py-2 text-sm rounded hover:bg-neutral-100">
                        <span class="block font-medium">How to Get Help</span>
                        <span class="block text-xs opacity-50">Easily book sessions with counselors or explore self-help resources.</span>
                    </a>
                </div>
            </li>
            <li>
                <button @click="toggleMobileDropdown('learn-more')" class="w-full text-left px-3 py-2 rounded hover:bg-neutral-100 flex justify-between items-center">
                    Learn More
                    <svg :class="{ '-rotate-180' : mobileDropdownOpen=='learn-more' }" class="h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div x-show="mobileDropdownOpen=='learn-more'" x-collapse class="overflow-hidden pl-6 pt-2 space-y-1">
                    <a href="{{ route('about') }}" @click="mobileDropdownOpen=''" class="block px-3 py-2 text-sm rounded hover:bg-neutral-100">
                        <span class="block font-medium text-green-800">About Us</span>
                        <span class="block font-light text-xs opacity-50">Learn more about our mission, values, and the team behind SafeSupport.</span>
                    </a>
                    <a href="#_" @click="mobileDropdownOpen=''" class="block px-3 py-2 text-sm rounded hover:bg-neutral-100">
                        <span class="block font-medium text-green-800">Student Resources</span>
                        <span class="block font-light text-xs opacity-50">Access articles, videos, and self-help tools curated for mental wellness.</span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-green-800">Booking System</span>
                        <span class="block font-light leading-5 opacity-50">Quickly schedule, reschedule, or cancel counseling sessions online.</span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-green-800">Community Support</span>
                        <span class="block leading-5 opacity-50">Engage with peers and mentors in a safe and supportive environment.</span>
                    </a>
                </div>
            </li>
            <li><a href="#" class="block px-3 py-2 rounded hover:bg-neutral-100">FAQs</a></li>
        </ul>

        <!-- Actions -->
        <div class="flex flex-col p-4 space-y-2 border-t border-neutral-200">
            <a href="/signin" class="block px-3 py-2 text-black border border-neutral-200 rounded hover:bg-neutral-100">Sign In</a>
            <x-button text="Sign Up" href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium w-full text-center" />
        </div>
    </div>

    <!-- Desktop Dropdown -->
    <div x-cloak x-ref="navigationDropdown" x-show="navigationMenuOpen && !mobileMenuOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()" class="absolute top-full left-1/2 -translate-x-1/2 mt-2 z-20" x-cloak>
        <div class="flex overflow-hidden justify-center w-auto h-auto bg-white rounded-md border shadow-sm border-neutral-200/70">
            <div x-show="navigationMenu == 'getting-started'" class="flex gap-x-3 justify-center items-stretch p-6 w-full max-w-2xl">
                <!-- SafeSupport Card -->
                <div class="flex-shrink-0 pt-28 pb-7 w-48 rounded-lg bg-gradient-to-br from-green-400 to-green-700">
                    <div class="relative px-7 space-y-1.5 text-white text-center">
                        <svg class="block w-9 h-9 mx-auto -mt-[2rem]" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="20" r="12" stroke="currentColor" stroke-width="4" />
                            <path d="M16 52c0-8 16-8 16-8s16 0 16 8v4H16v-4z" fill="currentColor" />
                            <path d="M32 32c-12 0-16 8-16 8v4h32v-4s-4-8-16-8z" fill="currentColor" />
                        </svg>
                        <span class="block font-sans font-bold text-lg">SafeSupport</span>
                        <span class="block text-sm opacity-80">A user-friendly Counseling & Booking System</span>
                    </div>
                </div>
                <!-- Links -->
                <div class="w-72">
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">Welcome to SafeSupport</span>
                        <span class="block font-light leading-5 opacity-50">Your safe space for mental health resources and support.</span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">How to Get Help</span>
                        <span class="block leading-5 opacity-50">Easily book sessions with counselors or explore self, self-help resources.</span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">Contribute</span>
                        <span class="block leading-5 opacity-50">Share mental health resources or volunteer your expertise with our community.</span>
                    </a>
                </div>
            </div>

            <!-- Learn More Dropdown -->
            <div x-show="navigationMenu == 'learn-more'" class="flex justify-center items-stretch p-6 w-full">
                <div class="w-72">
                    <a href="{{ route('about') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">About Us</span>
                        <span class="block font-light leading-5 opacity-50">
                            Learn more about our mission, values, and the team behind SafeSupport.
                        </span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">Student Resources</span>
                        <span class="block font-light leading-5 opacity-50">Access articles, videos, and self-help tools curated for mental wellness.</span>
                    </a>
                </div>
                <div class="w-72">
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">Booking System</span>
                        <span class="block font-light leading-5 opacity-50">Quickly schedule, reschedule, or cancel counseling sessions online.</span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                        <span class="block mb-1 font-medium text-black">Community Support</span>
                        <span class="block leading-5 opacity-50">Engage with peers and mentors in a safe and supportive environment.</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</nav>
