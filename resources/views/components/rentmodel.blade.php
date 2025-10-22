<!-- Modal: Rent Affordability Calculator -->
<div id="popupRentCalculator" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="popup-content bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 w-[min(960px,95vw)] max-h-[85vh] overflow-hidden p-0">

        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-5 py-3 rounded-t-2xl bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Rent Affordability Calculator</h2>
            <button id="closePopupRentCalculator"
                class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                aria-label="Close">✕</button>
        </div>


        <div class="relative z-[99999999999]">
            <div id="rent-message"
                class="absolute top-2 left-12 w-[40%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto max-h-[calc(85vh-48px-56px)] scroll-area"><!-- reserve 56px for sticky bar -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Left Column: Inputs -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <form id="rent-form" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Income</label>
                            <input type="number" step="0.01" name="monthly_income" id="monthly_income"
                                value="6000"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" required>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="income_is_gross" class="dark:bg-gray-700" class='search'>
                            <label for="income_is_gross" class="text-sm text-gray-800 dark:text-gray-200">Income is Gross (before tax)</label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Debts</label>
                            <input type="number" step="0.01" id="monthly_debts" value="500"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rule</label>
                            <select id="rule"
                                class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="dti_36" selected>DTI ≤ 36%</option>
                                <option value="30_percent">30% of Income</option>
                                <option value="custom_percent">Custom % of Income</option>
                            </select>
                        </div>

                        <div id="custom_percent_wrap" class="hidden">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Custom Percent (%)</label>
                            <input type="number" step="0.01" id="custom_percent" placeholder="e.g., 33"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Utilities (Monthly)</label>
                            <input type="number" step="0.01" id="utilities_monthly" value="300"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Renter’s Insurance (Monthly)</label>
                            <input type="number" step="0.01" id="insurance_monthly" value="0"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Target Savings (%)</label>
                            <input type="number" step="0.1" id="target_savings_percent" value="10"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="show_ranges" checked class="dark:bg-gray-700">
                            <label for="show_ranges" class="text-sm text-gray-800 dark:text-gray-200">Show Conservative/Moderate/Aggressive ranges</label>
                        </div>

                        <button type="submit"
                            id="save-rent"
                            class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                                <path d="M9 5h4v4H9z" />
                            </svg>
                            Save
                        </button>
                        <span id="saving" class="text-sm ml-3 hidden">Saving...</span>

                    </form>
                </div>

                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Your Result</h2>
                    <div id="headline" class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">—</div>

                    <div id="breakdown" class="space-y-2 text-sm text-gray-800 dark:text-gray-300">
                        <div><strong>Rent-to-Income:</strong> <span id="rti">—</span></div>
                        <div><strong>Total DTI:</strong> <span id="tdti">—</span></div>

                        <div class="mt-3">
                            <strong>Housing Costs:</strong>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div>Rent: <span id="cost_rent">—</span></div>
                                <div>Utilities: <span id="cost_util">—</span></div>
                                <div>Insurance: <span id="cost_ins">—</span></div>
                                <div>Total Housing: <span id="cost_total">—</span></div>
                            </div>
                        </div>

                        <div id="ranges_wrap" class="mt-3 hidden">
                            <strong>Ranges (by % of income after savings):</strong>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div>Conservative (25%): <span id="rng_cons_amt">—</span></div>
                                <div>Moderate (30%): <span id="rng_mod_amt">—</span></div>
                                <div>Aggressive (35%): <span id="rng_agg_amt">—</span></div>
                            </div>
                        </div>

                        <ul id="notes" class="list-disc pl-5 mt-3 text-gray-700 dark:text-gray-400"></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky action bar (History button) -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end">

            @auth
            <button id="openHistoryRent"
                class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-slate-600">
                History
            </button>
            @endauth


        </div>
    </div>

    <!-- Bottom Sheet (History) -->
    <div id="historySheetRent" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rent – History</h3>
                <button id="closeHistoryRent" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                <ol id="historyListRent" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div id="button_container" class="my-4"></div>
            </div>
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistoryRent2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>