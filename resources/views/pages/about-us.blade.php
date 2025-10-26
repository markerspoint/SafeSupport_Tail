<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/safecenter-logo.png') }}" type="image/png">

    <title>SafeSupport About Us</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.nav')

    <section class="relative pb-[8rem] pt-[2rem] bg-center bg-repeat bg-[length:100%_auto]" style="background-image: url('{{ asset('img/landingpage/bg-default-1.png') }}');">
        <div class="absolute inset-0 bg-white/70"></div>

        <div class="relative z-10">
            <h1 class="text-[1.8rem] sm:text-[2rem] md:text-[2.25rem] lg:text-[3rem] font-[650] text-center mb-2 text-green-800">
                About <span class="bg-gradient-to-r from-green-800 via-green-400 to-green-700 bg-clip-text text-transparent">Us</span>
            </h1>

            <p class="text-[0.75rem] sm:text-[0.85rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center text-green-800 mb-[2rem]">
                Learn more about our mission, values, and the team behind SafeSupport.
            </p>
        </div>

        <div class="relative z-10 w-full max-w-[90%] sm:max-w-[40rem] md:max-w-[50rem] lg:max-w-[60rem] mb-8 mx-auto border border-gray-200 rounded-2xl p-6 sm:p-8 md:p-12 text-green-800 space-y-4">
            <h2 class="text-[1.5rem] sm:text-[1.75rem] md:text-[2rem] lg:text-[2.2rem] font-bold text-green-800 text-center mb-4">
                Why SafeSupport is created?
            </h2>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                SafeSupport was created with one simple idea in mind: students know what students truly need. We understand the challenges of balancing academics, personal growth, and mental wellbeing, and we wanted to provide a platform where guidance, resources, and encouragement are all within reach.
            </p>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                Every feature, from counseling appointments to helpful articles and interactive tools, is designed to make support intuitive and approachable. We strive to remove the barriers that can make seeking help feel intimidating or inaccessible.
            </p>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                SafeSupport is <strong>made by students, for students</strong>, built on the belief that peer-driven support makes learning and personal growth more meaningful and empowering.
            </p>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                By combining empathy, innovation, and student insight, SafeSupport aims to create a community where everyone feels understood, supported, and inspired to thrive.
            </p>
        </div>


        <!-- Mission Section -->
        <div class="relative z-10 w-full max-w-[90%] sm:max-w-[40rem] md:max-w-[50rem] lg:max-w-[60rem] mx-auto border border-gray-200 rounded-2xl p-6 sm:p-8 md:p-12 text-green-800 space-y-4 mb-8">
            <h2 class="text-[1.5rem] sm:text-[1.75rem] md:text-[2rem] lg:text-[2.2rem] font-bold text-green-800 text-center mb-4">
                Our Mission
            </h2>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                To provide students with accessible, peer-driven support and resources that empower personal growth and academic success.
            </p>
        </div>

        <!-- Vision Section -->
        <div class="relative z-10 w-full max-w-[90%] sm:max-w-[40rem] md:max-w-[50rem] lg:max-w-[60rem] mx-auto border border-gray-200 rounded-2xl p-6 sm:p-8 md:p-12 text-green-800 space-y-4">
            <h2 class="text-[1.5rem] sm:text-[1.75rem] md:text-[2rem] lg:text-[2.2rem] font-bold text-green-800 text-center mb-4">
                Our Vision
            </h2>
            <p class="text-[0.85rem] sm:text-[0.9rem] md:text-[1rem] lg:text-[1.1rem] font-[600] text-center">
                To create a supportive community where every student feels understood, valued, and inspired to reach their full potential.
            </p>
        </div>


        <!-- Our Team -->
        <div class="mx-auto mt-16 text-center relative z-10 w-full max-w-[90%] sm:max-w-[40rem] md:max-w-[50rem] lg:max-w-[60rem]">
            <h2 class="text-2xl font-bold text-green-800 mb-4">The Developers</h2>
            <p class="text-sm sm:text-base md:text-[1rem] text-green-700 mb-8">
                Meet the team of passionate students who built SafeSupport. <br> Each one contributes their unique skills to make this platform helpful and reliable.
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-items-center">
                <div class="flex flex-col items-center">
                    <div class="w-[150px] h-[150px] mb-3">
                        <img src="{{ asset('devs/ian.jpg') }}" alt="Developer 1" class="w-full h-full object-cover rounded-full shadow-lg">
                    </div>
                    <p class="text-gray-800 font-semibold text-sm">Mark Ian Dela Cruz</p>
                    <p class="text-gray-500 text-xs">Developer / Programmer</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-[150px] h-[150px] mb-3">
                        <img src="{{ asset('devs/yvonne.jpg') }}" alt="Developer 2" class="w-full h-full object-cover rounded-full shadow-lg">
                    </div>
                    <p class="text-gray-800 font-semibold text-sm">Yvonne Grace Ochida</p>
                    <p class="text-gray-500 text-xs">Analytical Writer</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-[150px] h-[150px] mb-3">
                        <img src="{{ asset('devs/cristine.jpeg') }}" alt="Developer 3" class="w-full h-full object-cover rounded-full shadow-lg">
                    </div>
                    <p class="text-gray-800 font-semibold text-sm">Cristine Bilbar</p>
                    <p class="text-gray-500 text-xs">Quality and Assurance</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-[150px] h-[150px] mb-3">
                        <img src="{{ asset('devs/janpil.jpg') }}" alt="Developer 4" class="w-full h-full object-cover rounded-full shadow-lg">
                    </div>
                    <p class="text-gray-800 font-semibold text-sm">Johnphil Arreco</p>
                    <p class="text-gray-500 text-xs">User Researcher</p>
                </div>
            </div>
        </div>

    </section>




    @include('partials.footer')
</body>
</html>
