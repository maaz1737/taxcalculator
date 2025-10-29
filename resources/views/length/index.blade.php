<x-app
    :title="'Length Converter – Convert Meters, Kilometers, Inches & More | QuickCalculatIt'"
    :des="'QuickCalculatIt Length Converter helps you convert between meters, kilometers, inches, feet, yards, and miles quickly and accurately.'"
    :key="'length converter, distance converter, meters to feet, kilometers to miles, QuickCalculatIt'" />


<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">📏</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Length Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between mm, cm, m, km, inches, feet, yards, and miles.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Inputs --}}
        <div class="relative rounded-2xl border border-gray-200 bg-white/80 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur px-5 pt-5 pb-4">
            <div id="Length_errors"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                ddd
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-6 gap-5 items-end">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="value" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-400/40">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="from"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-400/40">
                        <option value="mm">Millimeter (mm)</option>
                        <option value="cm">Centimeter (cm)</option>
                        <option value="m" selected>Meter (m)</option>
                        <option value="km">Kilometer (km)</option>
                        <option value="in">Inch (in)</option>
                        <option value="ft">Foot (ft)</option>
                        <option value="yd">Yard (yd)</option>
                        <option value="mi">Mile (mi)</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="to"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-400/40">
                        <option value="mm">Millimeter (mm)</option>
                        <option value="cm">Centimeter (cm)</option>
                        <option value="m">Meter (m)</option>
                        <option value="km">Kilometer (km)</option>
                        <option value="in" selected>Inch (in)</option>
                        <option value="ft">Foot (ft)</option>
                        <option value="yd">Yard (yd)</option>
                        <option value="mi">Mile (mi)</option>
                    </select>
                </div>

                <div class="">
                    <button id="btnSaveLengthss"
                        class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                            <path d="M9 5h4v4H9z" />
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        </div>

        {{-- Result --}}
        <div class="mt-5 flex flex-col gap-2 sm:flex-row sm:items-center justify-between rounded-2xl border border-gray-200 bg-gradient-to-b from-white/90 to-gray-50/70 dark:from-slate-800/90 dark:to-slate-900/70 shadow-sm backdrop-blur px-5 py-5">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center justify-between mb-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="toUnit" class="text-sm text-gray-500 dark:text-gray-400">in</span>
                    </div>
                </div>


            </div>
            <button id="openHistory"
                class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                🕓 History
            </button>
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
                    <tbody id="tableBody" class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via your JS --}}
                    </tbody>
                </table>
            </div>
        </div>


        {{-- Related --}}
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <span class="text-xs font-medium px-2 py-1 rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">Related</span>
            <a href="{{ route('weight') }}" class="text-sm text-violet-700 hover:underline dark:text-violet-300"> Weight Calculator</a>
            <span class="text-gray-400">•</span>
            <a href="{{ route('area') }}" class="text-sm text-violet-700 hover:underline dark:text-violet-300">Area Calculator</a>
        </div>

        {{-- Length Guide (practical & concise) --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Length Conversion Guide</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                {{-- Cheat Sheet --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Cheat Sheet</div>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li>1 m = 100 cm = 1,000 mm</li>
                        <li>1 km = 1,000 m</li>
                        <li>1 in = 2.54 cm (exact)</li>
                        <li>1 ft = 12 in = 0.3048 m (exact)</li>
                        <li>1 yd = 3 ft = 0.9144 m (exact)</li>
                        <li>1 mi = 5,280 ft ≈ 1.609344 km (exact definition)</li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Exact SI ties: inch, foot, yard, and mile are defined via the meter, so conversions are precise.
                    </p>
                </div>

                {{-- How conversions are calculated --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">How it’s calculated</div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        We convert through a base unit: <strong>meter (m)</strong>. Your input converts to meters with an exact factor,
                        then meters convert to the target unit. This keeps results consistent (e.g., <em>ft → m → in</em>).
                    </p>
                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Examples: 10 ft → 10 × 0.3048 = 3.048 m → 120 in. &nbsp; 25 cm → 0.25 m → 9.84252 in.
                    </div>
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to use which unit</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>mm / cm</strong>: small parts, woodworking tolerances, product specs.</li>
                    <li><strong>m / km</strong>: everyday metric, road distances.</li>
                    <li><strong>in / ft / yd</strong>: construction, furniture, US/UK specs.</li>
                    <li><strong>mi</strong>: long road distances in US/UK.</li>
                </ul>
            </div>


        </div>
    </div>
    <div id="historySheet" class=" scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Length – Full History</h3>
                <button id="closeHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                <!-- Example content; replace with your real history -->
                <ol id="historyList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>

                <div class="my-3" id="length_pagination"></div>

            </div>
            <!-- Sheet footer -->
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>

<x-appfooter></x-appfooter>