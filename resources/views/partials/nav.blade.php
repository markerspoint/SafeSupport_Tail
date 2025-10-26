    {{-- nav --}}
    <nav x-data="{
    navigationMenuOpen: false,
    mobileMenuOpen: false,
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
        this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
        this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth/2) + 'px';
    },
    navigationMenuClearCloseTimeout(){
        clearTimeout(this.navigationMenuCloseTimeout);
    },
    navigationMenuClose(){
        this.navigationMenuOpen = false;
        this.navigationMenu = '';
    }
}" class="sticky top-0 z-50 w-full bg-white border-b border-neutral-200 bg-white/60 backdrop-blur-md">

        <div class="flex items-center justify-between px-6 py-3">


            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('img/safecenter-logo.png') }}" alt="SafeSupport Logo" class="w-10 h-10 object-contain">
                <span class="text-xl font-bold text-neutral-700">SafeSupport</span>
            </a>


            <ul class="hidden md:flex space-x-2">
                <li>
                    <button :class="{ 'bg-neutral-100' : navigationMenu=='getting-started', 'hover:bg-neutral-100' : navigationMenu!='getting-started' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='getting-started'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md hover:text-neutral-900 transition-colors">
                        Getting Started
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'getting-started' }" class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </li>
                <li>
                    <button :class="{ 'bg-neutral-100' : navigationMenu=='learn-more', 'hover:bg-neutral-100' : navigationMenu!='learn-more' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='learn-more'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md hover:text-neutral-900 transition-colors">
                        Learn More
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'learn-more' }" class="ml-1 h-3 w-3 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </li>
                <li>
                    <a href="/documentation" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md hover:text-neutral-900 transition-colors">
                        Documentation
                    </a>
                </li>
            </ul>


            <div class="hidden md:flex space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-black border border-neutral-200 rounded hover:bg-neutral-100">Sign In</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-neutral-700 rounded hover:bg-neutral-900">Sign Up</a>
            </div>


            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-md focus:outline-none border border-neutral-200">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


        <div x-show="mobileMenuOpen" class="md:hidden border-t border-neutral-200" x-transition>
            <ul class="flex flex-col p-4 space-y-2">
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-neutral-100">Getting Started</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-neutral-100">Learn More</a></li>
                <li><a href="/documentation" class="block px-3 py-2 rounded hover:bg-neutral-100">Documentation</a></li>
            </ul>
            <div class="flex flex-col p-4 space-y-2 border-t border-neutral-200">
                <a href="/signin" class="block px-3 py-2 text-black border border-neutral-200 rounded hover:bg-neutral-100">Sign In</a>
                <a href="/signup" class="block px-3 py-2 text-white bg-black rounded hover:bg-neutral-900">Sign Up</a>
            </div>
        </div>


        <div x-ref="navigationDropdown" x-show="navigationMenuOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()" class="absolute top-full left-1/2 -translate-x-1/2 mt-2 z-20 hidden md:flex" x-cloak>
            <div class="flex overflow-hidden justify-center w-auto h-auto bg-white rounded-md border shadow-sm border-neutral-200/70">
                <div x-show="navigationMenu == 'getting-started'" class="flex gap-x-3 justify-center items-stretch p-6 w-full max-w-2xl">
                    <div class="flex-shrink-0 pt-28 pb-7 w-48 bg-gradient-to-br to-black rounded from-neutral-800">
                        <div class="relative px-7 space-y-1.5 text-white">
                            <svg class="block w-auto h-9" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M67.683 89.217h44.634l30.9 53.218H36.783l30.9-53.218Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M77.478 120.522h21.913v46.956H77.478v-46.956Zm-34.434-29.74 45.59-78.26 46.757 78.26H43.044Z" fill="currentColor" />
                            </svg>
                            <span class="block font-sans font-bold">SafeSupport</span>
                            <span class="block text-sm opacity-60">A user-friendly Booking System</span>
                        </div>
                    </div>
                    <div class="w-72">
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Welcome to SafeSupport</span>
                            <span class="block font-light leading-5 opacity-50">Your safe space for mental health resources and support.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">How to Get Help</span>
                            <span class="block leading-5 opacity-50">Easily book sessions with counselors or explore self-help resources.</span>
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
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Counselor Dashboard</span>
                            <span class="block font-light leading-5 opacity-50">Manage appointments, view student progress, and provide support efficiently.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Student Resources</span>
                            <span class="block font-light leading-5 opacity-50">Access articles, videos, and self-help tools curated for mental wellness.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">SafeSupport UI</span>
                            <span class="block leading-5 opacity-50">Our clean, intuitive interface designed to make support easy and accessible.</span>
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
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Guides & Tools</span>
                            <span class="block leading-5 opacity-50">Practical guides and tools to help students maintain their mental wellness.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>