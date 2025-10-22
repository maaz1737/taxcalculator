<x-app
    :title="'Time Converter – Convert Seconds, Minutes, Hours, Days & More | QuickCalculatIt'"
    :des="'QuickCalculatIt Time Converter helps you convert between seconds, minutes, hours, days, and other time units accurately and quickly.'"
    :key="'time converter, seconds to minutes, hours converter, days calculator, QuickCalculatIt'" />

<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-10">
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
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Error --}}
        <div id="error"
            class="hidden mb-4 rounded-xl border border-red-200/70 bg-red-50 text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200 px-3 py-2">
        </div>

        {{-- Converter Form --}}
        <div class="rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur px-5 pt-5 pb-3">
            <div id="time_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="col-span-1">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="time_value" type="number" step="any" value="1"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-rose-400/40">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="time_from"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
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
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
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
        <div class="mt-4 rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="time_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="time_toUnit" class="text-sm text-gray-500 dark:text-gray-400">min</span>
                    </div>
                </div>
                <button id="btnOpenTimeHistory"
                    class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                    🕓 History
                </button>
            </div>
        </div>

        {{-- Conversion Table --}}
        <div class="mt-4 rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-gray-900 dark:text-white">Quick Conversion Table</div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Based on current input</span>
            </div>
            <div class="overflow-x-auto mt-4 rounded-xl border border-gray-100 dark:border-slate-700">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-slate-900/50 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="text-left font-medium py-2 pl-3 pr-6">Unit</th>
                            <th class="text-left font-medium py-2 px-3">Value</th>
                        </tr>
                    </thead>
                    <tbody id="time_tableBody" class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via your JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Time Guide (useful + concise) --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Time Conversion Guide</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                {{-- Cheat Sheet --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Cheat Sheet</div>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li>1 min = 60 s</li>
                        <li>1 h = 60 min = 3,600 s</li>
                        <li>1 day = 24 h = 86,400 s</li>
                        <li>1 week = 7 days</li>
                        <li>1 month (avg) ≈ 30.436875 days ≈ 2,629,746 s</li>
                        <li>1 year (avg) ≈ 365.2425 days ≈ 31,556,952 s</li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Note: “mo” and “yr” are **averages** (Gregorian). Exact calendar months/years can vary.
                    </p>
                </div>

                {{-- How conversions are calculated --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">How it’s calculated</div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        We convert via a base unit: <strong>seconds (s)</strong>. Your input is first turned into seconds with a precise factor,
                        then seconds are converted to the target unit. This keeps results consistent across all units.
                    </p>
                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Examples: 2 h → 2 × 3,600 = 7,200 s → 120 min. &nbsp; 500 ms → 0.5 s → 0.008333… min.
                    </div>
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to use which unit</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>ns/µs/ms</strong>: benchmarks, latency, electronics.</li>
                    <li><strong>s/min/h</strong>: timers, workouts, cooking.</li>
                    <li><strong>day/week</strong>: schedules, projects.</li>
                    <li><strong>mo/yr</strong>: contracts, billing, long spans (use averages unless calendar-precise).</li>
                </ul>
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