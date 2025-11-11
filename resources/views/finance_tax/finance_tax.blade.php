<x-app
    :title="'Finance & Tax Calculators – Salary, Tax, Rent, Mortgage, Depreciation & More | QuickCalculatIt'"
    :des="'QuickCalculatIt provides free online finance and tax calculators. Easily calculate your salary, taxes, rent, mortgage payments, depreciation, and other financial metrics with accuracy and speed.'"
    :key="'finance calculators, tax calculator, salary calculator, rent calculator, mortgage calculator, depreciation calculator, financial tools, online calculators, QuickCalculatIt'" />

<div class="min-h-[400px] bg-gray-50 dark:bg-slate-900 py-10 px-4">

    <div class=" bg-gray-50/80 dark:bg-slate-900/80 backdrop-blur-md  mb-1 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                💰 Finance & Tax Calculators
            </h1>
        </div>
    </div>

    {{-- Intro --}}
    <div class="max-w-6xl mx-auto text-gray-600 dark:text-gray-400 mb-12">
        <p class="text-sm mx-10">Manage your money smarter with our easy-to-use financial and tax tools — from rent calculations to salary and mortgage estimations.</p>
    </div>

    <div class="max-w-6xl mx-auto grid gap-6 sm:grid-cols-2 lg:grid-cols-3">


        <?php


        $cards_info = [
            ['id' => 1, 'url' => 'finance.income_tax', 'logo' => '💸', 'heading' => 'Tax Calculator', 'text' => 'Estimate your income tax based on salary, deductions, and the current year’s tax slabs.', 'button' => 'Open Tax calculator', 'color' => 'bg-blue-100 
                            dark:bg-blue-900/30'],
            ['id' => 2, 'url' => 'finance.salary', 'logo' => '💼', 'heading' => 'Salary Calculator', 'text' => 'Calculate your net salary, tax deductions, and take-home pay after withholdings.', 'button' => 'Open Salary calculator', 'color' => 'bg-yellow-100 
                            dark:bg-yellow-900/30'],
            ['id' => 3, 'url' => 'finance.rent', 'logo' => '🏠', 'heading' => 'Rent Calculator', 'text' => 'Split rent fairly or calculate your total rent share including utilities and taxes.', 'button' => 'Open Rent calculator', 'color' => 'bg-red-100 
                            dark:bg-red-900/30'],
            ['id' => 4, 'url' => 'finance.depreciation', 'logo' => '📉', 'heading' => 'Depreciation Calculator', 'text' => 'Determine asset depreciation under straight-line, double-declining, or sum-of-years methods.', 'button' => 'Open Depreciation calculator', 'color' => 'bg-purple-100 
                            dark:bg-purple-900/30'],
            ['id' => 5, 'url' => 'finance.mortgage', 'logo' => '🏠', 'heading' => 'Mortgage Calculator', 'text' => 'Easily calculate accurate monthly payments and total interest to plan your mortgage confidently and make smarter financial decisions', 'button' => 'Open Mortgage calculator', 'color' => 'bg-green-100 
                            dark:bg-green-900/30'],

        ];

        ?>

        @foreach ($cards_info as $card)

        <div class="filter-card relative group">
            <a type="button"
                class="fav-btn absolute top-3 right-3 z-10 rounded-full border border-gray-200 dark:border-slate-700
                   bg-white/90 dark:bg-slate-900/90 p-2 shadow-sm hover:shadow transition
                   hover:scale-105"
                title="Add to favorites"
                data-id="{{ $card['url'] ?? '' }}"
                data-name="{{ $card['heading'] ?? '' }}"
                data-text="{{ $card['text'] ?? '' }}">

                <svg class="heart-solid w-5 h-5  {{ in_array($card['url'], $calculatorNames) ? 'text-red-500' : 'text-slate-500 dark:text-slate-400' }}" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.645 20.91l-.007-.003C9.19 19.77 2.25 15.58 2.25 8.98c0-3 2.4-5.23 5.25-5.23 1.9 0 3.51.98 4.5 2.45 1-1.47 2.6-2.45 4.5-2.45 2.85 0 5.25 2.23 5.25 5.23 0 6.6-6.94 10.79-9.39 11.93l-.016.007a.75.75 0 01-.699 0z" />
                </svg>
            </a>
            <a href="{{ route($card['url']) }}"
                class="block p-5 rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 
                  hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg {{$card['color']}} ">{{$card['logo']}}</div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{$card['heading']}}</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mx-12">
                    {{$card['text']}}
                </p>
                <button class="mx-12 text-brand text-sm pt-4">{{$card['button']}} →</button>
            </a>
        </div>

        @endforeach

    </div>
</div>


<x-appfooter></x-appfooter>