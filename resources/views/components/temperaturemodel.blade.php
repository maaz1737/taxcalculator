<div id="popupTemperatureConverter" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="temperatureConverterTitle">
    <div>
        <div class=" relative z-[99999999999]">
            <div id="temperature_error"
                class=" absolute top-[80px] left-[7%] w-[50%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                ddd
            </div>
        </div>
        <div class="scroll-area popup-content w-[min(960px,95vw)] max-h-[85vh] overflow-y-auto rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 relative">
            <!-- Sticky header -->
            <div class="sticky top-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700" style="z-index:1;">
                <h2 id="temperatureConverterTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Temperature Converter</h2>
                <button id="closePopupTemperatureConverter" class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900" aria-label="Close">✕</button>
            </div>

            <!-- Body -->
            <div class="p-6 sm:p-8 pb-24">
                <!-- Error Message -->
                <div id="" class="error hidden text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2 mb-4"></div>

                <!-- Converter Form -->
                <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg border border-slate-200/70 dark:border-slate-700/60">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Value</label>
                            <input id="temperature_value" type="number" step="any" value="0" class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">From</label>
                            <select id="temperature_from" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="C" selected>Celsius (°C)</option>
                                <option value="K">Kelvin (K)</option>
                                <option value="F">Fahrenheit (°F)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">To</label>
                            <select id="temperature_to" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="C">Celsius (°C)</option>
                                <option value="K">Kelvin (K)</option>
                                <option value="F" selected>Fahrenheit (°F)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Result Display -->
                <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/70 dark:border-slate-700/60">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Result</div>
                    <div class="text-2xl font-semibold text-gray-900 dark:text-white" id="temperature_result">—</div>
                    <div class="text-sm text-gray-400 dark:text-gray-500" id="temperature_toUnit">°F</div>
                </div>

                <!-- Conversion Table -->
                <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/70 dark:border-slate-700/60">
                    <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">Quick Conversion Table</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Based on current input.</div>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-800">
                                    <th class="text-left text-sm font-medium text-gray-800 dark:text-gray-200">Unit</th>
                                    <th class="text-left text-sm font-medium text-gray-800 dark:text-gray-200">Value</th>
                                </tr>
                            </thead>
                            <tbody id="temperature_tableBody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Note -->
                <div class="card bg-white/60 dark:bg-gray-900/50 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/50 dark:border-slate-700/50">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        <strong>Formulas:</strong> K = °C + 273.15; °F = (°C × 9/5) + 32.
                    </div>
                </div>
            </div>

            <!-- Sticky bottom action bar -->
            <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end gap-2">

                @auth

                <button id="btnOpenTemperatureHistory" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                    <!-- clock icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                    </svg>
                    History
                </button>

                @endauth

                <button id="btnSaveTemperature" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                    <!-- disk icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                        <path d="M9 5h4v4H9z" />
                    </svg>
                    Save
                </button>
            </div>
        </div>
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
            <div id="temPager" class="flex flex-wrap items-center gap-2 mt-3">
                <button id="temPrev" class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 disabled:opacity-50">«</button>

                <!-- numbered page buttons will be injected here -->
                <div id="temPages" class="inline-flex flex-wrap items-center gap-1"></div>

                <button id="temNext" class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 disabled:opacity-50">»</button>


            </div>

        </div>
    </div>
</div>


<!-- Sheet footer -->
<div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
    <button id="closeTemperatureHistory2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
</div>