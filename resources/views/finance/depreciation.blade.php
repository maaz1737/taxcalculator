<x-app
    :title="'Depreciation Calculator – Calculate Asset Depreciation | QuickCalculatIt'"
    :des="'QuickCalculatIt Depreciation Calculator helps you calculate asset depreciation using straight-line or declining balance methods accurately.'"
    :key="'depreciation calculator, asset depreciation, finance tools, accounting calculator, QuickCalculatIt'" />


<div class="container mx-auto max-w-5xl px-4 py-6">
    <header class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                🧮
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Depreciation Calculator</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Calculate depreciation values using different methods with an interactive schedule.
                </p>
            </div>
        </div>
        <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
            Dark mode ready
        </span>
    </header>

    <!-- Two Equal Sections -->
    <div class="grid relative grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
        <!-- ✅ FORM SECTION -->
        <div id="errorDepreciation"
            class="absolute top-0 left-0 w-[40%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">


        </div>
        <div class="flex flex-col justify-between p-6 border border-slate-600 rounded-xl bg-white dark:bg-slate-800 shadow-sm">
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Form</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Cost</label>
                        <input id="costDepreciation" type="number" step="any" value="10000"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Method</label>
                        <select id="methodDepreciation"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                            <option value="straight_line">Straight-Line</option>
                            <option value="double_declining" selected>Double-Declining (DDB)</option>
                            <option value="sum_of_years_digits">Sum-of-Years-Digits (SYD)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Salvage Value</label>
                        <input id="salvageValueDepreciation" type="number" step="any" value="1000"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Life (years)</label>
                        <input id="lifeYearsDepreciation" type="number" value="5" min="1"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">DDB: Switch to SL?</label>
                        <select id="ddbSwitchToSlDepreciation"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                            <option value="true" selected>Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rounding (decimals)</label>
                        <input id="roundDepreciation" type="number" min="0" max="4" value="2"
                            class="w-full p-3 border border-slate-600 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>
            </div>

            <!-- ✅ Save Button -->
            <div class="flex justify-end mt-6">
                <button id="btnSaveDepreciation"
                    class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                        <path d="M9 5h4v4H9z" />
                    </svg>
                    Save
                </button>
            </div>
        </div>

        <!-- ✅ RESULT SECTION -->
        <div class="flex flex-col justify-between p-6 border border-slate-600 rounded-xl bg-white dark:bg-slate-800 shadow-sm">
            <div class="space-y-4">
                <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

                <!-- Results with different background colors -->
                <div class="flex justify-between items-center rounded-lg bg-indigo-100 dark:bg-indigo-900/40 p-4">
                    Total Depreciation: <span id="deprSumDepreciation">—</span>
                </div>

                <div class="rounded-lg bg-pink-100 dark:bg-pink-900/40 p-4 flex justify-between items-center">
                    End Book Value: <span id="endBookValueDepreciation">—</span>
                </div>



                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Book value should equal salvage at the end (within rounding).
                </p>
            </div>

            <!-- ✅ History Button -->
            <div class="flex justify-end mt-6">
                <button id="openHistoryDep"
                    class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                    🕓 History
                </button>
            </div>
        </div>
    </div>

    <!-- ✅ Schedule Section BELOW Results -->
    <div class=" p-6 border border-slate-600 rounded-xl bg-white dark:bg-slate-800 shadow-sm mt-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Schedule (Yearly)</h3>
        <div class="ring-1 ring-slate-600 rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/60">
                    <tr class="border-b border-slate-200 dark:border-slate-800">
                        <th class="text-left font-medium py-2 pr-6">Year</th>
                        <th class="text-left font-medium py-2 pr-6">Depreciation</th>
                        <th class="text-left font-medium py-2 pr-6">Accumulated</th>
                        <th class="text-left font-medium py-2 pr-6">Book Value</th>
                        <th class="text-left font-medium py-2">Note</th>
                    </tr>
                </thead>
            </table>
            <div class="scroll-area max-h-72 overflow-y-auto">
                <table class="min-w-full text-sm">
                    <tbody id="tableBodyDepreciation" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ✅ History Bottom Sheet -->
    <section>
        <div id="historySheetDep"
            class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
            <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Depreciation – History</h3>
                    <button id="closeHistoryDep"
                        class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                        aria-label="Close history">✕</button>
                </div>
                <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                    <ol id="historyListDep" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                    <div class="my-2" id="depreciation_pagination"></div>
                </div>
                <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                    <button id="closeHistoryDep2"
                        class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<x-appfooter></x-appfooter>