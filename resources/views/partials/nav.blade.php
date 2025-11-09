{{-- nav --}}
<nav x-data="{
    navigationMenuOpen: false, // desktop dropdown
    mobileMenuOpen: false, // mobile menu toggle
    mobileDropdownOpen: '', // mobile dropdown
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
        if (this.$refs.navigationDropdown) {
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
        }
    },
    navigationMenuClearCloseTimeout() {
        clearTimeout(this.navigationMenuCloseTimeout);
    },
    navigationMenuClose() {
        this.navigationMenuOpen = false;
        this.navigationMenu = '';
    },
    toggleMobileDropdown(menu) {
        if (this.mobileDropdownOpen === menu) {
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
            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo"
                class="w-[7rem] h-[3rem] object-contain">
        </a>

        {{-- desktop menu --}}
        <ul class="hidden lg:flex space-x-2">
            <li>
                <button
                    :class="{ 'bg-neutral-100': navigationMenu=='getting-started', 'hover:bg-neutral-100': navigationMenu!='getting-started' }"
                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='getting-started'"
                    @mouseleave="navigationMenuLeave()"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-green-800 hover:text-green-900 transition-colors">
                    Getting Started
                    <svg :class="{ '-rotate-180': navigationMenuOpen && navigationMenu == 'getting-started' }"
                        class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <button
                    :class="{ 'bg-neutral-100': navigationMenu=='learn-more', 'hover:bg-neutral-100': navigationMenu!='learn-more' }"
                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='learn-more'"
                    @mouseleave="navigationMenuLeave()"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-green-800 hover:text-green-900 transition-colors">
                    Learn More
                    <svg :class="{ '-rotate-180': navigationMenuOpen && navigationMenu == 'learn-more' }"
                        class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <a href="{{ route('faqs') }}"
                    class="relative inline-block px-4 py-2 text-sm font-medium text-green-800 hover:text-green-900 group">
                    FAQs
                    <span
                        class="absolute left-0 bottom-0 w-0 h-[2px] bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </li>
        </ul>

        <div class="hidden lg:flex space-x-3">
            <a href="{{ route('login') }}"
                class="px-4 py-2 text-sm font-medium text-green-800 border border-neutral-200 rounded hover:bg-neutral-100">Sign
                In</a>
            <x-button text="Sign Up" href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium" />
        </div>

        {{-- mobile burger --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen; if(!mobileMenuOpen) closeMobileMenu()"
            class="lg:hidden p-2 rounded-md focus:outline-none border border-neutral-200">
            <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- mobile menu --}}
    <div x-cloak x-show="mobileMenuOpen" class="lg:hidden border-t border-neutral-200" x-transition>
        <ul class="flex flex-col p-4 space-y-2">
            <li>
                <button @click="toggleMobileDropdown('getting-started')"
                    class="w-full text-left px-3 py-2 rounded text-green-800 font-[500] hover:bg-neutral-100 flex justify-between items-center">
                    <div class="flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-rocket text-green-700 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                            <path
                                d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                            <path
                                d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                            <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                            <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                        </svg>

                        Getting Started
                    </div>

                    <svg :class="{ '-rotate-180': mobileDropdownOpen=='getting-started' }"
                        class="h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>


                <div x-show="mobileDropdownOpen=='getting-started'" x-collapse
                    class="overflow-hidden pl-6 pt-2 space-y-1">
                    <a href="#_" @click="mobileMenuOpen = false; mobileDropdownOpen=''"
                        class="block px-3 py-2 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-handshake text-green-700 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M8 11h.01" />
                                <path d="M16 11h.01" />
                                <path d="M2 8a6 6 0 0 1 10 0h0a6 6 0 0 1 10 0v8a6 6 0 0 1-10 0h0a6 6 0 0 1-10 0z" />
                            </svg>

                            <div>
                                <span class="block font-medium text-green-800">Welcome to SafeSupport</span>
                                <span class="block text-xs opacity-50">Your safe space for mental health resources and
                                    support.</span>
                            </div>
                        </div>
                    </a>
                    <a href="#_" @click="mobileMenuOpen = false; mobileDropdownOpen=''"
                        class="block px-3 py-2 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-life-buoy text-green-700 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="4" />
                                <line x1="4.93" y1="4.93" x2="9.17" y2="9.17" />
                                <line x1="14.83" y1="14.83" x2="19.07" y2="19.07" />
                                <line x1="14.83" y1="9.17" x2="19.07" y2="4.93" />
                                <line x1="14.83" y1="9.17" x2="19.07" y2="4.93" />
                                <line x1="4.93" y1="19.07" x2="9.17" y2="14.83" />
                            </svg>

                            <div>
                                <span class="block font-medium text-green-800">How to Get Help</span>
                                <span class="block text-xs opacity-50">Easily book sessions with counselors or explore
                                    self-help resources.</span>
                            </div>
                        </div>
                    </a>
                </div>

            </li>
            <li>
                <button @click="toggleMobileDropdown('learn-more')"
                    class="w-full text-left px-3 py-2 rounded hover:bg-neutral-100 flex justify-between items-center text-green-800 font-[500] transition-all duration-300">
                    <div class="flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-book text-green-700 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                            <path d="M4 4h16v16H4z" />
                        </svg>

                        Learn More
                    </div>
                    <svg :class="{ '-rotate-180': mobileDropdownOpen=='learn-more' }"
                        class="h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>

                <div x-show="mobileDropdownOpen=='learn-more'" x-collapse class="overflow-hidden pl-6 pt-2 space-y-1">
                    <a href="{{ route('about') }}" @click="mobileDropdownOpen=''"
                        class="block px-3 py-2 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-info text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12" y2="8" />
                            </svg>

                            <div>
                                <span class="block font-medium text-green-800">About Us</span>
                                <span class="block font-light text-xs opacity-50">
                                    Learn more about our mission, values, and the team behind SafeSupport.
                                </span>
                            </div>
                        </div>
                    </a>

                    <a href="#_" @click="mobileDropdownOpen=''"
                        class="block px-3 py-2 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-graduation-cap text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M22 10v6c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2v-6" />
                                <path d="M12 2L1 7l11 5 9-4.09V15" />
                                <path d="M12 22V12" />
                            </svg>

                            <div>
                                <span class="block font-medium text-green-800">Student Resources</span>
                                <span class="block font-light text-xs opacity-50">
                                    Access articles, videos, and self-help tools curated for mental wellness.
                                </span>
                            </div>
                        </div>
                    </a>

                    <a href="#_" @click="navigationMenuClose()"
                        class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-calendar text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-medium text-green-800">Booking System</span>
                                <span class="block font-light leading-5 opacity-50">
                                    Quickly schedule, reschedule, or cancel counseling sessions online.
                                </span>
                            </div>
                        </div>
                    </a>

                    <a href="#_" @click="navigationMenuClose()"
                        class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-users text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                <path d="M19 8a4 4 0 1 1-8 0" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-medium text-green-800">Community Support</span>
                                <span class="block leading-5 opacity-50">
                                    Engage with peers and mentors in a safe and supportive environment.
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <a href="{{ route('faqs') }}"
                    class="relative block px-3 py-2 text-green-800 font-[500] rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-help-circle text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>

                        FAQs
                    </div>
                    <span
                        class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                </a>

            </li>

        </ul>

        <!-- Actions -->
        <div class="flex flex-col p-4 space-y-2 border-t border-neutral-200">
            <a href="{{ route('login') }}"
                class="block px-3 py-2 text-green-800 border border-neutral-200 rounded hover:bg-neutral-100">Sign
                In</a>
            <x-button text="Sign Up" href="{{ route('register') }}"
                class="px-3 py-2 text-sm font-medium w-full text-center" />
        </div>
    </div>

    <!-- Desktop Dropdown -->
    <div x-cloak x-ref="navigationDropdown" x-show="navigationMenuOpen && !mobileMenuOpen"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()"
        class="absolute top-full left-1/2 -translate-x-1/2 mt-2 z-20" x-cloak>
        <div
            class="flex overflow-hidden justify-center w-auto h-auto bg-white rounded-md border shadow-sm border-neutral-200/70">
            <div x-show="navigationMenu == 'getting-started'"
                class="flex gap-x-3 justify-center items-stretch p-6 w-full max-w-2xl">
                <div class="flex-shrink-0 pt-28 pb-7 w-48 rounded-lg bg-gradient-to-br from-green-400 to-green-700">
                    <div class="relative px-7 space-y-1.5 text-white text-center">
                        <span aria-hidden="true"
                            class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-[55%] 
                                    w-[12rem] h-[12rem] rounded-full -z-10
                                    bg-[radial-gradient(circle,rgba(255,255,255,0.95)_0%,rgba(255,255,255,0.55)_35%,rgba(255,255,255,0.18)_60%,transparent_75%)]
                                    blur-2xl mix-blend-screen">
                        </span>

                        <a href="{{ route('welcome') }}" class="flex justify-center items-center">
                            <img src="{{ asset('img/safesupport-logo.png') }}" alt="SafeSupport Logo"
                                class="w-[7rem] h-[3rem] object-contain drop-shadow-[0_1px_2px_rgba(0,0,0,0.35)]" />
                        </a>

                        <span class="block text-sm opacity-80">
                            A user-friendly Counseling & Booking System
                        </span>
                    </div>
                </div>

                <!-- Links -->
                <div class="w-72 space-y-1">
                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-handshake text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M12 12v10" />
                                <path d="M16 7h5v6a4 4 0 0 1-4 4h-1l-4-4H7l-4 4" />
                                <path d="M2 13V7h5" />
                                <path d="M9 3h6v4H9z" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">Welcome to SafeSupport</span>
                                <span class="block font-light leading-5 opacity-50">
                                    Your safe space for mental health resources and support.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-life-buoy text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="4" />
                                <line x1="4.93" y1="4.93" x2="9.17" y2="9.17" />
                                <line x1="14.83" y1="14.83" x2="19.07" y2="19.07" />
                                <line x1="14.83" y1="9.17" x2="19.07" y2="4.93" />
                                <line x1="4.93" y1="19.07" x2="9.17" y2="14.83" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">How to Get Help</span>
                                <span class="block leading-5 opacity-50">
                                    Easily book sessions with counselors or explore self-help resources.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-share-2 text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">Contribute</span>
                                <span class="block leading-5 opacity-50">
                                    Share mental health resources or volunteer your expertise with our community.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

            <!-- Learn More Dropdown -->
            <div x-show="navigationMenu == 'learn-more'" class="flex justify-center items-stretch p-6 w-full">
                <div class="w-72 space-y-1">
                    <a href="{{ route('about') }}" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-info text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12" y2="8" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">About Us</span>
                                <span class="block font-light leading-5 opacity-50">
                                    Learn more about our mission, values, and the team behind SafeSupport.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-graduation-cap text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M22 10v6c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2v-6" />
                                <path d="M12 2L1 7l11 5 9-4.09V15" />
                                <path d="M12 22V12" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">Student Resources</span>
                                <span class="block font-light leading-5 opacity-50">
                                    Access articles, videos, and self-help tools curated for mental wellness.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <div class="w-72 space-y-1">
                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-calendar text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">Booking System</span>
                                <span class="block font-light leading-5 opacity-50">
                                    Quickly schedule, reschedule, or cancel counseling sessions online.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#_" @click="navigationMenuClose()"
                        class="relative block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 transition-all duration-300 group overflow-hidden">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-users text-green-700 flex-shrink-0 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:text-green-900">
                                <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                <path d="M19 8a4 4 0 1 1-8 0" />
                            </svg>

                            <div>
                                <span class="block mb-1 font-[600] text-green-800">Community Support</span>
                                <span class="block leading-5 opacity-50">
                                    Engage with peers and mentors in a safe and supportive environment.
                                </span>
                            </div>
                        </div>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-green-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

        </div>
    </div>

</nav>
