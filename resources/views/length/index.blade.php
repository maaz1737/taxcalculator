<x-app
    :title="'Length Converter – Online Length Calculator for Meters, Kilometers, Inches, Feet & Miles'"
    :titleTwitter="'Length Converter – Online Length Calculator'"
    :des="'Our free online Length Converter allows you to convert meters, kilometers, inches, feet, yards, centimeters, and miles instantly. Get accurate metric to imperial conversions with a fast and easy calculator tool.'"
    :key="'length converter, online length calculator, convert meters to feet, convert kilometers to miles, convert inches to centimeters, metric to imperial converter, distance converter, meters to kilometers, miles to kilometers, feet to meters, cm to inches, mm to inches, km to m calculator'" />


<div class="min-h-screen dark:bg-slate-900 py-10 bg-emerald-50 text-black dark:text-white">
    <div class="container mx-auto max-w-5xl px-4">
        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">📏</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Length Converter</h1>
                    <h3 class="text-sm text-gray-600 dark:text-gray-400">Convert between Millimeter, Centimeter, meter, kilometers, inches, feet, yards, and miles.</h3>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Inputs --}}
        <div class="relative rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur px-5 pt-5 pb-4">
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
        <div class="mt-5 flex flex-col gap-2 sm:flex-row sm:items-center justify-between rounded-2xl border border-yellow-200 bg-yellow-100/30  dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur px-5 py-5">
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
        <div class="mt-4 rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800/80 shadow-sm backdrop-blur p-5">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-gray-900 dark:text-white">Quick Conversion Table</div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Based on current input</span>
            </div>
            <div class="overflow-x-auto mt-4 rounded-xl border border-gray-100 dark:border-slate-700">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-slate-900/50 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="text-left font-medium py-2 pl-3 pr-6 bg-yellow-300 dark:bg-slate-800/30">Unit</th>
                            <th class="text-left font-medium py-2 px-3 bg-yellow-300 dark:bg-slate-800/30">Value</th>
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
        <div class="mt-8 border border-red-200 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800/80 rounded-2xl shadow-sm backdrop-blur p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Length Conversion Guide – Metric to Imperial Explained
            </h2>

            <div class="grid gap-4 sm:grid-cols-2">

                {{-- Cheat Sheet --}}
                <div class="rounded-2xl border border-red-200 bg-red-100 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">Quick Conversion Cheat Sheet</div>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                        <li>1 meter (m) = 100 centimeters (cm) = 1,000 millimeters (mm)</li>
                        <li>1 kilometer (km) = 1,000 meters</li>
                        <li>1 inch (in) = 2.54 centimeters (cm) — exact</li>
                        <li>1 foot (ft) = 12 inches (in) = 0.3048 meters — exact</li>
                        <li>1 yard (yd) = 3 feet (ft) = 0.9144 meters — exact</li>
                        <li>1 mile (mi) = 5,280 feet (ft) = 1.609344 kilometers — exact</li>
                    </ul>
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        These values follow the international SI standard, ensuring precise and accurate metric–imperial length conversions every time.
                    </p>
                </div>

                {{-- How conversions are calculated --}}
                <div class="rounded-2xl border border-red-200 bg-red-100 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                    <div class="font-semibold text-gray-900 dark:text-white mb-2">How Length Conversion Works</div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                        Every conversion in this length calculator uses the <strong>meter (m)</strong> as the base reference unit.
                        Your value is first converted to meters, and then converted to the target unit. This method ensures consistent,
                        accurate results whether you convert <em>feet to meters</em>, <em>inches to centimeters</em>, or <em>kilometers to miles</em>.
                    </p>
                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Examples: <br>
                        10 ft → 10 × 0.3048 = 3.048 m → 120 in <br>
                        25 cm → 0.25 m → 9.84252 in
                    </div>
                </div>
            </div>

            {{-- When to use which unit --}}
            <div class="mt-4 rounded-2xl border border-red-200 bg-red-100 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">When to Use Different Units of Length</div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1 leading-relaxed">
                    <li><strong>Millimeters (mm) / Centimeters (cm)</strong>: ideal for product dimensions, precision measurements, engineering, and small objects.</li>
                    <li><strong>Meters (m) / Kilometers (km)</strong>: used for everyday measurements, walking distances, road lengths, and mapping.</li>
                    <li><strong>Inches (in) / Feet (ft) / Yards (yd)</strong>: commonly used in construction, DIY projects, furniture sizes, and U.S./U.K. building systems.</li>
                    <li><strong>Miles (mi)</strong>: perfect for long-distance road travel, running distances, maps, and geographical measurements used mainly in the U.S. and U.K.</li>
                </ul>
            </div>

            {{-- Extra SEO Section --}}
            <div class="mt-4 rounded-2xl border border-red-200 bg-red-100/60 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Why Length Conversion is Important</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                    Accurate length conversion is essential for engineers, students, travelers, builders, and anyone dealing with measurements.
                    Whether you are converting <strong>meters to feet</strong>, <strong>kilometers to miles</strong>, or <strong>inches to centimeters</strong>,
                    having a reliable conversion calculator saves time and prevents errors. Our tool supports both imperial and metric system conversions,
                    making it useful for international projects, global studies, and technical work.
                </p>
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