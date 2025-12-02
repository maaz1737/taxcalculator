<x-app
    :title="'Favourite Calculator | Save & Access Your Favorite Online Calculators'"
    :des="'Access and manage all your favorite online calculators in one place. Quickly save, edit, and use calculators for math, finance, tax, and more.'"
    :key="'favourite calculator, online calculators, save calculators, math tools, finance calculators, tax calculators, quick access calculators'" />

@auth

<div class="min-h-[400px] bg-emerald-50 dark:bg-slate-900/70 py-10 px-4">

    <div class=" bg-gray-50/80 dark:bg-slate-900/80 backdrop-blur-md  mb-1 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                💰 Your Favourite Calculators
            </h1>
        </div>
    </div>

    {{-- Intro --}}
    <div class="max-w-6xl mx-auto text-gray-600 dark:text-gray-400 mb-12">
        <p class="text-sm mx-10">Manage your money smarter with our easy-to-use financial and tax tools — from rent calculations to salary and mortgage estimations.</p>
    </div>



    <div class="max-w-6xl mx-auto grid gap-6 sm:grid-cols-2 lg:grid-cols-3">




        @foreach ($calculators as $calculator)

        <div class="filter-card relative group">
            <a type="button"
                class="fav-btn absolute top-3 right-3 z-10 rounded-full border border-gray-200 dark:border-slate-700
                   bg-white/90 dark:bg-slate-900/90 p-2 shadow-sm hover:shadow transition
                   hover:scale-105"
                title="Add to favorites"
                data-id="{{ $calculator['name'] ?? '' }}"
                data-name="{{ $calculator['title'] ?? '' }}"
                data-text="{{ $calculator['text'] ?? '' }}">
                <svg class="heart-solid w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.645 20.91l-.007-.003C9.19 19.77 2.25 15.58 2.25 8.98c0-3 2.4-5.23 5.25-5.23 1.9 0 3.51.98 4.5 2.45 1-1.47 2.6-2.45 4.5-2.45 2.85 0 5.25 2.23 5.25 5.23 0 6.6-6.94 10.79-9.39 11.93l-.016.007a.75.75 0 01-.699 0z" />
                </svg>
            </a>
            <a href="{{route($calculator['name'])}}"
                class="block p-5 rounded-xl border min-h-[200px] border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 
                  hover:shadow-md hover:-translate-y-1 transition-all duration-200 grid grid-row-3">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg  "></div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{$calculator['title']}}</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mx-12">
                    {{$calculator['text']}}
                </p>
                <button class="mx-12 px-0 text-brand text-sm pt-4">Open {{$calculator['title']}} →</button>
            </a>
        </div>

        @endforeach

    </div>
</div>
@endauth


@guest
<div class="min-h-[calc(100vh-400px)] flex justify-center items-center bg-emerald-50 dark:bg-slate-900/70">

    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
        Login To Use your favourite calculator
    </h1>

</div>
@endguest


<x-appfooter></x-appfooter>