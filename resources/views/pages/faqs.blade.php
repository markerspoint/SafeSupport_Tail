<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">
    <title>SafeSupport FAQs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.nav')

    <section class="relative pb-[4rem] pt-[2rem] bg-center bg-repeat bg-[length:100%_auto]"
        style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70 z-0"></div>

        <div data-aos="fade-right" data-aos-duration="2000" data-aos-easing="ease-out-cubic" class="relative z-10">
            <h1
                class="text-[1.4rem] font-[650] xs-text-[2rem] sm:text-[2rem] md:text-[2rem] lg:text-[3rem] text-center mb-2 text-green-800">
                Frequently <span
                    class="bg-gradient-to-r from-green-800 via-green-400 to-green-700 bg-clip-text text-transparent">Asked</span>
                Questions
            </h1>

            <p class="text-[0.8rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center text-green-800 mb-[2rem]">
                Everything you need to know about using SafeSupport</p>
        </div>

        <div data-aos="fade-left" data-aos-duration="2000" data-aos-easing="ease-out-cubic" x-data="{
            activeAccordion: '',
            setActiveAccordion(id) {
                this.activeAccordion = (this.activeAccordion == id) ? '' : id
            }
        }"
            class="relative w-[24rem] md:w-[30rem] lg:w-[34rem] mx-auto text-[1.1rem] py-5 px-5 mb-6 space-y-3 bg-transparent border border-gray-200 rounded-2xl">

            <div class="flex items-center space-x-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-auto h-[2rem] pl-3 text-green-700" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 014 4c0 2-4 2-4 4m0 4h.01" />
                </svg>
                <h1 class="text-[1.5rem] font-[650] text-green-800">Introduction</h1>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>What is SafeSupport?</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        SafeSupport is a student-friendly platform that helps you book counseling sessions, access
                        mental health resources, and connect with professional counselors—all in one place.
                    </div>
                </div>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Who can use SafeSupport?</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        SafeSupport is designed for students who want easy access to counseling and mental health
                        support, but anyone in the student community can benefit from its resources.
                    </div>
                </div>
            </div>
        </div>

        <div data-aos="fade-right" data-aos-duration="2000" data-aos-easing="ease-out-cubic"  x-data="{
            activeAccordion: '',
            setActiveAccordion(id) {
                this.activeAccordion = (this.activeAccordion == id) ? '' : id
            }
        }"
            class="relative w-[24rem] md:w-[30rem] lg:w-[34rem] mx-auto text-[1.1rem] py-5 px-5 mb-6 space-y-3 bg-transparent border border-gray-200 rounded-2xl">

            <div class="flex items-center space-x-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-auto h-[2rem] pl-3 text-green-700" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 014 4c0 2-4 2-4 4m0 4h.01" />
                </svg>
                <h1 class="text-[1.5rem] font-[650] text-green-800">Features</h1>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Booking Counseling Sessions</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Schedule one-on-one sessions with available counselors, choose your preferred date and time, and
                        manage bookings directly from your dashboard.
                    </div>
                </div>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Accessing Mental Health Resources</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Read articles, watch videos, and explore self-help tools tailored to student mental health.
                    </div>
                </div>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Managing Appointments</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Cancel or reschedule your upcoming sessions, and get notifications if your counselor updates
                        availability.
                    </div>
                </div>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Notifications & Updates</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Receive email or dashboard notifications for upcoming appointments, new resources, or important
                        announcements.
                    </div>
                </div>
            </div>

            <div x-data="{ id: $id('accordion') }"
                :class="{ 'border-green-200/60 text-green-800': activeAccordion ==
                    id, 'border-transparent text-neutral-600 hover:text-neutral-800': activeAccordion != id }"
                class="duration-200 ease-out bg-white border rounded-md cursor-pointer group" x-cloak>
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full px-5 py-4 font-semibold text-left select-none">
                    <span>Getting Help</span>
                    <div :class="{ 'rotate-90': activeAccordion == id }"
                        class="relative flex items-center justify-center w-2.5 h-2.5 duration-300 ease-out">
                        <div class="absolute w-0.5 h-full bg-neutral-500 group-hover:bg-green-800 rounded-full"></div>
                        <div :class="{ 'rotate-90': activeAccordion == id }"
                            class="absolute w-full h-0.5 ease duration-500 bg-neutral-500 group-hover:bg-green-800 rounded-full">
                        </div>
                    </div>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-5 pt-0 opacity-70">
                        Connect with counselors, explore mental health content, or contact support for technical or
                        account assistance.
                    </div>
                </div>
            </div>
        </div>

        <div data-aos="zoom-in-up" data-aos-duration="1000" data-aos-easing="ease-out-cubic" class="flex justify-center z-10">
            <div
                class="relative w-[20rem] xs:w-[25rem] sm:w-[30rem] md:w-[45rem] lg:w-[60rem] py-[2rem] xs:py-[2rem] sm:py-[3rem] md:py-[3rem] lg:py-[4rem] bg-[#2d6a4f] text-center text-white mt-4 rounded-2xl shadow-lg">
                <h2 class="mb-4 text-[2rem] md:text-[2.25rem] lg:text-[2.5rem] font-bold">Still have questions?</h2>
                <p
                    class="mx-auto mb-8 px-[2rem] md:max-w-[36rem] lg:max-w-2xl text-[0.9rem] md:text-[1.1rem] lg:text-[1.3rem] text-white/90">
                    Can't find the answer you're looking for? Our team is here to help.
                </p>
                <x-button href="mailto:safesupport@gmail.com"
                    class="inline-flex items-center px-6 py-3 !bg-green-500 border-b-4 border-green-600 transform transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                    Contact Support
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </x-button>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>

</html>
