<div id="popupWeightConverter" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="weightConverterTitle">
    <div class="scroll-area popup-content w-[min(960px,95vw)] max-h-[85vh] overflow-y-auto rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 relative">
        <!-- Sticky header (like length) -->
        <div class="sticky top-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700" style="z-index:1;">
            <h2 id="weightConverterTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Weight Converter</h2>
            <button id="closePopupWeightConverter" class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900" aria-label="Close">✕</button>
        </div>

        <!-- Body -->
        <div class="p-6 sm:p-8 pb-24">
            <!-- Error Message -->
            <div id="weight_error" class="error hidden text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2 mb-4"></div>

            <!-- Converter Form -->
            <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg border border-slate-200/70 dark:border-slate-700/60">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">Value</label>
                        <input id="weight_value" type="number" step="any" value="1" class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">From</label>
                        <select id="weight_from" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
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
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200">To</label>
                        <select id="weight_to" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
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
            </div>

            <!-- Result Display -->
            <div class="card bg-white/70 dark:bg-gray-900/60 backdrop-blur p-4 rounded-lg mt-4 border border-slate-200/70 dark:border-slate-700/60">
                <div class="text-sm text-gray-600 dark:text-gray-300">Result</div>
                <div class="text-2xl font-semibold text-gray-900 dark:text-white" id="weight_result">—</div>
                <div class="text-sm text-gray-400 dark:text-gray-500" id="weight_toUnit">ct</div>
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
                        <tbody id="weight_tableBody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sticky bottom action bar -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end gap-2">

            @auth

            <button id="btnOpenWeightHistory" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                <!-- clock icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                </svg>
                History
            </button>

            @endauth



            <button id="btnSaveWeight" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                <!-- disk icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                    <path d="M9 5h4v4H9z" />
                </svg>
                Save
            </button>
        </div>
    </div>

    <!-- Bottom Sheet (History for weight) -->
    <div id="weightHistorySheet" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <!-- Sheet header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Weight – Full History</h3>
                <button id="closeWeightHistory" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <!-- Sheet body -->
            <div class="p-5 overflow-y-auto max-h-[70vh]">
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


</div>



<script>

</script>