<x-app
    :title="'Volume Conversion Calculator – Convert Liters, Milliliters, Gallons, Cups & Fluid Ounces | online QuickCalculatIt'"
    :des="'Use the free QuickCalculatIt Volume Conversion Calculator to easily convert between liters, milliliters, gallons, cups, pints, quarts, and fluid ounces. Perfect for cooking, recipes, laboratory use, and liquid measurement conversions — fast, accurate, and easy to use.'"
    :key="'volume conversion calculator, volume converter, liquid converter, fluid volume calculator, liters to gallons, gallons to liters, milliliters to cups, cups to milliliters, pints to liters, quarts to gallons, fluid ounces converter, cooking measurement converter, recipe volume converter, kitchen liquid calculator, volume unit converter, convert volume online, QuickCalculatIt'"
    :titleTwitter="'Volume Conversion Calculator – Accurate Liquid & Fluid Measurement Converter | QuickCalculatIt'" />



<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
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
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>
        {{-- Converter Form --}}
        <div class="relative rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div id="volume_error"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="col-span-1">
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="volume_value" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="volume_from"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
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
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
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
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center justify-between rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <span id="volume_result" class="text-3xl font-semibold text-gray-900 dark:text-white">—</span>
                        <span id="volume_toUnit" class="text-sm text-gray-500 dark:text-gray-400">tsp</span>
                    </div>
                </div>
            </div>
            <button id="btnOpenVolumeHistory"
                class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                🕓 History
            </button>
        </div>

        {{-- Conversion Table --}}
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
                    <tbody id="volume_tableBody" class="divide-y divide-gray-200 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Volume Guide --}}
        {{-- Volume Guide --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Volume Conversion Guide – Convert Liters, Milliliters, Gallons & More
            </h2>

            {{-- Cheat Sheet --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">Quick Conversion Cheat Sheet</div>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    You can quickly convert between liters (L), milliliters (mL), gallons, cups, and other common volume units using this helpful chart. These are the most reliable and popular conversion values, regardless of whether you're working with industrial quantities, liquid measurements, or recipes:
                </p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>1 L</strong> = <strong>1000 mL</strong></li>
                        <li><strong>1 m³</strong> = <strong>1000 L</strong></li>
                        <li><strong>1 US gallon (gal)</strong> = <strong>3.78541 L</strong></li>
                        <li><strong>1 Imperial gallon (UK gal)</strong> = <strong>4.54609 L</strong></li>
                    </ul>
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><strong>1 US cup</strong> = <strong>236.588 mL</strong></li>
                        <li><strong>1 US fluid ounce (fl oz)</strong> = <strong>29.5735 mL</strong></li>
                        <li><strong>1 Imperial pint</strong> = <strong>568.261 mL</strong></li>
                        <li><strong>1 cubic foot (ft³)</strong> = <strong>28.3168 L</strong></li>
                    </ul>
                </div>
                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Note: <strong>US</strong> and <strong>Imperial (UK)</strong>The gallon and pint sizes in the US and Imperial (UK) systems differ; for instance, a US gallon is 3.785 L, whereas a UK gallon is 4.546 L. Always confirm which system is being used for your project or recipe.
                </p>
            </div>

            {{-- How conversions are calculated --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">How Volume Conversions Are Calculated</div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Our <strong>online volume converter</strong> operates using a single base unit: the <strong>liter (L)</strong>. Regardless of the unit you input—be it a US gallon, a cubic meter, or a milliliter—the calculator first translates it into liters. From there, it converts the liters into your desired unit, employing precise conversion factors. This two-step approach guarantees accurate and consistent results for all liquid, solid, and container volume conversions.
                </p>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Examples: 1 US cup × 236.588 = 236.588 mL; 2 ft³ × 28.3168 = 56.6336 L; 0.5 m³ × 1000 = 500 L.
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to Use Each Volume Unit</div>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    The right volume unit hinges on your specific area of work, whether it's cooking, scientific research, construction, or shipping.
                </p>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li><strong>mL / L (Metric):</strong> Ideal for beverages, pharmaceuticals, laboratory work, and international recipes.</li>
                    <li><strong>US tsp / tbsp / cup / fl oz / pt / qt / gal:</strong> Common in American cooking, product labeling, and liquid packaging.</li>
                    <li><strong>Imperial pint / quart / gallon:</strong> Used in the UK, Canada, and older recipes or trade documents.</li>
                    <li><strong>m³ / ft³ / yd³:</strong> Used for bulk materials, tank capacity, soil, concrete, and industrial shipping.</li>
                </ul>
                <p class="mt-3 text-sm text-gray-700 dark:text-gray-300">
                    Here's a breakdown of when to use each measurement system: mL / L (Metric): This is the go-to for drinks, pharmaceuticals, lab experiments, and recipes from around the world. US tsp / tbsp / cup / fl oz / pt / qt / gal: These are the standard measurements in American kitchens, on product labels, and for liquid packaging. Imperial pint / quart / gallon: These are used in the UK, Canada, and in older recipes or trade documents. m³ / ft³ / yd³: These are the units for bulk materials, tank capacities, soil, concrete, and industrial shipping. With QuickCalculatIt's Volume Converter, you can effortlessly switch between any of these units in a matter of seconds. Instantly convert liters to gallons, milliliters to cups, or cubic feet to cubic meters – ideal for use in the kitchen, scientific endeavors, or construction planning.
                </p>
            </div>

            {{-- Extra SEO Text --}}
            <div class="mt-6 text-sm text-gray-700 dark:text-gray-300">
                <p>
                    The <strong>QuickCalculatIt Volume Converter</strong> supports both metric and imperial systems and includes
                    all major <strong>liquid measurement units</strong> such as liters, milliliters, cups, pints, quarts, gallons,
                    and cubic meters. This makes it ideal for anyone who needs fast and accurate <strong>volume conversions online</strong>,
                    whether you’re a student, chef, scientist, or engineer. Convert between <strong>US and UK gallons</strong>,
                    <strong>cubic feet and liters</strong>, or <strong>milliliters and ounces</strong> effortlessly.
                </p>
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