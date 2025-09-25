<!-- Modal: Salary Calculator -->
<div id="popupSalaryCalculator"
    class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center"
    aria-hidden="true" role="dialog" aria-modal="true">
    <div class="popup-content bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 w-[min(960px,95vw)] max-h-[85vh] overflow-hidden p-0">

        <!-- Header (sticky) -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-5 py-3 rounded-t-2xl bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Salary (Gross ↔ Net) Calculator</h2>
            <button id="closePopupSalaryCalculator"
                class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900"
                aria-label="Close">✕</button>
        </div>
        <div class="relative z-[99999999999]">
            <div id="errorSalary"
                class="absolute top-2 left-12 w-[40%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                ddd
            </div>
        </div>

        <!-- Body (scroll container) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto max-h-[calc(85vh-48px-56px)] scroll-area">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Left: Inputs -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">


                    <form id="salary-form" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Mode</label>
                            <select id="mode"
                                class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="gross_to_net" selected>Gross → Net</option>
                                <option value="net_to_gross">Net → Gross</option>
                            </select>
                        </div>
                        <!-- Levy (toggle) -->
                        <div class="flex items-center justify-between">
                            <div>
                                <label for="levy" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-0.5">
                                    2% levy
                                </label>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Apply additional 2% levy to gross.</p>
                            </div>

                            <!-- Toggle -->
                            <label for="levy" class="relative inline-flex items-center cursor-pointer select-none">
                                <input
                                    id="levy"
                                    name="levy"
                                    type="checkbox"
                                    value="2"
                                    class="sr-only peer"
                                    aria-describedby="levy-help" />
                                <div
                                    class="w-11 h-6 rounded-full bg-slate-300 dark:bg-slate-700 transition
             peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-300 dark:peer-focus:ring-slate-600
             peer-checked:bg-gray-900 dark:peer-checked:bg-white relative
             after:content-[''] after:absolute after:top-[2px] after:left-[2px]
             after:h-5 after:w-5 after:rounded-full after:bg-white dark:after:bg-gray-900
             after:shadow after:transition-all peer-checked:after:translate-x-5">
                                </div>
                            </label>
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Pay Frequency</label>
                            <select id="pay_frequency"
                                class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="hourly">Hourly</option>
                                <option value="weekly">Weekly</option>
                                <option value="biweekly">Bi-Weekly</option>
                                <option value="semimonthly">Semi-Monthly</option>
                                <option value="monthly" selected>Monthly</option>
                                <option value="annual">Annual</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Amount</label>
                            <input type="number" id="amount" value="6000"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" required>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gross if Gross→Net; Target Net if Net→Gross.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Hours / Week</label>
                                <input type="number" id="hours_per_week" value="40"
                                    class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Weeks / Year</label>
                                <input type="number" id="weeks_per_year" value="52"
                                    class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Country</label>
                                <input type="text" id="country_code" value="US"
                                    class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Region</label>
                                <input type="text" id="region_code" placeholder="CA / ON / PK-ISB"
                                    class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Tax Year</label>
                                <input type="number" id="tax_year" value="2024"
                                    class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                            </div>
                        </div>




                        <div class="pt-2">
                            <button type="submit" id="submitsssssss"
                                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                                save
                            </button>
                            <span id="saving" class="text-sm ml-3 hidden">saving…</span>
                            <div id="error" class="hidden text-sm text-red-700 dark:text-red-300 mt-2"></div>
                        </div>
                    </form>
                </div>

                <!-- Right: Results -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Your Result</h2>
                    <div class="text-sm space-y-2 text-gray-800 dark:text-gray-300">
                        <div><strong>Headline:</strong> <span id="headline">—</span></div>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div>Hourly: <span id="p_hourly">—</span></div>
                            <div>Weekly: <span id="p_weekly">—</span></div>
                            <div>Bi-Weekly: <span id="p_biweekly">—</span></div>
                            <div>Semi-Monthly: <span id="p_semimonthly">—</span></div>
                            <div>Monthly: <span id="p_monthly">—</span></div>
                            <div>Annual: <span id="p_annual">—</span></div>
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-200">Taxes</h3>
                            <div class="grid grid-cols-2 gap-2 mt-2">

                                <div>Medical Levy: <span id="levy_out">—</span></div>
                                <div>Tax: <span id="tax_out">—</span></div>

                                <div>Total Tax: <span id="tax_total">—</span></div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <!-- Sticky bottom action bar -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end">
            @auth
            <button id="openHistorySalary"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                History
            </button>
            @endauth
        </div>
    </div>

    <!-- Bottom Sheet (History) -->
    <div id="historySheetSalary" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Salary – History</h3>
                <button id="closeHistorySalary"
                    class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                    aria-label="Close history">✕</button>
            </div>
            <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                <ol id="historyListSalary" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div class="my-2" id="salaryPagination"></div>
            </div>
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistorySalary2"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>