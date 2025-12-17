<!DOCTYPE html>
<html lang="en" class="scroll-smooth antialiased">

<head>
    <!-- ✅ Prevent light flash before dark mode loads -->
    <script>
        // Immediately set dark mode if user or system prefers it
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{$title}}">
    <meta property="og:description" content="{{ $des }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://quickcalculateit.com/length-converter">
    <meta property="og:image" content="https://quickcalculateit.com/images/staticimages/logo_2.png">
    <meta property="keyword" content="{{$key}}">

    <meta property="og:locale" content="en_AU">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="https://quickcalculateit.com/images/staticimages/logo_2.png">
    <meta name="twitter:title" content="{{ $titleTwitter ?? 'twitter' }}">
    <meta name="twitter:description" content="{{ $des ?? 'Explore 20+ free online calculators including unit converters, finance tools, fitness calculators, math calculators, and more. Fast, accurate, and easy to use for everyday calculations.' }}">
    <meta name="twitter:image" content="https://quickcalculateit.com/images/staticimages/logo_2.png">


    <title>{{ $title  }}</title>

    <!-- Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/model.css') }}">

    <link rel="icon" sizes="32x32" type="image/png" href="https://quickcalculateit.com/images/staticimages/logo_2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <script>
        tailwind = undefined; // quiet SSR linters
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <!-- SimplePagination.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute("content"),
            },
        });
    </script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'ui-sans-serif', 'Segoe UI', 'Roboto', 'Helvetica', 'Arial']
                    },
                    colors: {
                        base: '#0F172A', // text
                        head: '#111827', // headings
                        bg: '#F8FAFC', // background
                        brand: '#2563EB', // accent
                        ok: '#059669', // success
                        warn: '#F59E0B', // warning
                    },
                    boxShadow: {
                        card: '0 1px 2px rgba(0,0,0,.04), 0 10px 15px -3px rgba(0,0,0,.08)',
                    }
                }
            }
        }
    </script>
    <style>
        .actives {
            background-color: rgba(88, 177, 37, 1);
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.25s ease;
        }

        .sidebar-item i {
            font-size: 18px;
            width: 22px;
            text-align: center;
            display: block;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(4px);
        }
    </style>

</head>

<body class="bg-bg text-base dark:bg-slate-900 dark:text-slate-100">

    <!-- Header -->
    <header class="sticky top-0 z-40 border-b border-white/10 bg-emerald-800  backdrop-blur-md dark:bg-slate-900/70">
        <div class="mx-auto w-full max-w-full px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between ">
            <!-- Left Section: Logo + Nav -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <div class="hidden lg:block">
                    <div class="text-brand grid place-items-center font-extrabold ">
                        <img class="w-[55px] sm:w-[65px] object-contain" src="{{ asset('images/staticimages/logo_2.png') }}" alt="calculator logo" />
                    </div>
                </div>
                <button id="show-sidebar" class=" flex items-center gap-2 min-w-[70px] block lg:hidden">
                    <svg width="25" height="25" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <nav class="hidden lg:flex items-center gap-2 text-sm relative flex-wrap text-white">
                    <a href="{{ url('/') }}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">Home</a>
                    <a href="{{ route('about.us') }}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">About</a>

                    <a href="{{ route('contact.index') }}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">Contact</a>

                    <a href="{{route('world.time')}}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">Global Time</a>

                    <div class="relative">
                        <button id="" class="categories-btn transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white flex items-center gap-1">
                            Categories
                            <svg class="w-4 h-4 transition-transform" id="caret-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id=""
                            class="categories-menu absolute  top-full max-h-[50vh] overflow-y-scroll  left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md text-gray-900 shadow-md hidden">
                            <a href="{{ route('length') }}" class="block px-4 py-2 hover:bg-gray-100">Length Calculator</a>
                            <a href="{{ route('area') }}" class="block px-4 py-2 hover:bg-gray-100">Area Calculator</a>
                            <a href="{{ route('time') }}" class="block px-4 py-2 hover:bg-gray-100">Time Calculator</a>
                            <a href="{{ route('volume') }}" class="block px-4 py-2 hover:bg-gray-100">volume Calculator</a>
                            <a href="{{ route('temperature') }}" class="block px-4 py-2 hover:bg-gray-100">Temperature</a>
                            <a href="{{ route('weight') }}" class="block px-4 py-2 hover:bg-gray-100">Weight Calculator</a>
                            <a href="{{ route('age.calculator.view') }}" class="block px-4 py-2 hover:bg-gray-100">Age calculator</a>
                            <a href="{{ route('dayCounter.view') }}" class="block px-4 py-2 hover:bg-gray-100">Day Counter</a>
                            <a href="{{ route('finance.income_tax') }}" class="block px-4 py-2 hover:bg-gray-100">Tax calculator</a>
                            <a href="{{ route('finance.rent') }}" class="block px-4 py-2 hover:bg-gray-100">Rent Calculator</a>
                            <a href="{{ route('finance.salary') }}" class="block px-4 py-2 hover:bg-gray-100">Salary Calculator</a>
                            <a href="{{ route('finance.depreciation') }}" class="block px-4 py-2 hover:bg-gray-100">Depreciation</a>
                            <a href="{{ route('finance.mortgage') }}" class="block px-4 py-2 hover:bg-gray-100">Mortgage Calculator</a>
                            <a href="{{ route('fitness.bmi') }}" class="block px-4 py-2 hover:bg-gray-100">BMI Calculator</a>
                            <a href="{{ route('fitness.bmr') }}" class="block px-4 py-2 hover:bg-gray-100">BMR Calculator</a>
                            <a href="{{ route('fitness.tdee') }}" class="block px-4 py-2 hover:bg-gray-100">TDEE Calculator</a>
                            <a href="{{ route('fitness.bodyfat') }}" class="block px-4 py-2 hover:bg-gray-100">BodyFat Calculator</a>
                            <a href="{{ route('fitness.ideal') }}" class="block px-4 py-2 hover:bg-gray-100">Ideal Calculator</a>
                            <a href="{{ route('fitness.macros') }}" class="block px-4 py-2 hover:bg-gray-100">Macros Calculator</a>
                        </div>
                    </div>

                    <a href="{{ route('favorites.calculators') }}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">Favorites</a>
                    <a href="{{  route('checkout')  }}" class="transition px-3 py-2 hover:bg-emerald-900 dark:hover:bg-red-500 rounded-md hover:text-white">Pricing</a>
                </nav>
            </div>

            <!-- Right Section: Search + Actions -->
            <div class="flex items-center gap-2 flex-shrink-0 relative">
                <div id="testing" class="">
                    <form action="{{ url('/search') }}" method="GET" class="hidden xl:block">
                        <div class="relative"> <input id="" type="text" placeholder="Search calculators…" class=" sea search-input w-80 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none ring-1 ring-transparent focus:ring-brand/30 dark:bg-slate-800 dark:border-slate-700" /> <span id="" class="absolute cursor-pointer right-2 top-1/2 -translate-y-1/2 text-xs text-slate-500">/</span> </div>
                    </form>
                    <ul id="suggestions" class="suggestion  max-h-[40vh] overflow-y-auto hidden rounded-lg absolute left-2 top-10 bg-gray-100 border border-1px border-emerald-800 text-gray-700">suggestions</ul>
                </div>

                <!-- Theme toggle -->
                <button id="themeToggle" type="button"
                    class="rounded-xl border border-black bg-black/70 px-3 py-2 text-sm hover:border-brand/30 hover:bg-black transition dark:bg-white dark:border-slate-700">
                    🌙
                </button>
                @guest
                <a href="{{ route('login') }}" class="rounded-xl bg-yellow-600 px-4 py-2 text-white text-sm hover:bg-yellow-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="rounded-xl bg-green-700 px-4 py-2 text-white text-sm hover:bg-green-600 transition">
                    Register
                </a>
                @endguest

                @auth
                <a href="{{ url('/logout') }}" class="rounded-xl bg-brand px-4 py-2 text-white text-sm hover:bg-blue-600 transition">
                    Logout
                </a>
                @endauth
            </div>
        </div>
    </header>

    <div id="testing2" class="search-wrapper hidden fixed top-[40vh] left-1/2 -translate-x-1/2 z-[1000000] bg-white/90 dark:bg-slate-800 p-4 rounded-2xl shadow-xl">
        <form action="/search" method="GET" class="block">
            <div class="relative">
                <form action="">
                    <input id="hello" type="text" placeholder="Search calculators…"
                        class="sea search w-80 rounded-xl border border-slate-200 bg-white/70 px-3 py-2 text-sm outline-none ring-1 ring-transparent focus:ring-brand/30 dark:bg-slate-800 dark:border-slate-700" />
                </form>
                <span class="absolute cursor-pointer right-2 top-1/2 -translate-y-1/2 text-xs text-slate-500 close-x">X</span>
            </div>
        </form>
        <ul class="suggestion hidden max-h-[40vh] overflow-y-hidden rounded-lg absolute left-2 top-16 bg-gray-100 border border-emerald-800 text-gray-700"></ul>
    </div>
    <x-simplecalculator />


    <div id="sidebar"
        class="fixed top-0 left-[-100%] z-[40] h-screen w-[85vw] sm:w-[320px]
            bg-gradient-to-b from-slate-800 to-slate-900
            text-white px-5 py-6 shadow-2xl
            transition-all duration-700 ease-in-out">


        <!-- Header -->
        <div class="flex justify-between items-center border-b border-white/20 pb-4 mb-6">
            <img class="w-[60px] object-contain"
                src="{{ asset('images/staticimages/logo_2.png') }}"
                alt="calculator logo" />

            <button class="p-2 rounded-full hover:bg-white/20 transition">
                <svg fill="currentColor" height="22px" viewBox="0 0 20 20" width="22px">
                    <path d="M11.273 10l5.363-5.363a.9.9 0 10-1.273-1.273L10 8.727 
                         4.637 3.364a.9.9 0 10-1.273 1.273L8.727 10
                         l-5.363 5.363a.9.9 0 101.274 1.273L10 11.273
                         l5.363 5.363a.897.897 0 001.274 0
                         .9.9 0 000-1.273L11.275 10z" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="space-y-2 text-sm font-medium">

            <a href="{{ url('/') }}" class="sidebar-item">
                <i class="fa-regular fa-house"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('about.us') }}" class="sidebar-item">
                <i class="fa-regular fa-address-card"></i>
                <span>About</span>
            </a>

            <a href="{{ route('contact.index') }}" class="sidebar-item">
                <i class="fa-regular fa-address-book"></i>
                <span>Contact</span>
            </a>

            <div class="relative">
                <a class="sidebar-item categories-btn">
                    <i class="fa-solid fa-icons"></i>
                    <span>Categories</span>
                </a>
                <div class="categories-menu absolute top-8 left-20 bg-gray-100 text-gray-800 flex flex-col  px-1 py-4 rounded hidden">

                    <a href="{{ route('math.measurement') }}" class="py-2 hover:bg-gray-300 rounded-md px-8 py-1 inline-block">Math and Measurement</a>
                    <a href="{{ route('tax.finance') }}" class="py-2 hover:bg-gray-300 rounded-md px-8 py-1 inline-block">Finance and Tax</a>
                    <a href="{{ route('health.fitness') }}" class="py-2 hover:bg-gray-300 rounded-md px-8 py-1 inline-block">Health and Fitness</a>
                </div>
            </div>

            <a href="#" class="sidebar-item">
                <i class="fa-solid fa-tag"></i>
                <span>Pricing</span>
            </a>

            <a href="{{route('world.time')}}" class="sidebar-item">
                <i class="fa-solid fa-globe"></i>
                <span>Global Time</span>
            </a>

            <a href="{{ route('favorites.calculators') }}" class="sidebar-item">
                <i class="fa-regular fa-heart"></i>
                <span>Favourite</span>
            </a>

        </nav>
    </div>


    <script>
        $(document).ready(function() {

            // Show sidebar
            $("#show-sidebar").on("click", function() {
                $("#sidebar")
                    .removeClass("left-[-100%] opacity-0")
                    .addClass("left-0 opacity-100 ");

                $("body").css("overflow", "hidden");
            });

            // Hide sidebar (close button)
            $("#sidebar button").on("click", function() {
                $("#sidebar")
                    .removeClass("left-0 opacity-100")
                    .addClass("left-[-100%] opacity-0");

                $("body").css("overflow", "");

            });

        });
    </script>