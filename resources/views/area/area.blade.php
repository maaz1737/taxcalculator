<x-app
    :title="'Area Conversion Calculator – Convert Square Meters, Feet, Acres, Hectares & More | online calculator - QuickCalculatIt'"
    :des="'Use the free QuickCalculatIt Area Conversion Calculator to instantly convert between square meters, square feet, acres, hectares, square kilometers, and other land measurement units. Perfect for property, land, and construction calculations — fast, accurate, and easy to use.'"
    :key="'area conversion calculator, area converter, square meter to square feet, square feet to acres, hectare converter, land area calculator, land measurement converter, m2 to ft2, acre to hectare, property area conversion, QuickCalculatIt'"
    :titleTwitter="'Area Conversion Calculator – Quick & Accurate Land Measurement Converter | QuickCalculatIt'" />


{{-- Page --}}
<div class="min-h-screen bg-emerald-50 dark:bg-slate-900 py-10">
    <div class="container mx-auto max-w-5xl px-4">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300">▧</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Area Converter</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Convert between common area units fast and accurately.</p>
                </div>
            </div>
            <span class="hidden sm:block text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </div>

        {{-- Error banner --}}
        <div id="error"
            class="hidden mb-4 rounded-xl border border-red-200/70 bg-red-50 text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200 px-3 py-2">
        </div>

        {{-- Inputs --}}
        <div class="relative rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm px-5 pt-5 pb-3">
            <div id="errorAreaConverter"
                class=" absolute top-0 left-0 w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <div>
                    <label for="valueAreaConverter" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Value</label>
                    <input id="valueAreaConverter" type="number" step="any" value="1"
                        class="search w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                        text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                </div>
                <div>
                    <label for="fromAreaConverter" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <select id="fromAreaConverter"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        <option value="mm2">Square Millimeter (mm²)</option>
                        <option value="cm2">Square Centimeter (cm²)</option>
                        <option value="m2" selected>Square Meter (m²)</option>
                        <option value="km2">Square Kilometer (km²)</option>
                        <option value="in2">Square Inch (in²)</option>
                        <option value="ft2">Square Foot (ft²)</option>
                        <option value="yd2">Square Yard (yd²)</option>
                        <option value="mi2">Square Mile (mi²)</option>
                        <option value="acre">Acre</option>
                        <option value="hectare">Hectare</option>
                    </select>
                </div>
                <div>
                    <label for="toAreaConverter" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <select id="toAreaConverter"
                        class="w-full rounded-xl border border-yellow-300 dark:border-slate-700 bg-white dark:bg-slate-900
                         text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-400/40">
                        <option value="mm2">Square Millimeter (mm²)</option>
                        <option value="cm2">Square Centimeter (cm²)</option>
                        <option value="m2">Square Meter (m²)</option>
                        <option value="km2">Square Kilometer (km²)</option>
                        <option value="in2" selected>Square Inch (in²)</option>
                        <option value="ft2">Square Foot (ft²)</option>
                        <option value="yd2">Square Yard (yd²)</option>
                        <option value="mi2">Square Mile (mi²)</option>
                        <option value="acre">Acre</option>
                        <option value="hectare">Hectare</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button id="btnSaveArea" class="flex items-center rounded-xl bg-teal-600 px-4 py-2 text-white text-sm font-medium hover:bg-teal-700 transition">
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
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center justify-between rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wide text-gray-700 dark:text-gray-400">Result</div>
                    <div class="mt-1 flex items-baseline gap-2">
                        <div id="resultAreaConverter" class="text-3xl font-semibold text-gray-900 dark:text-white">—</div>
                        <div id="toUnitAreaConverter" class="text-lg text-gray-500 dark:text-gray-400">in²</div>
                    </div>
                </div>
            </div>
            <button id="openHistoryArea"
                class="inline-flex w-[110px] items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium
            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900
            shadow-sm transition">
                🕓 History
            </button>
        </div>

        {{-- Table --}}
        <div class="mt-4 rounded-2xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
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
                    <tbody id="tableBodyAreaConverter" class="divide-y divide-gray-300 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                        {{-- rows via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Related --}}
        <div class="mt-4 flex flex-wrap items-center gap-3">
            <span class="text-xs font-medium px-2 py-1 rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">Related</span>
            <a href="{{ route('length') }}" class="text-sm text-violet-700 hover:underline dark:text-violet-300"> Lenght Calculator</a>
            <span class="text-gray-400">•</span>
            <a href="{{ route('volume') }}" class="text-sm text-violet-700 hover:underline dark:text-violet-300">Volume Calculator</a>
        </div>

        {{-- Reference / Content (concise & practical) --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Area Conversion Guide – Quick Reference for Common Land and Surface Units
            </h2>

            {{-- Cheat Sheet --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">Area Conversion Cheat Sheet</div>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    Use this handy area conversion chart to quickly convert between square meters, square feet, acres, hectares, and other popular land measurement units. Perfect for land measurement, property calculations, and construction planning.
                </p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 square meter (m²)</span> = <span class="font-medium">10.7639 square feet (ft²)</span></li>
                        <li><span class="font-medium">1 square foot (ft²)</span> = <span class="font-medium">144 square inches (in²)</span></li>
                        <li><span class="font-medium">1 square kilometer (km²)</span> = <span class="font-medium">1,000,000 square meters (m²)</span></li>
                        <li><span class="font-medium">1 square inch (in²)</span> = <span class="font-medium">6.4516 square centimeters (cm²)</span></li>
                    </ul>
                    <ul class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                        <li><span class="font-medium">1 acre</span> = <span class="font-medium">43,560 square feet (ft²)</span> ≈ <span class="font-medium">4,046.86 square meters (m²)</span></li>
                        <li><span class="font-medium">1 hectare (ha)</span> = <span class="font-medium">10,000 square meters (m²)</span> ≈ <span class="font-medium">2.471 acres</span></li>
                        <li><span class="font-medium">1 square mile (mi²)</span> = <span class="font-medium">2.58999 square kilometers (km²)</span></li>
                    </ul>
                </div>
            </div>

            {{-- Short Definition --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                    <strong class="text-gray-900 dark:text-white">What is Area?</strong>
                    Area is the measurement of a two-dimensional surface — the total space inside a boundary, such as a floor, land plot, or wall. It’s a key concept in land measurement, real estate, architecture, and construction.
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                    Our <strong>Area Calculator</strong> and <strong>Area Conversion Tool</strong> let you instantly convert between different units of area such as
                    <strong>square meters (m²), square feet (ft²), square inches (in²), acres, hectares,</strong> and <strong>square kilometers (km²)</strong>.
                    Whether you're measuring a house, farmland, or industrial site, this calculator ensures accurate and reliable area conversions.
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Common use cases include <strong>land measurement conversion</strong>, <strong>construction area estimation</strong>, and <strong>property valuation</strong>.
                    Easily switch between metric and imperial units and compare area values for any surface size.
                </p>
            </div>
        </div>

    </div>

</div>
<div id="historySheetArea" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
    <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
        <!-- Sheet header -->
        <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Area – Full History</h3>
            <button id="closeHistoryArea" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
        </div>
        <!-- Sheet body -->
        <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
            <ol id="historyListArea" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
            <div id="area_pagination" class="my-2"></div>
        </div>
        <!-- Sheet footer -->
        <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
            <button id="closeHistoryArea2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
        </div>
    </div>
</div>
</div>

<x-appfooter />