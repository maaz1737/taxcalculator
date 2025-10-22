<x-app
    :title="'Volume Converter – Convert Liters, Milliliters, Gallons & Cups | QuickCalculatIt'"
    :des="'QuickCalculatIt Volume Converter helps you convert between liters, milliliters, gallons, cups, and more accurately and easily.'"
    :key="'volume converter, liters to gallons, milliliters to cups, liquid converter, QuickCalculatIt'" />


    <div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">🧪</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Volume Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between mL, L, m³, teaspoons, cups, pints, gallons, and more.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>
        {{-- Converter Form --}}
        <div class="relative rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div id="volume_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="col-span-1">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="volume_value" type="number" step="any" value="1"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="volume_from"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        <option value="ml">Milliliter (mL)</option>
                        <option value="l">Liter (L)</option>
                        <option value="m3" selected>Cubic Meter (m³)</option>
                        <option value="tsp_us">US Teaspoon</option>
                        <option value="tbsp_us">US Tablespoon</option>
                        <option value="floz_us">US Fluid Ounce</option>
                        <option value="cup_us">US Cup</option>
                        <option value="pt_us">US Pint</option>
                        <option value="qt_us">US Quart</option>
                        <option value="gal_us">US Gallon</option>
                        <option value="tsp_metric">Metric Teaspoon (5 mL)</option>
                        <option value="tbsp_metric">Metric Tablespoon (15 mL)</option>
                        <option value="cup_metric">Metric Cup (250 mL)</option>
                        <option value="floz_imp">Imp Fluid Ounce</option>
                        <option value="pt_imp">Imp Pint</option>
                        <option value="qt_imp">Imp Quart</option>
                        <option value="gal_imp">Imp Gallon</option>
                        <option value="in3">Cubic Inch (in³)</option>
                        <option value="ft3">Cubic Foot (ft³)</option>
                        <option value="yd3">Cubic Yard (yd³)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="volume_to"
                        class="w-full rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        <option value="ml">Milliliter (mL)</option>
                        <option value="l">Liter (L)</option>
                        <option value="m3">Cubic Meter (m³)</option>
                        <option value="tsp_us" selected>US Teaspoon</option>
                        <option value="tbsp_us">US Tablespoon</option>
                        <option value="floz_us">US Fluid Ounce</option>
                        <option value="cup_us">US Cup</option>
                        <option value="pt_us">US Pint</option>
                        <option value="qt_us">US Quart</option>
                        <option value="gal_us">US Gallon</option>
                        <option value="tsp_metric">Metric Teaspoon (5 mL)</option>
                        <option value="tbsp_metric">Metric Tablespoon (15 mL)</option>
                        <option value="cup_metric">Metric Cup (250 mL)</option>
                        <option value="floz_imp">Imp Fluid Ounce</option>
                        <option value="pt_imp">Imp Pint</option>
                        <option value="qt_imp">Imp Quart</option>
                        <option value="gal_imp">Imp Gallon</option>
                        <option value="in3">Cubic Inch (in³)</option>
                        <option value="ft3">Cubic Foot (ft³)</option>
                        <option value="yd3">Cubic Yard (yd³)</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button id="btnSaveVolume" class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
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

        {{-- Result Display --}}
        <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="volume_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="volume_toUnit" class="text-sm text-gray-500 dark:text-gray-400">tsp</span>
                    </div>
                </div>
                <button id="btnOpenVolumeHistory"
                    class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                    🕓 History
                </button>
            </div>

        </div>

        {{-- Conversion Table --}}
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
                    <tbody id="volume_tableBody" class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Volume Guide --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Volume Conversion Guide</h2>

            {{-- Cheat Sheet --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">Cheat Sheet</div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 L</span> = <span class="font-medium">1000 mL</span></li>
                        <li><span class="font-medium">1 m³</span> = <span class="font-medium">1000 L</span></li>
                        <li><span class="font-medium">1 US gal</span> = <span class="font-medium">3.78541 L</span></li>
                        <li><span class="font-medium">1 Imp gal</span> = <span class="font-medium">4.54609 L</span></li>
                    </ul>
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 US cup</span> = <span class="font-medium">236.588 mL</span></li>
                        <li><span class="font-medium">1 US fl oz</span> = <span class="font-medium">29.5735 mL</span></li>
                        <li><span class="font-medium">1 Imp pint</span> = <span class="font-medium">568.261 mL</span></li>
                        <li><span class="font-medium">1 ft³</span> = <span class="font-medium">28.3168 L</span></li>
                    </ul>
                </div>
                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Note: <strong>US</strong> and <strong>Imperial (UK)</strong> measures differ (e.g., US gal 3.785 L vs Imp gal 4.546 L).
                </p>
            </div>

            {{-- How conversions are calculated --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">How conversions are calculated</div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    We convert through a <strong>base unit</strong> (liter, L). Your input is first turned into liters using a precise factor,
                    then from liters to the target unit. This two-step method keeps results consistent (e.g., <em>US gal → L → mL</em>).
                </p>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Examples: 1 US cup × 236.588 = 236.588 mL; 2 ft³ × 28.3168 = 56.6336 L; 0.5 m³ × 1000 = 500 L.
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to use which unit</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>mL / L:</strong> beverages, medicine doses, lab work (metric).</li>
                    <li><strong>US tsp / tbsp / cup / fl oz / pt / qt / gal:</strong> cooking & packaging (US customary).</li>
                    <li><strong>Imperial pint / quart / gallon:</strong> UK recipes & older references.</li>
                    <li><strong>m³ / ft³ / yd³:</strong> room/tank volumes, shipping, concrete/soil.</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="volumeHistorySheet" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Volume – Full History</h3>
                <button id="closeVolumeHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                <ol id="volumeHistoryList" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div class="my-3" id="volume_pagination"></div>
            </div>
            <!-- Sheet footer -->
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeVolumeHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>

<x-appfooter />