<x-app
    :title="'Mortgage Calculator – Calculate Your Home Loan | QuickCalculatIt'"
    :des="'QuickCalculatIt Mortgage Calculator helps you calculate your monthly mortgage payments including interest and principal for easy home financial planning.'"
    :key="'mortgage calculator, home loan calculator, finance tools, monthly mortgage, QuickCalculatIt'" />


<div class="px-6 sm:px-8 py-8 scroll-area">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Rent Icon -->
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                    🏠
                </div>
                <div class="mt-3">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Mortgage Calculator</h1>
                    <p class="text-sm mt-1 text-gray-600 dark:text-gray-400">Calculate your Mortgage.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>
        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            <div id="mortgage_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- 🏠 Form Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Mortgage Details</h2>

                    <!-- Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Home Price</label>
                            <input id="mortgage_price" type="number" value="350000"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Down Payment ($)</label>
                            <input id="mortgage_down_amount" type="number" value="0"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Term (Years)</label>
                            <input id="mortgage_years" type="number" value="30"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">APR (%)</label>
                            <input id="mortgage_apr_percent" type="number" value="7"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Annual Property Tax</label>
                            <input id="mortgage_annual_property_tax" type="number" value="4200"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Annual Home Insurance</label>
                            <input id="mortgage_annual_home_insurance" type="number" value="1200"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">PMI (%/yr)</label>
                            <input id="mortgage_pmi_percent" type="number" placeholder="e.g. 0.8"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">HOA ($/mo)</label>
                            <input id="mortgage_hoa_monthly" type="number" placeholder="e.g. 200"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Start Date</label>
                            <input id="mortgage_start_date" type="date"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end">
                    <button id="btnSaveMortgage"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        💾 Save
                    </button>
                </div>
            </div>

            <!-- 📊 Results Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Monthly Mortgage Summary</h2>

                    <div class="space-y-4">

                        <!-- Total -->
                        <div class="rounded-lg bg-indigo-100 dark:bg-indigo-900/40 p-4">
                            <div class="text-sm text-gray-700 dark:text-gray-200">Total Monthly</div>
                            <div id="mortgage_monthly_total" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                        </div>

                        <!-- Principal & Interest -->
                        <div class="rounded-lg bg-teal-100 dark:bg-teal-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">Principal & Interest</span>
                            <span id="mortgage_monthly_PI" class="font-semibold text-gray-900 dark:text-white">—</span>
                        </div>

                        <!-- Taxes & Insurance -->
                        <div class="rounded-lg bg-yellow-100 dark:bg-yellow-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">Tax & Insurance</span>
                            <span>
                                <span id="mortgage_monthly_tax" class="font-semibold text-gray-900 dark:text-white">—</span> ·
                                <span id="mortgage_monthly_ins" class="font-semibold text-gray-900 dark:text-white">—</span>
                            </span>
                        </div>

                        <!-- PMI & HOA -->
                        <div class="rounded-lg bg-pink-100 dark:bg-pink-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">PMI & HOA</span>
                            <span>
                                <span id="mortgage_monthly_pmi" class="font-semibold text-gray-900 dark:text-white">—</span> ·
                                <span id="mortgage_monthly_hoa" class="font-semibold text-gray-900 dark:text-white">—</span>
                            </span>
                        </div>

                        <!-- Loan Details -->
                        <div class="rounded-lg bg-slate-100 dark:bg-slate-700/40 p-4 text-sm space-y-2">
                            <div class="flex justify-between">
                                <span>Loan Amount:</span>
                                <span id="mortgage_loan_amount" class="font-semibold">—</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total Interest:</span>
                                <span id="mortgage_total_interest" class="font-semibold">—</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Payoff Date:</span>
                                <span id="mortgage_payoff_date" class="font-semibold">—</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end">
                    <button id="openHistoryMortgage"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>
        <section>
            <div id="historySheetMortgage" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mortgage – History</h3>
                        <button id="closeHistorySheetIdealWeight"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListMortgage" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="mortgage_pagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetIdealWeight2"
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