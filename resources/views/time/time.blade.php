<x-app
    :title="'Time Conversion Calculator – Convert Seconds, Minutes, Hours, Days, Weeks & Months | QuickCalculatIt'"
    :des="'QuickCalculatIt Time Conversion Calculator lets you easily convert between seconds, minutes, hours, days, weeks, and months. Perfect for calculating time duration, converting time units, planning schedules, or measuring working hours — fast, simple, and accurate.'"
    :key="'time conversion calculator, time converter, online time converter, seconds to minutes, minutes to hours, hours to days, days to weeks, weeks to months, seconds to hours converter, convert time units, time duration calculator, time difference calculator, working hours calculator, schedule planner tool, convert seconds to hours, convert minutes to days, quick time converter, easy time calculator, time measurement tool, QuickCalculatIt'"
    :titleTwitter="'Time Conversion Calculator – Fast & Accurate Online Time Converter | QuickCalculatIt'" />


<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-300">⏱️</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Time Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between seconds, minutes, hours, days, weeks, and more.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Error --}}
        <div id="error"
            class="hidden mb-4 rounded-xl border border-red-200/70 bg-red-50 text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200 px-3 py-2">
        </div>

        {{-- Converter Form --}}
        <div class="rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur px-5 pt-5 pb-3">
            <div id="time_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="col-span-1">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="time_value" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-rose-400/40">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="time_from"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-rose-400/40">
                        <option value="ns">Nanosecond (ns)</option>
                        <option value="us">Microsecond (µs)</option>
                        <option value="ms">Millisecond (ms)</option>
                        <option value="s" selected>Second (s)</option>
                        <option value="min">Minute (min)</option>
                        <option value="h">Hour (h)</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="mo">Month (avg)</option>
                        <option value="yr">Year (avg)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="time_to"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-rose-400/40">
                        <option value="ns">Nanosecond (ns)</option>
                        <option value="us">Microsecond (µs)</option>
                        <option value="ms">Millisecond (ms)</option>
                        <option value="s">Second (s)</option>
                        <option value="min" selected>Minute (min)</option>
                        <option value="h">Hour (h)</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="mo">Month (avg)</option>
                        <option value="yr">Year (avg)</option>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <button id="btnSaveTime" class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
                    <!-- disk icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                        <path d="M9 5h4v4H9z" />
                    </svg>
                    <span class="ml-1"> Save
                    </span>
                </button>
            </div>
        </div>

        {{-- Result --}}
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center justify-between  rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="time_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="time_toUnit" class="text-sm text-gray-500 dark:text-gray-400">min</span>
                    </div>
                </div>
            </div>
            <button id="btnOpenTimeHistory"
                class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                🕓 History
            </button>
        </div>

        {{-- Conversion Table --}}
        <div class="mt-4 rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-gray-900 dark:text-white">Quick Conversion Table</div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Based on current input</span>
            </div>
            <div class="overflow-x-auto mt-4 rounded-xl border border-gray-300 dark:border-slate-700">
                <table class="min-w-full text-sm">
                    <thead class="bg-yellow-100 dark:bg-slate-900/50 text-gray-900 dark:text-gray-300">
                        <tr>
                            <th class="text-left font-medium py-2 pl-3 pr-6">Unit</th>
                            <th class="text-left font-medium py-2 px-3">Value</th>
                        </tr>
                    </thead>
                    <tbody id="time_tableBody" class="divide-y divide-gray-300 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via your JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Time Guide (useful + concise) --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Time Conversion Guide – Convert Seconds, Minutes, Hours, Days, Weeks & More
            </h2>

            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">
                Understanding time units and how to convert between them is essential for <strong>accurate time calculations</strong> in daily life,
                work, and science. This <strong>Time Conversion Guide</strong> helps you easily convert between
                <strong>seconds, minutes, hours, days, weeks, months, and years</strong> using clear examples and explanations.
                Use it as a reference for scheduling, project management, time tracking, or any <strong>time conversion calculation</strong>.
            </p>

            <div class="grid gap-4 sm:grid-cols-2">
                {{-- Cheat Sheet --}}
                <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Quick Time Conversion Cheat Sheet</div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                        Here’s a quick reference chart for the most common <strong>time unit conversions</strong>.
                        These are exact or average values used by our <strong>Time Conversion Calculator</strong> for accurate results.
                    </p>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li><strong>1 minute (min)</strong> = 60 seconds (s)</li>
                        <li><strong>1 hour (h)</strong> = 60 minutes = 3,600 seconds</li>
                        <li><strong>1 day</strong> = 24 hours = 86,400 seconds</li>
                        <li><strong>1 week</strong> = 7 days = 168 hours</li>
                        <li><strong>1 month (average)</strong> ≈ 30.436875 days ≈ 2,629,746 seconds</li>
                        <li><strong>1 year (average)</strong> ≈ 365.2425 days ≈ 31,556,952 seconds</li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Note: “mo” and “yr” represent <strong>average calendar values</strong> (Gregorian system).
                        Actual months or years may vary slightly based on leap years or month length.
                    </p>
                </div>

                {{-- How conversions are calculated --}}
                <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">How Time Conversions Are Calculated</div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        All time conversions are performed using a consistent <strong>base unit: seconds (s)</strong>.
                        Your entered value is first converted into seconds using a precise conversion factor, and then into the target unit.
                        This ensures <strong>accurate and consistent results</strong> across all units.
                    </p>
                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        <strong>Examples:</strong> 2 hours → 2 × 3,600 = 7,200 seconds → 120 minutes.
                        500 milliseconds (ms) → 0.5 seconds → 0.0083 minutes.
                    </div>
                    <p class="mt-3 text-sm text-gray-700 dark:text-gray-300">
                        Our <strong>Time Conversion Calculator</strong> supports a wide range of time measurements including
                        milliseconds (ms), microseconds (µs), nanoseconds (ns), minutes, hours, days, weeks, months, and years.
                        Whether you’re calculating <strong>working hours, project duration, or time differences</strong>, it provides instant, accurate conversions.
                    </p>
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="mt-4 rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to Use Each Time Unit</div>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                    Knowing when to use each unit of time helps ensure your <strong>time conversion calculations</strong> are meaningful and precise.
                    Here’s a quick breakdown of the most common uses:
                </p>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>ns / µs / ms</strong>: Used in <strong>programming, computing, and electronics</strong> to measure latency or processing time.</li>
                    <li><strong>s / min / h</strong>: Perfect for <strong>timers, sports, workouts, or cooking</strong> durations.</li>
                    <li><strong>day / week</strong>: Common for <strong>schedules, work tracking, or project timelines</strong>.</li>
                    <li><strong>month / year</strong>: Ideal for <strong>contracts, billing cycles, salaries, or long-term planning</strong>. Use averages unless calendar-precise values are needed.</li>
                </ul>
            </div>

            {{-- Summary for SEO --}}
            <div class="mt-4 rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    The <strong>QuickCalculatIt Time Converter</strong> makes it easy to convert between any time units — from <strong>seconds to hours</strong> or <strong>days to weeks</strong> — instantly and accurately.
                    Whether you’re working on <strong>scientific data, time tracking, scheduling, or payroll calculations</strong>, this tool ensures consistent, reliable results.
                    Try our <strong>Time Conversion Calculator</strong> now to simplify your <strong>time measurement and duration conversions</strong>.
                </p>
            </div>
        </div>

    </div>
    <div id="timeHistorySheet" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Time – Full History</h3>
                <button id="closeTimeHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                <ol id="timeHistoryList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div class="my-3" id="time_pagination"></div>

            </div>
            <!-- Sheet footer -->
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeTimeHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>

<x-appfooter />