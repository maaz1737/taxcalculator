<x-app
    :title="'Weight Converter – Convert Kilograms, Pounds, Grams, Ounces & Stones Instantly | QuickCalculatIt'"
    :des="'Use QuickCalculatIt Weight Converter to easily convert between kilograms, pounds, grams, ounces, and stones with instant and accurate results. Perfect for cooking, fitness, and scientific measurements. Simplify your weight and mass conversions online for free.'"
    :key="'weight converter, kilograms to pounds, grams to ounces, kg to lbs, lbs to kg, ounces to grams, mass converter, online weight converter, body weight converter, metric to imperial, QuickCalculatIt weight calculator, free weight conversion tool'"
    :titleTwitter="'Weight Converter – Convert kg, lbs, grams, ounces & stones instantly | QuickCalculatIt'" />

<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-300">⚖️</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Weight Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between grams, kilograms, pounds, ounces, stones, tons, and more.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>


        {{-- Converter Inputs --}}
        <div class="relative rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm px-5 pt-5 pb-3">
            <div id="weight_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="weight_value" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="weight_from"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
                        <option value="ug">Microgram (µg)</option>
                        <option value="mg">Milligram (mg)</option>
                        <option value="g">Gram (g)</option>
                        <option value="kg" selected>Kilogram (kg)</option>
                        <option value="t">Metric Tonne (t)</option>
                        <option value="ct">Carat (ct)</option>
                        <option value="oz">Ounce (oz)</option>
                        <option value="lb">Pound (lb)</option>
                        <option value="st">Stone (st)</option>
                        <option value="ton_us">US Ton (short)</option>
                        <option value="ton_uk">UK Ton (long)</option>
                        <option value="gr">Grain (gr)</option>
                        <option value="dr">Dram (avdp)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="weight_to"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
                        <option value="ug">Microgram (µg)</option>
                        <option value="mg">Milligram (mg)</option>
                        <option value="g">Gram (g)</option>
                        <option value="kg">Kilogram (kg)</option>
                        <option value="t">Metric Tonne (t)</option>
                        <option value="ct" selected>Carat (ct)</option>
                        <option value="oz">Ounce (oz)</option>
                        <option value="lb">Pound (lb)</option>
                        <option value="st">Stone (st)</option>
                        <option value="ton_us">US Ton (short)</option>
                        <option value="ton_uk">UK Ton (long)</option>
                        <option value="gr">Grain (gr)</option>
                        <option value="dr">Dram (avdp)</option>
                    </select>
                </div>
            </div>

            {{-- Action --}}
            <div class="mt-5">
                <button id="btnSaveWeight" class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
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
        <div class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-center justify-between  rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:from-slate-800/90 dark:to-slate-900/70 shadow-sm px-5 py-5">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="weight_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="weight_toUnit" class="text-sm text-gray-500 dark:text-gray-400">in</span>
                    </div>
                </div>
            </div>
            <button id="btnOpenWeightHistory"
                class="w-[110px] inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                🕓 History
            </button>
        </div>







        {{-- Quick Conversion Table --}}
        <div class="mt-4 rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-gray-900 dark:text-white">Quick Conversion Table</div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Based on current input</span>
            </div>
            <div class="overflow-x-auto mt-4 rounded-xl border border-gray-200 dark:border-slate-700">
                <table class="min-w-full text-sm">
                    <thead class="bg-yellow-100 dark:bg-slate-900/50 text-gray-900 dark:text-gray-300">
                        <tr>
                            <th class="text-left font-medium py-2 pl-3 pr-6">Unit</th>
                            <th class="text-left font-medium py-2 px-3">Value</th>
                        </tr>
                    </thead>
                    <tbody id="weight_tableBody" class="divide-y divide-gray-200 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Weight Conversion Guide --}}
        {{-- Weight Conversion Guide --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Weight (Mass) Conversion Guide – Kilograms, Pounds, Grams, Ounces & More
            </h2>

            {{-- Cheat Sheet --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">Quick Weight Conversion Cheat Sheet</div>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    Use this quick reference guide to easily convert between common weight and mass units such as kilograms (kg), grams (g),
                    pounds (lb), ounces (oz), stones (st), and tons. Perfect for <strong>cooking, fitness, science, and trade conversions</strong>.
                </p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>1 kilogram (kg)</strong> = <strong>1000 grams (g)</strong></li>
                        <li><strong>1 pound (lb)</strong> = <strong>16 ounces (oz)</strong> ≈ <strong>0.453592 kilograms (kg)</strong></li>
                        <li><strong>1 ounce (oz)</strong> ≈ <strong>28.3495 grams (g)</strong></li>
                        <li><strong>1 stone (st)</strong> = <strong>14 pounds (lb)</strong> ≈ <strong>6.35029 kilograms (kg)</strong></li>
                    </ul>
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>1 metric tonne (t)</strong> = <strong>1000 kilograms (kg)</strong></li>
                        <li><strong>1 US ton (short)</strong> = <strong>2000 pounds (lb)</strong> ≈ <strong>907.185 kilograms (kg)</strong></li>
                        <li><strong>1 UK ton (long)</strong> = <strong>2240 pounds (lb)</strong> ≈ <strong>1016.05 kilograms (kg)</strong></li>
                        <li><strong>1 carat (ct)</strong> = <strong>0.2 grams (g)</strong></li>
                    </ul>
                </div>
            </div>

            {{-- How conversions work --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">How Weight Conversions Are Calculated</div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Weight and mass conversions are calculated using a <strong>base unit (kilogram, kg)</strong>. Your input value is first converted
                    to kilograms using a known conversion factor, and then from kilograms to the target unit.
                    This <strong>two-step conversion method</strong> ensures maximum accuracy across all units, from grams and ounces to pounds and tons.
                </p>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Examples: 1 lb × 0.453592 = 0.453592 kg; 1 oz × 28.3495 = 28.3495 g; 1 st = 14 lb ≈ 6.35029 kg.
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to Use Each Weight Unit</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>Grams (g) / Kilograms (kg):</strong> Common in science, nutrition, packaging, and most countries using the metric system.</li>
                    <li><strong>Ounces (oz) / Pounds (lb) / Stones (st):</strong> Used for food measurements, fitness tracking, and body weight in the US and UK.</li>
                    <li><strong>Tonnes (t) / Tons (US/UK):</strong> Ideal for heavy loads, shipping, and industrial use.</li>
                    <li><strong>Carat (ct), Grain (gr), Dram (dr):</strong> Used in jewelry (carat), ammunition (grain), and pharmaceuticals (dram).</li>
                </ul>
                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Tip: For international conversions, always check whether the measurement follows the <strong>metric</strong> or <strong>imperial system</strong>.
                </p>
            </div>
        </div>

    </div>
</div>

{{-- Modal --}}
<div id="weightHistorySheet" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
    <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
        <!-- Sheet header -->
        <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Weight – Full History</h3>
            <button id="closeWeightHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
        </div>
        <!-- Sheet body -->
        <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
            <ol id="weightHistoryList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
            <!-- under <ol id="weightHistoryList"> -->
            <nav id="weightPagination" class="mt-3 flex items-center gap-1"></nav>

        </div>
        <!-- Sheet footer -->
        <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
            <button id="closeWeightHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
        </div>
    </div>
</div>

<x-appfooter />