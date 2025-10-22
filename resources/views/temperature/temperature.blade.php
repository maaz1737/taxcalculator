<x-app
    :title="'Temperature Converter – Convert Celsius, Fahrenheit & Kelvin | QuickCalculatIt'"
    :des="'QuickCalculatIt Temperature Converter lets you convert between Celsius, Fahrenheit, and Kelvin quickly and accurately.'"
    :key="'temperature converter, Celsius to Fahrenheit, Kelvin converter, QuickCalculatIt'" />

    
<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-300">🌡️</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Temperature Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between Celsius (°C), Fahrenheit (°F), and Kelvin (K).</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Converter Form --}}
        <div class="rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div id="temperature_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <div class="col-span-1">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="temperature_value" type="number" step="any" value="0"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-cyan-400/40">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="temperature_from"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-cyan-400/40">
                        <option value="C" selected>Celsius (°C)</option>
                        <option value="K">Kelvin (K)</option>
                        <option value="F">Fahrenheit (°F)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="temperature_to"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-cyan-400/40">
                        <option value="C">Celsius (°C)</option>
                        <option value="K">Kelvin (K)</option>
                        <option value="F" selected>Fahrenheit (°F)</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button id="btnSaveTemperature" class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
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
        </div>

        {{-- Result --}}
        <div class="mt-4 rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="temperature_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="temperature_toUnit" class="text-sm text-gray-500 dark:text-gray-400">°F</span>
                    </div>
                </div>


                <button id="btnOpenTemperatureHistory"
                    class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                    🕓 History
                </button>
            </div>

        </div>

        {{-- Quick Conversion Table --}}
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
                    <tbody id="temperature_tableBody" class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via your JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Temperature Guide (concise & useful) --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Temperature Conversion Guide</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                {{-- Formulas card --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Core Formulas</div>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li><strong>K</strong> = <strong>°C</strong> + 273.15</li>
                        <li><strong>°F</strong> = (<strong>°C</strong> × 9/5) + 32</li>
                        <li><strong>°C</strong> = (<strong>°F</strong> − 32) × 5/9</li>
                        <li><strong>°C</strong> = <strong>K</strong> − 273.15</li>
                        <li><strong>°F</strong> = (<strong>K</strong> − 273.15) × 9/5 + 32</li>
                        <li><strong>K</strong> = (<strong>°F</strong> − 32) × 5/9 + 273.15</li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Tip: Kelvin starts at absolute zero (no negative K). Celsius and Fahrenheit can be negative.
                    </p>
                </div>

                {{-- Examples card --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Quick Examples</div>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li><strong>0 °C → °F</strong>: (0 × 9/5) + 32 = <strong>32 °F</strong></li>
                        <li><strong>100 °C → °F</strong>: (100 × 9/5) + 32 = <strong>212 °F</strong></li>
                        <li><strong>25 °C → K</strong>: 25 + 273.15 = <strong>298.15 K</strong></li>
                        <li><strong>68 °F → °C</strong>: (68 − 32) × 5/9 = <strong>20 °C</strong></li>
                        <li><strong>300 K → °C</strong>: 300 − 273.15 = <strong>26.85 °C</strong></li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Mental math: <em>°F ≈ °C × 2 + 30</em> (rough rule) — good for quick estimates.
                    </p>
                </div>
            </div>

            {{-- When to use which scale --}}
            <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to use which scale</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>Celsius (°C):</strong> everyday weather & most countries (metric).</li>
                    <li><strong>Fahrenheit (°F):</strong> everyday weather in the United States.</li>
                    <li><strong>Kelvin (K):</strong> science & engineering (absolute scale, no degrees symbol).</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="temperatureHistorySheet" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Temperature – Full History</h3>
                <button id="closeTemperatureHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="p-5 scroll-area overflow-y-auto max-h-[70vh]">
                <ol id="temperatureHistoryList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div id="temPager" class="flex flex-wrap items-center gap-2 my-2">
                    <button id="temPrev" class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 disabled:opacity-50">«</button>

                    <!-- numbered page buttons will be injected here -->
                    <div id="temPages" class="inline-flex flex-wrap items-center gap-1"></div>

                    <button id="temNext" class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 disabled:opacity-50">»</button>


                </div>
                <div class="px-5 py-2 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                    <button id="closeTemperatureHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
                </div>
            </div>
        </div>
    </div>

    <x-appfooter />