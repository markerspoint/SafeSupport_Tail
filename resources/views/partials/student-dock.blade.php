            <div x-data="{ open: false, mobileOpen: false }" class="flex flex-col md:flex-row flex-1 w-full relative">
                {{-- mobile version of icon --}}
                <nav class="fixed bottom-0 left-0 right-0 z-40 border-t bg-background/95 backdrop-blur-sm md:hidden"
                    role="navigation" aria-label="Mobile navigation">
                    <div class="grid h-16 grid-cols-4" style="padding-bottom: env(safe-area-inset-bottom);">

                        <a aria-label="Go to my communities" href="#"
                            class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out 
                            hover:text-foreground focus:outline-none focus:ring-2 focus:ring-inset focus:ring-success active:scale-95 
                            text-primary active"
                            aria-current="page" data-status="active">

                            <div class="absolute inset-0 scale-75 rounded-lg bg-primary/10"></div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-house h-5 w-5 text-green-800 transition-all duration-200 scale-110 drop-shadow-sm">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path
                                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                                </path>
                            </svg>

                            <span
                                class="max-w-[64px] truncate transition-all duration-200 font-semibold text-green-800">My
                                Communities</span>
                        </a>

                        <a aria-label="Browse communities" href="#"
                            class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out
                            focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95 text-muted-foreground 
                            hover:text-muted-foreground/80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-users h-5 w-5 text-green-800 transition-all duration-200">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span
                                class="max-w-[64px] truncate transition-all duration-200 text-green-800">Communities</span>
                        </a>

                        <a aria-label="View notifications" href="{{ route('student.notification') }}"
                            class="relative flex justify-center focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95">
                            <div
                                class="flex flex-col items-center gap-1 text-xs font-medium transition-all duration-200
                                        rounded-md px-3 py-1 m-2
                                        {{ request()->routeIs('student.notification') ? 'bg-green-100 text-green-800' : 'text-green-800 hover:text-green-200' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-bell h-5 w-5 transition-all duration-200">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                </svg>
                                <span class="max-w-[64px] truncate transition-all duration-200">Notifications</span>
                            </div>
                        </a>


                        <button aria-label="View menu" @click="drawerOpen = true"
                            class="relative flex flex-col items-center justify-center gap-1 text-xs font-medium transition-all duration-200 ease-in-out
                            focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary active:scale-95 text-muted-foreground 
                            hover:text-muted-foreground/80">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-menu h-5 w-5 transition-all duration-200 text-green-800">
                                <line x1="4" x2="20" y1="12" y2="12"></line>
                                <line x1="4" x2="20" y1="6" y2="6"></line>
                                <line x1="4" x2="20" y1="18" y2="18"></line>
                            </svg>
                            <span class="max-w-[64px] truncate transition-all duration-200 text-green-800">Menu</span>
                        </button>
                    </div>
                </nav>
            </div>
