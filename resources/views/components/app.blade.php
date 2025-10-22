<!DOCTYPE html>
<html lang="en" class="scroll-smooth antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $des }}">
    <meta name="keywords" content="{{ $key }}">

    <title>{{ $title  }}</title>

    <!-- Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        /* Base style */
        .form-control {
            width: 100%;
            border-radius: .5rem;
            border: 1px solid #cbd5e1;
            background-color: #fff;
            color: #0f172a;
            padding: .5rem .75rem;
            font-size: .9rem;
            outline: none;
            appearance: none;
            /* removes native arrow */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-position: right .6rem center;
            background-repeat: no-repeat;
            background-size: 16px 16px;
            padding-right: 2rem;
            /* room for arrow */
            line-height: 1.4;
            cursor: pointer;
        }

        /* Light mode arrow */
        .light select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2367748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E<path d='M6 9l6 6 6-6'/></svg>");

        }

        /* Dark mode variant */
        .dark .form-control {
            border-color: #334155;
            background-color: #0f172a;
            color: #e2e8f0;

            /* arrow with light stroke for contrast */
        }

        /* Optional: dropdown list background too */
        .dark select.form-control option {
            background-color: #0f172a;
            color: #e2e8f0;
        }

        .bmiselect {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E<path d='M6 9l6 6 6-6'/></svg>");

        }

        /* Optional: brand color if you don’t have one in Tailwind config */
        .text-brand {
            color: #2563eb;
        }

        .bg-brand {
            background-color: #2563eb;
        }

        /* Smooth transforms look better with this easing */
        #calcPanel {
            transition-timing-function: cubic-bezier(.2, .7, .2, 1);
        }

        .tab {
            padding: .4rem .8rem;
            border-radius: .5rem;
            font-size: .875rem;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .tab.active {
            background: #f1f5f9;
            border-color: #cbd5e1;
            font-weight: 600;
        }

        .dark .tab.active {
            background: #1e293b;
            border-color: #334155;
        }

        .form-control {
            width: 100%;
            border-radius: .5rem;
            border: 1px solid #cbd5e1;
            padding: .5rem .75rem;
            font-size: .875rem;
            outline: none;
        }

        .form-control:focus {
            border-color: #2563eb;
            /* ring:2px; */
        }

        .dark .form-control {
            border-color: #334155;
            color: #e2e8f0;
        }

        /* //dsfjdklfdslkfjdlskfjsdklfjsdklfjldkfjlkdjfldskjf */
        html.modal-open {
            overflow: hidden;
        }

        .modal {
            position: fixed;
            inset: 0;
            display: none;
        }

        .modal.is-open {
            display: block;
            z-index: 60;
        }

        /* base */
        .modal[data-level="2"] {
            z-index: 70;
        }

        /* stacked */
        .modal[data-level="3"] {
            z-index: 80;
        }

        .modal__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            backdrop-filter: blur(2px);
            opacity: 0;
            transition: opacity .25s ease;
        }

        .modal.is-open .modal__backdrop {
            opacity: 1;
        }

        .modal__panel {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .modal__card {
            margin-top: 2.5rem;
            /* sm:mt-0 if you want */
            width: min(960px, 95vw);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, .2);
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
            opacity: 0;
            transform: translateY(12px) scale(.98);
            transition: opacity .25s ease, transform .25s ease;
        }

        .dark .modal__card {
            background: rgba(2, 6, 23, .9);
        }

        .modal.is-open .modal__card {
            opacity: 1;
            transform: none;
        }

        #popupMortgageCalculator {
            position: fixed;
            inset: 0;
            z-index: 60;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Optional: Apply blur effect */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Modal content */
        .popup-content {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            max-width: 95vw;
            /* Ensure the modal does not exceed the screen width */
            max-height: 80vh;
            /* Limit the height to 80% of the screen */
            overflow-y: auto;
            /* Make content scrollable */
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            /* Optional: Add shadow for a floating effect */
        }

        /* Optional: Smooth scrolling */
        .popup-content {
            scroll-behavior: smooth;
        }

        /* Modal Close Button */
        .close-popup {
            font-size: 24px;
            color: #555;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .close-popup:hover {
            color: #000;
        }

        /* Ensure the modal is hidden by default */
        #popupMortgageCalculator {
            display: none;
            /* Make sure the modal is hidden initially */
        }

        /* Show modal when 'hidden' class is removed */
        #popupMortgageCalculator:not(.hidden) {
            display: flex;
        }

        table {
            width: 100%;
        }

        tr,
        td,
        th {
            text-align: center !important;
        }

        /* ---------- Skin (Light) ---------- */
        .scroll-skin {
            --scroll-thumb: rgba(100, 116, 139, .6);
            /* slate-500/60 */
            --scroll-thumb-hover: rgba(71, 85, 105, .8);
            /* slate-600/80 */
            --scroll-track: rgba(241, 245, 249, .9);
            /* slate-100/90 */
        }

        /* ---------- Skin (Dark) ---------- */
        .dark .scroll-skin {
            --scroll-thumb: rgba(148, 163, 184, .5);
            /* slate-400/50 */
            --scroll-thumb-hover: rgba(203, 213, 225, .6);
            /* slate-300/60 */
            --scroll-track: rgba(17, 24, 39, .85);
            /* gray-900/85 */
        }

        /* Apply on any scrollable element (y/x/auto) */
        .scroll-area {
            /* Firefox */
            scrollbar-width: thin;
            scrollbar-color: var(--scroll-thumb) var(--scroll-track);
            scrollbar-gutter: stable both-edges;
        }

        /* ---------- WebKit/Chromium ---------- */
        .scroll-area::-webkit-scrollbar {
            width: 10px;
            /* vertical */
            height: 10px;
            /* horizontal */
        }

        .scroll-area::-webkit-scrollbar-track {
            background: var(--scroll-track);
            border-radius: 9999px;
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background-color: var(--scroll-thumb);
            border-radius: 9999px;
            border: 2px solid transparent;
            /* thinner look */
            background-clip: content-box;
        }

        .scroll-area:hover::-webkit-scrollbar-thumb {
            background-color: var(--scroll-thumb-hover);
        }

        /* Optional: only-horizontal areas (tables, carousels) */
        .scroll-area-x {
            overflow-x: auto;
            overflow-y: hidden;
        }

        .scroll-area-y {
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
    <!-- Tailwind (CDN) + theme tokens -->
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
        /* numeric tabs look better with tabular lining; Inter already good */
        .num {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>

<body class="bg-bg text-base dark:bg-slate-900 dark:text-slate-100">

    <!-- Header -->
    <header class="sticky top-0 z-40 border-b border-white/10 bg-white/70 backdrop-blur-md dark:bg-slate-900/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- LOGO -->
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="text-brand grid place-items-center font-extrabold">
                        <img width="55px" src=" {{ asset('images/staticimages/logo_2.png') }}" alt="Logo">
                    </div>
                    <span class="font-extrabold tracking-tight text-head dark:text-white"></span>
                </a>
                <!-- Nav -->
                <style>
                    .dropdown-content {
                        display: none;
                    }

                    .show {
                        display: block;
                    }

                    #categories-menu {
                        z-index: 50;
                        background-color: white;
                        color: black;
                        transition: all 0.2s ease-in-out;
                    }

                    #categories-btn.active #caret-icon {
                        transform: rotate(180deg);
                    }
                </style>
                <nav class="hidden md:flex items-center gap-4 text-sm relative">
                    <a href="{{ url('/') }}" class="hover:text-brand transition">Home</a>
                    <a href="{{ url('/calculators') }}" class="hover:text-brand transition">Calculators</a>

                    <div class="relative">
                        <button id="categories-btn" class="hover:text-brand transition flex items-center gap-1">
                            Categories
                            <svg class="w-4 h-4 transition-transform" id="caret-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="categories-menu"
                            class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-md hidden">
                            <a href="{{ route('tax.finance') }}" class="block px-4 py-2 hover:bg-gray-100">Finance & Tax</a>
                            <a href="{{ route('math.measurement') }}" class="block px-4 py-2 hover:bg-gray-100">Math & Measurement</a>
                            <a href="{{ route('health.fitness') }}" class="block px-4 py-2 hover:bg-gray-100">Health & Fitness</a>
                        </div>
                    </div>

                    <a href="{{ route('favorites.calculators') }}" class="hover:text-brand transition">Favorites</a>
                    <a href="{{ url('/history') }}" class="hover:text-brand transition">History</a>
                    <a href="{{ url('/docs') }}" class="hover:text-brand transition">Docs</a>
                    <a href="{{ url('/pricing') }}" class="hover:text-brand transition">Pricing</a>
                </nav>

            </div>

            <!-- Search + actions -->
            <div class="flex items-center gap-3">
                <form action="{{ url('/search') }}" method="GET" class="hidden lg:block">
                    <div class="relative">
                        <input id="searchs" type="text" placeholder="Search calculators…" class=" search-input w-80 rounded-xl border border-slate-200 bg-white/70 px-3 py-2 text-sm outline-none ring-1 ring-transparent focus:ring-brand/30 dark:bg-slate-800 dark:border-slate-700" />
                        <span class="absolute right-2 top-1/2 -translate-y-1/2 text-xs text-slate-500">/</span>
                    </div>
                </form>

                <!-- Theme toggle -->
                <button id="themeToggle" type="button" class="rounded-xl border border-slate-200 bg-white/70 px-3 py-2 text-sm hover:border-brand/30 hover:bg-white transition dark:bg-slate-800 dark:border-slate-700">
                    🌙
                </button>

                @guest
                <a href="{{ route('login') }}" class="rounded-xl bg-brand px-4 py-2 text-white text-sm hover:bg-blue-600 transition">
                    Login
                </a>
                @endguest

                @auth
                <a href="{{ url('/logout') }}" class="rounded-xl bg-brand px-4 py-2 text-white text-sm hover:bg-blue-600 transition">Logout</a>
                @endauth

            </div>
        </div>
    </header>
    <x-simplecalculator />