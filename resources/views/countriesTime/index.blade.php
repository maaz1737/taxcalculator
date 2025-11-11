<x-app
    title="'World Countries Current Time Calculator – Live Global Time & Time Zone Converter"
    des="'Check the current time in all world countries with our live global time calculator. View accurate country time zones, compare international time differences, and convert time instantly for any location worldwide.'"
    key="'world countries current time, global time calculator, world time converter, current time in all countries, international time zones, live global clock, world time zone calculator, current country time, time conversion across countries, world time difference tool'" />



<main class="min-h-[60vh] bg-emerald-50 text-black dark:bg-slate-900 dark:text-white">
    <div class=" py-10 px-4 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-center mt-4">
            World Countries Current Time Calculator – Live Global Time
        </h1>
        <p class="text-center mt-2 max-w-2xl mx-auto text-gray-700 dark:text-gray-300">
            Explore the current time in various countries around the world with our live time calculator. Instantly check and compare the local time of different nations, including major cities, and convert your local time to any country's timezone with ease.

            <?php
            $countries = [
                [
                    'name' => 'New York Current time',
                    'summary' => 'Check the current time in New York City, USA, with our live time calculator. Stay updated with accurate local time and timezone information for New York.',
                    'route' => 'newyork.time'
                ],
                [
                    'name' => 'Australia Current time',
                    'summary' => 'Get the current time in Australia with our live time calculator. View accurate local time and timezone details for cities across Australia, including Sydney, Melbourne, and Brisbane.',
                    'route' => 'australia.time'
                ],
                [
                    'name' => 'Japan Current Time',
                    'summary' => 'Get the current time in Japan with our live time calculator. View accurate local time and timezone details for major cities including Tokyo, Osaka, Kyoto, Hiroshima, and Nagasaki.',
                    'route' => 'japan.time'
                ],

                [
                    'name' => 'Nepal Current Time',
                    'summary' => 'Get the current time in Nepal with our live time calculator. View accurate local time and timezone details for major cities including Kathmandu, Pokhara, Biratnagar, and Lalitpur.',
                    'route' => 'nepal.time'
                ],
                [
                    'name' => 'Saudi Arabia Current Time',
                    'summary' => 'Get the current time in Saudi Arabia with our live time calculator. View accurate local time and timezone details for major cities including Riyadh, Jeddah, Mecca, and Medina.',
                    'route' => 'saudia.arabia.time'
                ],
                [
                    'name' => 'UAE Current Time',
                    'summary' => 'Get the current time in United Arab Emirates (UAE) with our live time calculator. View accurate local time and timezone details for major cities including Dubai, Abu Dhabi, Sharjah, and Ajman.',
                    'route' => 'uae.time'
                ],
                [
                    'name' => 'India Current Time',
                    'summary' => 'Get the current time in India with our live time calculator. View accurate local time and timezone details for major cities including New Delhi, Mumbai, Bangalore, and Chennai.',
                    'route' => 'india.time'
                ],
                [
                    'name' => 'pakistan Current Time',
                    'summary' => 'Get the current time in Pakistan with our live time calculator. View accurate local time and timezone details for major cities including Islamabad, Karachi, Lahore, and Faisalabad.',
                    'route' => 'pakistan.time'
                ],
                [
                    'name' => 'bhutan Current Time',
                    'summary' => 'Get the current time in Bhutan with our live time calculator. View accurate local time and timezone details for major cities including Thimphu, Paro, and Phuntsholing.',
                    'route' => 'bhutan.time'
                ],
                [
                    'name' => 'Bangladesh Current Time',
                    'summary' => 'Get the current time in Bangladesh with our live time calculator. View accurate local time and timezone details for major cities including Dhaka, Chittagong, Khulna, and Sylhet.',
                    'route' => 'bangladesh.time'
                ],
                [
                    'name' => 'California Current Time',
                    'summary' => 'Get the current time in California, USA with our live time calculator. View accurate local time and timezone details for major cities including Los Angeles, San Francisco, San Diego, and Sacramento.',
                    'route' => 'california.time'
                ]

            ];

            ?>


        <div class="border bg-red-100/30 border-1 border-red-300 my-8 rounded-lg p-4 shadow-card dark:bg-slate-800 dark:border-slate-700 dark:text-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @foreach ($countries as $country)
                <a href="{{ route($country['route']) }}" class="group rounded-xl border  border-red-300 bg-red-100 p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                    <h1 class="font-semibold">{{ $country['name'] }}</h1>
                    <div class="text-xs text-slate-500">{{ $country['summary'] }}</div>
                    <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
                </a>
                @endforeach

            </div>
        </div>


    </div>
</main>






<x-appfooter />