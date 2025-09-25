<!-- Modal: Mortgage Calculator -->
<div id="popupMortgageCalculator"
    class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center"
    aria-hidden="true" role="dialog" aria-modal="true">
    <div class="popup-content bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 w-[min(960px,95vw)] max-h-[85vh] overflow-hidden p-0">

        <!-- Header (sticky) -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-5 py-3 rounded-t-2xl bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Mortgage Calculator</h2>
            <button id="closePopupMortgageCalculator"
                class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900"
                aria-label="Close">✕</button>
        </div>

        <!-- Body (single scroll container) -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto max-h-[calc(85vh-48px-56px)] scroll-area">
            <div class="container">

                <!-- Error Message -->
                <div id="mortgage_error"
                    class="hidden text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2 mb-4"></div>

                <!-- Mortgage Calculator Form -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Home Price</label>
                            <input id="mortgage_price" type="number" step="any" value="350000"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Down Payment (amount)</label>
                            <input id="mortgage_down_amount" type="number" step="any" value="70000"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Term (years)</label>
                            <input id="mortgage_years" type="number" value="30"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">APR (%)</label>
                            <input id="mortgage_apr_percent" type="number" step="any" value="7"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Annual Property Tax ($/yr)</label>
                            <input id="mortgage_annual_property_tax" type="number" step="any" value="4200"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Annual Home Insurance ($/yr)</label>
                            <input id="mortgage_annual_home_insurance" type="number" step="any" value="1200"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">PMI (% of loan / yr, optional)</label>
                            <input id="mortgage_pmi_percent" type="number" step="any" placeholder="e.g., 0.8"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">HOA ($/mo, optional)</label>
                            <input id="mortgage_hoa_monthly" type="number" step="any" placeholder="e.g., 200"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Start Date (YYYY-MM-DD, optional)</label>
                            <input id="mortgage_start_date" type="date"
                                class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>
                    </div>
                </div>

                <!-- Mortgage Calculation Result -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 mt-4">
                    <div class="text-sm text-gray-600 dark:text-gray-300">Monthly Total</div>
                    <div class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white" id="mortgage_monthly_total">—</div>
                    <div class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                        <div>P&amp;I: <span id="mortgage_monthly_PI">—</span></div>
                        <div>Tax: <span id="mortgage_monthly_tax">—</span> · Ins: <span id="mortgage_monthly_ins">—</span></div>
                        <div>PMI: <span id="mortgage_monthly_pmi">—</span> · HOA: <span id="mortgage_monthly_hoa">—</span></div>
                        <div>Loan: <span id="mortgage_loan_amount">—</span> · Total Interest: <span id="mortgage_total_interest">—</span></div>
                        <div>Payoff: <span id="mortgage_payoff_date">—</span></div>
                    </div>
                </div>

                <!-- Mortgage Amortization Table -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 mt-4">
                    <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">
                        Amortization (12 rows for 1y)
                    </div>

                    <!-- Table header (fixed) -->
                    <div class="rounded-t-lg ring-1 ring-slate-200/60 dark:ring-slate-700/60">
                        <table class="min-w-full text-sm">
                            <thead class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800/60">
                                <tr class="border-b border-slate-200 dark:border-slate-800">
                                    <th class="text-left font-medium py-2 px-3">#</th>
                                    <th class="text-left font-medium py-2 px-3">Date</th>
                                    <th class="text-left font-medium py-2 px-3">Payment</th>
                                    <th class="text-left font-medium py-2 px-3">Interest</th>
                                    <th class="text-left font-medium py-2 px-3">Principal</th>
                                    <th class="text-left font-medium py-2 px-3">Balance</th>
                                    <th class="text-left font-medium py-2 px-3">PMI</th>
                                    <th class="text-left font-medium py-2 px-3">Tax</th>
                                    <th class="text-left font-medium py-2 px-3">Ins</th>
                                    <th class="text-left font-medium py-2 px-3">HOA</th>
                                    <th class="text-left font-medium py-2 px-3">Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Scrollable body -->
                    <div class="scroll-area overflow-auto max-h-80 rounded-b-lg ring-1 ring-t-0 ring-slate-200/60 dark:ring-slate-700/60">
                        <table class="min-w-full text-sm">
                            <tbody id="mortgage_tableBody" class="divide-y divide-slate-200 dark:divide-slate-800"></tbody>
                        </table>
                    </div>
                </div>



                <!-- Note -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 mt-4">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        <strong class="text-gray-900 dark:text-gray-200">Note:</strong>
                        The mortgage calculation is based on an average annual tax and insurance rate.
                    </p>
                </div>

            </div>
        </div>

        <!-- Sticky bottom action bar (History) -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end">
            <button id="openHistoryMortgage"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium
                     text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300
                     dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                History
            </button>
        </div>
    </div>

    <!-- Bottom Sheet (History) -->
    <div id="historySheetMortgage"
        class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mortgage – History</h3>
                <button id="closeHistoryMortgage"
                    class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                    aria-label="Close history">✕</button>
            </div>
            <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                <ol id="historyListMortgage" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
            </div>
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistoryMortgage2"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Reusable history opener (same pattern you've been using)
    (function initMortgageHistory() {
        const openBtn = document.getElementById('openHistoryMortgage');
        const sheet = document.getElementById('historySheetMortgage');
        if (!openBtn || !sheet) return;

        if (sheet.dataset.bound === '1') return;
        sheet.dataset.bound = '1';

        const closeBtns = sheet.querySelectorAll('[id^="close"], [data-close], .js-close-sheet');

        const show = () => {
            sheet.classList.remove('pointer-events-none', 'opacity-0', 'translate-y-full');
            document.addEventListener('keydown', escHandler, {
                once: true
            });
            // TODO: fetch & render history items into #historyListMortgage here if needed
            // fillMortgageHistory();
        };

        const hide = () => {
            sheet.classList.add('pointer-events-none', 'opacity-0', 'translate-y-full');
        };

        const escHandler = (e) => {
            if (e.key === 'Escape') hide();
        };

        openBtn.addEventListener('click', e => {
            e.preventDefault();
            show();
        });
        closeBtns.forEach(btn => btn.addEventListener('click', hide));

        // Optional expose
        sheet.showSheet = show;
        sheet.hideSheet = hide;
    })();
</script>