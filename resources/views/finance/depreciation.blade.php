<x-app
    :title="'Depreciation Calculator – Calculate Asset Depreciation for Accounting & Finance | QuickCalculatIt'"
    :des="'QuickCalculatIt Depreciation Calculator helps you accurately calculate asset depreciation using methods like straight-line, declining balance, and sum-of-the-years-digits. Plan your accounting, track business assets, and manage financial statements with this free online depreciation calculator.'"
    :key="'depreciation calculator, asset depreciation calculator, straight-line depreciation, declining balance depreciation, accounting tools, financial calculator, QuickCalculatIt'"
    :titleTwitter="'Depreciation Calculator – Asset Depreciation Made Easy | QuickCalculatIt'" />



<div class="bg-emerald-50 dark:bg-slate-900/70">
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
            <div class="flex flex-col justify-between p-6 border border-yellow-300 dark:border-gray-500 bg-yellow-100/30 rounded-xl bg-white dark:bg-slate-800 shadow-sm">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Form</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Cost</label>
                            <input id="costDepreciation" type="number" step="any" value="10000"
                                class="search w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Method</label>
                            <select id="methodDepreciation"
                                class="w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                                <option value="straight_line">Straight-Line</option>
                                <option value="double_declining" selected>Double-Declining (DDB)</option>
                                <option value="sum_of_years_digits">Sum-of-Years-Digits (SYD)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Salvage Value</label>
                            <input id="salvageValueDepreciation" type="number" step="any" value="1000"
                                class="search w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Life (years)</label>
                            <input id="lifeYearsDepreciation" type="number" value="5" min="1"
                                class="search w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">DDB: Switch to SL?</label>
                            <select id="ddbSwitchToSlDepreciation"
                                class="w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                                <option value="true" selected>Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rounding (decimals)</label>
                            <input id="roundDepreciation" type="number" min="0" max="4" value="2"
                                class="search w-full p-3 border border-yellow-300 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- ✅ Save Button -->
                <div class="flex justify-end mt-6">
                    <button id="btnSaveDepreciation"
                        class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                            <path d="M9 5h4v4H9z" />
                        </svg>
                        Save
                    </button>
                </div>
            </div>

            <!-- ✅ RESULT SECTION -->
            <div class="flex flex-col justify-between p-6 border border-red-200 bg-red-100/30 dark:border-gray-500 rounded-xl bg-white dark:bg-slate-800 shadow-sm">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

                    <!-- Results with different background colors -->
                    <div class="flex justify-between items-center rounded-lg bg-indigo-200 dark:bg-indigo-900/40 p-4">
                        Total Depreciation: <span id="deprSumDepreciation">—</span>
                    </div>

                    <div class="rounded-lg bg-pink-200 dark:bg-pink-900/40 p-4 flex justify-between items-center">
                        End Book Value: <span id="endBookValueDepreciation">—</span>
                    </div>



                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Book value should equal salvage at the end (within rounding).
                    </p>
                </div>

                <!-- ✅ History Button -->
                <div class="flex justify-end mt-6">
                    <button id="openHistoryDep"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>

        <div class="p-6 border border-red-300 dark:border-gray-500 rounded-xl bg-red-100/30 dark:bg-slate-800 shadow-sm mt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Schedule (Yearly)</h3>

            <div class="relative overflow-y-auto max-h-72 border border-red-200 dark:border-gray-500 rounded-lg">
                <table class="min-w-full text-sm border-collapse">
                    <thead class="bg-red-100 dark:bg-gray-800/60 sticky top-0 z-10 text-gray-700 dark:text-gray-300">
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <th class="text-left font-medium py-2 px-4 w-1/6">Year</th>
                            <th class="text-left font-medium py-2 px-4 w-1/6">Depreciation</th>
                            <th class="text-left font-medium py-2 px-4 w-1/6">Accumulated</th>
                            <th class="text-left font-medium py-2 px-4 w-1/6">Book Value</th>
                            <th class="text-left font-medium py-2 px-4 w-1/6">Note</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyDepreciation" class="divide-y divide-red-200 dark:divide-slate-800">
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Depreciation Guide --}}
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                Asset Depreciation Guide (Australia)
            </h2>

            {{-- Overview --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-semibold text-gray-900 dark:text-white mb-3">
                    Understanding Depreciation
                </div>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                    The <strong>QuickCalculatIt Depreciation Calculator</strong> helps you estimate how your assets lose value
                    over time. Whether you’re managing <strong>business assets, vehicles, machinery, or equipment</strong>, this
                    tool lets you calculate depreciation using methods approved by the
                    <strong>Australian Tax Office (ATO)</strong> — such as the <em>straight-line</em> and
                    <em>diminishing (declining) balance</em> methods.
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                    Understanding your asset’s <strong>book value</strong> and <strong>annual depreciation</strong> is crucial
                    for tax reporting, accounting accuracy, and financial planning. Our calculator provides instant, reliable,
                    and easy-to-read results for smarter decision-making.
                </p>
            </div>

            {{-- Depreciation Methods --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">
                    Common Depreciation Methods
                </div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li>
                        <strong>Straight-Line Method:</strong> Spreads the asset’s cost evenly over its useful life.
                    </li>
                    <li>
                        <strong>Declining Balance Method:</strong> Calculates higher depreciation in earlier years, suitable
                        for assets that lose value faster.
                    </li>
                    <li>
                        <strong>Units of Production Method:</strong> Best for machinery or vehicles that wear based on usage
                        (e.g., hours used, units produced).
                    </li>
                </ul>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    Example: A car worth $40,000 with a 5-year life using straight-line depreciation = $8,000 per year.
                </p>
            </div>

            {{-- Tax & Accounting Relevance --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5 mb-4">
                <div class="font-medium text-gray-900 dark:text-white mb-2">
                    Why Depreciation Matters for Tax and Accounting
                </div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    In Australia, depreciation allows businesses and individuals to claim deductions on
                    <strong>wear and tear of assets</strong>. Accurate calculations help optimise your
                    <strong>tax deductions</strong>, improve <strong>financial statements</strong>, and plan better for
                    <strong>future asset replacements</strong>.
                </p>
                <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Tip: Use this calculator to create a full <strong>depreciation schedule</strong> for your tax return and
                    accounting reports.
                </div>
            </div>

            {{-- When to Use --}}
            <div class="rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <div class="font-medium text-gray-900 dark:text-white mb-2">
                    When to Use the Depreciation Calculator
                </div>
                <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc pl-5 space-y-1">
                    <li>For <strong>tax planning</strong> and <strong>accounting</strong> in Australia.</li>
                    <li>When valuing <strong>fixed assets</strong> like equipment, furniture, or vehicles.</li>
                    <li>To estimate <strong>book value</strong> and <strong>residual value</strong> over time.</li>
                    <li>For preparing <strong>financial statements</strong> or <strong>asset reports</strong>.</li>
                    <li>Ideal for <strong>business owners</strong>, <strong>accountants</strong>, and <strong>investors</strong>.</li>
                </ul>
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
</div>

<x-appfooter></x-appfooter>