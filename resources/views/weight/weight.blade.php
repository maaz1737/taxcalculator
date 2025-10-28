<x-app
    :title="'Weight Converter – Convert Kilograms, Pounds, Grams & Ounces | QuickCalculatIt'"
    :des="'QuickCalculatIt Weight Converter allows you to convert between kilograms, grams, pounds, and ounces instantly with accurate results.'"
    :key="'weight converter, kilograms to pounds, grams to ounces, mass converter, QuickCalculatIt'" />

<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-10">
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
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>


        {{-- Converter Inputs --}}
        <div class="relative rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm px-5 pt-5 pb-3">
            <div id="weight_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="weight_value" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="weight_from"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
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
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-teal-400/40">
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
        <div class="mt-5 rounded-2xl border border-slate-600 bg-gradient-to-b from-white/90 to-gray-50/70 dark:from-slate-800/90 dark:to-slate-900/70 shadow-sm px-5 py-5">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="weight_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="weight_toUnit" class="text-sm text-gray-500 dark:text-gray-400">in</span>
                    </div>
                </div>

                <button id="btnOpenWeightHistory"
                    class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                    🕓 History
                </button>
            </div>
        </div>







        {{-- Quick Conversion Table --}}
        <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
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
                    <tbody id="weight_tableBody" class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Weight Conversion Guide --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Weight (Mass) Conversion Guide</h2>

            {{-- Cheat Sheet --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">Cheat Sheet</div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 kg</span> = <span class="font-medium">1000 g</span></li>
                        <li><span class="font-medium">1 lb</span> = <span class="font-medium">16 oz</span> ≈ <span class="font-medium">0.453592 kg</span></li>
                        <li><span class="font-medium">1 oz</span> ≈ <span class="font-medium">28.3495 g</span></li>
                        <li><span class="font-medium">1 stone</span> = <span class="font-medium">14 lb</span> ≈ <span class="font-medium">6.35029 kg</span></li>
                    </ul>
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 metric tonne (t)</span> = <span class="font-medium">1000 kg</span></li>
                        <li><span class="font-medium">1 US ton (short)</span> = <span class="font-medium">2000 lb</span> ≈ <span class="font-medium">907.185 kg</span></li>
                        <li><span class="font-medium">1 UK ton (long)</span> = <span class="font-medium">2240 lb</span> ≈ <span class="font-medium">1016.05 kg</span></li>
                        <li><span class="font-medium">1 carat (ct)</span> = <span class="font-medium">0.2 g</span></li>
                    </ul>
                </div>
            </div>

            {{-- How conversions work --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">How conversions are calculated</div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Conversions use a **base unit** (kilogram, kg). Your input is converted to kg using a known factor, then from kg to the target unit.
                    For example, <em>lb → kg → g</em>. This two-step approach keeps results accurate and consistent.
                </p>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Examples: 1 lb × 0.453592 = 0.453592 kg; 1 oz × 28.3495 = 28.3495 g; 1 st = 14 lb ≈ 6.35029 kg.
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to use which unit</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>g / kg:</strong> science, labeling, most countries (metric).</li>
                    <li><strong>oz / lb / st:</strong> food, body weight (US/UK customary).</li>
                    <li><strong>t / ton (US/UK):</strong> freight, large loads.</li>
                    <li><strong>ct, gr, dr:</strong> jewelry (carat), ammo/grains (gr), apothecaries (dr).</li>
                </ul>
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