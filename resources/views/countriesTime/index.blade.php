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


        <div class="border bg-red-100/30 border-1 border-red-300 my-8 rounded-lg p-4 shadow-card dark:bg-slate-800 dark:border-slate-700 dark:text-gray-200">
            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                <a href="{{ route('newyork.time') }}" class="group rounded-xl border  border-red-300 bg-red-100 p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                    <div class="font-semibold">New York</div>
                    <div class="text-xs text-slate-500">New York current time</div>
                    <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
                </a>
                <a href="{{ route('australia.time') }}" class="group rounded-xl border  border-red-300 bg-red-100 p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                    <div class="font-semibold">Australia</div>
                    <div class="text-xs text-slate-500">Australia</div>
                    <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
                </a>
            </div>
        </div>


    </div>
</main>






<x-appfooter />