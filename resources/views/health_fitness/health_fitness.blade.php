<x-app
    :title="'Health & Fitness Calculators – BMI, BMR, TDEE, Body Fat, Ideal Weight & More | QuickCalculatIt'"
    :des="'Calculate your health and fitness metrics quickly and accurately with QuickCalculatIt. Use our free BMI, BMR, TDEE, Body Fat, Ideal Weight, and Macros calculators to track your fitness, nutrition, and weight goals.'"
    :key="'health calculators, fitness calculators, BMI calculator, BMR calculator, TDEE calculator, body fat calculator, ideal weight calculator, macros calculator, calorie calculator, nutrition tools, QuickCalculatIt'" />


    <div class="min-h-[400px] bg-gray-50 dark:bg-slate-900 py-10 px-4">

    <div class="bg-gray-50/80 dark:bg-slate-900/80 backdrop-blur-md mb-1 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                🩺 Health & Fitness Calculators
            </h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto text-gray-600 dark:text-gray-400 mb-10">
        <p class="text-gray-600 dark:text-gray-400 text-sm mx-10 mb-10">
            Improve your wellness and track your fitness with these quick, easy calculators designed for your health goals.
        </p>
    </div>

    <div class="max-w-6xl mx-auto grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <?php

        $cards_info = [
            [
                'logo' => '⚖️',
                'heading' => 'BMI Calculator',
                'text' => 'Calculate your Body Mass Index to determine your weight category and health status.',
                'button' => 'Open BMI Calculator',
                'color' => 'bg-yellow-100 dark:bg-yellow-900/30',
                'url' => 'fitness.bmi',
            ],
            [
                'logo' => '🔥',
                'heading' => 'BMR Calculator',
                'text' => 'Find out your Basal Metabolic Rate — the number of calories you burn at rest each day.',
                'button' => 'Open BMR Calculator',
                'color' => 'bg-red-100 dark:bg-red-900/30',
                'url' => 'fitness.bmr',
            ],
            [
                'logo' => '⚡',
                'heading' => 'TDEE Calculator',
                'text' => 'Estimate your Total Daily Energy Expenditure based on your activity level and BMR.',
                'button' => 'Open TDEE Calculator',
                'color' => 'bg-blue-100 dark:bg-blue-900/30',
                'url' => 'fitness.tdee',
            ],
            [
                'logo' => '🧘',
                'heading' => 'Body Fat Calculator',
                'text' => 'Measure your body fat percentage using height, weight, and body measurements.',
                'button' => 'Open Body Fat Calculator',
                'color' => 'bg-purple-100 dark:bg-purple-900/30',
                'url' => 'fitness.bodyfat',
            ],
            [
                'logo' => '📏',
                'heading' => 'Ideal Weight Calculator',
                'text' => 'Estimate your ideal body weight based on height, gender, and frame size.',
                'button' => 'Open Ideal Weight Calculator',
                'color' => 'bg-green-100 dark:bg-green-900/30',
                'url' => 'fitness.ideal',
            ],
            [
                'logo' => '🥗',
                'heading' => 'Macros Calculator',
                'text' => 'Calculate your daily macronutrient needs — protein, carbs, and fats — for your fitness goal.',
                'button' => 'Open Macros Calculator',
                'color' => 'bg-orange-100 dark:bg-orange-900/30',
                'url' => 'fitness.macros',
            ],
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

                <svg class="heart-solid w-5 h-5  {{ in_array($card['url'], $calculatorNames) ? 'text-red-500' : 'text-slate-500 dark:text-slate-400' }} " viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.645 20.91l-.007-.003C9.19 19.77 2.25 15.58 2.25 8.98c0-3 2.4-5.23 5.25-5.23 1.9 0 3.51.98 4.5 2.45 1-1.47 2.6-2.45 4.5-2.45 2.85 0 5.25 2.23 5.25 5.23 0 6.6-6.94 10.79-9.39 11.93l-.016.007a.75.75 0 01-.699 0z" />
                </svg>
            </a>

            <a href="{{ route( $card['url']) }}"
                class=" block p-5 rounded-xl border border-gray-200 dark:border-slate-700
              bg-white dark:bg-slate-800 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-10 h-10 grid place-items-center rounded-lg {{ $card['color'] }}">{{ $card['logo'] }}</div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $card['heading'] }}</h3>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mx-12">{{ $card['text'] }}</p>
                <button class="mx-12 text-brand text-sm pt-4">{{ $card['button'] }} →</button>
            </a>
        </div>
        @endforeach

    </div>
</div>


<x-appfooter></x-appfooter>