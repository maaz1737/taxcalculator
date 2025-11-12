<x-app
    :title="'Mortgage Calculator – Calculate Monthly, Yearly & Total Home Loan Payments | QuickCalculatIt'"
    :des="'Use the QuickCalculatIt Mortgage Calculator to easily calculate your monthly, yearly, and total home loan payments. Get precise estimates for principal, interest, taxes, and insurance (PITI). Plan your home budget effectively, compare mortgage options, and make informed financial decisions with this free online mortgage calculator.'"
    :key="'mortgage calculator, home loan calculator, monthly mortgage calculator, mortgage payment estimator, PITI calculator, home financing tool, mortgage planner, loan amortization calculator, online mortgage calculator, QuickCalculatIt'"
    :titleTwitter="'Mortgage Calculator – Quick & Accurate Home Loan Payment Estimator | QuickCalculatIt'" />



<div class="px-6 sm:px-8 py-8 scroll-area bg-emerald-50 dark:bg-gray-900">
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
            <div class="flex flex-col justify-between rounded-2xl border border-yellow-300 bg-yellow-100/30  dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Mortgage Details</h2>

                    <!-- Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Home Price</label>
                            <input id="mortgage_price" type="number" value="350000"
                                class=" search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Down Payment ($)</label>
                            <input id="mortgage_down_amount" type="number" value="0"
                                class=" search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Term (Years)</label>
                            <input id="mortgage_years" type="number" value="30"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">APR (%)</label>
                            <input id="mortgage_apr_percent" type="number" value="7"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Annual Property Tax</label>
                            <input id="mortgage_annual_property_tax" type="number" value="4200"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Annual Home Insurance</label>
                            <input id="mortgage_annual_home_insurance" type="number" value="1200"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">PMI (%/yr)</label>
                            <input id="mortgage_pmi_percent" type="number" placeholder="e.g. 0.8"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">HOA ($/mo)</label>
                            <input id="mortgage_hoa_monthly" type="number" placeholder="e.g. 200"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Start Date</label>
                            <input id="mortgage_start_date" type="date"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end">
                    <button id="btnSaveMortgage"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-900">
                        💾 Save
                    </button>
                </div>
            </div>

            <!-- 📊 Results Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-red-300 bg-red-100/30 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Monthly Mortgage Summary</h2>

                    <div class="space-y-4">

                        <!-- Total -->
                        <div class="rounded-lg bg-indigo-200 dark:bg-indigo-900/40 p-4">
                            <div class="text-sm text-gray-700 dark:text-gray-200">Total Monthly</div>
                            <div id="mortgage_monthly_total" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                        </div>

                        <!-- Principal & Interest -->
                        <div class="rounded-lg bg-teal-200 dark:bg-teal-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">Principal & Interest</span>
                            <span id="mortgage_monthly_PI" class="font-semibold text-gray-900 dark:text-white">—</span>
                        </div>

                        <!-- Taxes & Insurance -->
                        <div class="rounded-lg bg-yellow-200 dark:bg-yellow-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">Tax & Insurance</span>
                            <span>
                                <span id="mortgage_monthly_tax" class="font-semibold text-gray-900 dark:text-white">—</span> ·
                                <span id="mortgage_monthly_ins" class="font-semibold text-gray-900 dark:text-white">—</span>
                            </span>
                        </div>

                        <!-- PMI & HOA -->
                        <div class="rounded-lg bg-pink-200 dark:bg-pink-900/40 p-4 flex justify-between items-center">
                            <span class="text-sm font-medium">PMI & HOA</span>
                            <span>
                                <span id="mortgage_monthly_pmi" class="font-semibold text-gray-900 dark:text-white">—</span> ·
                                <span id="mortgage_monthly_hoa" class="font-semibold text-gray-900 dark:text-white">—</span>
                            </span>
                        </div>

                        <!-- Loan Details -->
                        <div class="rounded-lg bg-slate-200 dark:bg-slate-700/40 p-4 text-sm space-y-2">
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
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-900">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>
        <div class="rounded-xl border border-red-200 bg-red-100/30 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 mt-8">
            <div class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200">
                Amortization (12 rows for 1y)
            </div>

            <div class="rounded-t-lg ring-1 ring-slate-200/60 dark:ring-slate-700/60 overflow-hidden">
                <table id="mortHeader" class="min-w-full text-sm table-fixed">
                    <colgroup>
                        <col style="width:5%" />
                        <col style="width:12%" />
                        <col style="width:9%" />
                        <col style="width:9%" />
                        <col style="width:9%" />
                        <col style="width:11%" />
                        <col style="width:7%" />
                        <col style="width:7%" />
                        <col style="width:7%" />
                        <col style="width:6%" />
                        <col style="width:14%" />
                    </colgroup>
                    <thead class="text-gray-700 dark:text-gray-300 bg-red-100 dark:bg-gray-800/60">
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <th class="text-center font-medium py-2 px-3">#</th>
                            <th class="text-left font-medium py-2 px-3">Date</th>
                            <th class="text-right font-medium py-2 px-3">Payment</th>
                            <th class="text-right font-medium py-2 px-3">Interest</th>
                            <th class="text-right font-medium py-2 px-3">Principal</th>
                            <th class="text-right font-medium py-2 px-3">Balance</th>
                            <th class="text-right font-medium py-2 px-3">PMI</th>
                            <th class="text-right font-medium py-2 px-3">Tax</th>
                            <th class="text-right font-medium py-2 px-3">Ins</th>
                            <th class="text-right font-medium py-2 px-3">HOA</th>
                            <th class="text-right font-medium py-2 px-3">Total</th>
                        </tr>
                    </thead>
                </table>
            </div>


            <div class="scroll-area overflow-auto max-h-80 rounded-b-lg ring-1 ring-t-0 ring-red-200 dark:ring-slate-700/60">
                <table id="mortBody" class="min-w-full text-sm table-fixed">
                    <colgroup>
                        <col style="width:4%" />
                        <col style="width:12%" />
                        <col style="width:10%" />
                        <col style="width:10%" />
                        <col style="width:9%" />
                        <col style="width:13%" />
                        <col style="width:8%" />
                        <col style="width:7%" />
                        <col style="width:8%" />
                        <col style="width:6%" />
                        <col style="width:13%" />
                    </colgroup>
                    <tbody id="mortgage_tableBody" class="divide-y divide-red-200 dark:divide-slate-800"></tbody>
                </table>
            </div>
            <div class="rounded-xl border border-red-200 dark:border-slate-700/60 bg-red-100 dark:bg-gray-900/60 backdrop-blur p-5 mt-4">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong class="text-gray-900 dark:text-gray-200">Note:</strong>
                    The mortgage calculation is based on an average annual tax and insurance rate.
                </p>
            </div>

        </div>
        <!-- Mortgage Calculation Guide -->
        <div class="mt-8 px-6 py-5 space-y-4 rounded-xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Mortgage Calculator & Home Loan Guide</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Planning your home purchase? Our <strong>Mortgage Calculator</strong> helps you estimate monthly, yearly, and total <strong>home loan payments</strong> including principal, interest, taxes, and insurance (PITI).
                Use it to plan your <strong>mortgage budget</strong>, compare loan options, and make informed decisions for <strong>home financing</strong> and <strong>property investments</strong>.
            </p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Key Factors in Mortgage Calculation</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li><strong>Principal:</strong> The total amount borrowed for your mortgage.</li>
                <li><strong>Interest Rate:</strong> Annual percentage rate (APR) applied to your loan.</li>
                <li><strong>Loan Term:</strong> Duration of your mortgage (e.g., 15, 20, 30 years).</li>
                <li><strong>Taxes and Insurance:</strong> Property taxes and homeowner’s insurance included in monthly payments.</li>
                <li><strong>Extra Payments:</strong> Optional additional payments to reduce principal faster and save on interest.</li>
            </ul>
        </div>

        <!-- Step-by-Step Mortgage Calculation -->
        <div class="mt-6 px-6 py-5 space-y-5 rounded-xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Step-by-Step Mortgage Calculation</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                The <strong>Mortgage Calculator</strong> uses your <strong>loan amount</strong>, <strong>interest rate</strong>, and <strong>loan term</strong> to calculate your monthly, yearly, and total payments. Here’s an example breakdown:
            </p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Example Scenario</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li><strong>Loan Amount (Principal):</strong> $300,000</li>
                <li><strong>Interest Rate:</strong> 5% per year</li>
                <li><strong>Loan Term:</strong> 30 years</li>
                <li><strong>Property Taxes:</strong> $200/month</li>
                <li><strong>Insurance:</strong> $100/month</li>
            </ul>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mt-3">Step-by-Step Calculation</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li><strong>Step 1:</strong> Calculate the <strong>monthly principal and interest</strong> using the formula:
                    <br><code>M = P [r(1+r)^n] / [(1+r)^n -1]</code>
                    <em>(where P = loan amount, r = monthly interest rate, n = total payments)</em>
                </li>
                <li><strong>Step 2:</strong> Add <strong>monthly taxes and insurance</strong> to get total monthly payment.</li>
                <li><strong>Step 3:</strong> Calculate <strong>annual payments</strong> by multiplying monthly payment by 12.</li>
                <li><strong>Step 4:</strong> Calculate <strong>total cost of mortgage</strong> over the loan term.</li>
                <li><strong>Step 5:</strong> Adjust for <strong>extra payments</strong> if you plan to pay more than the minimum monthly amount.</li>
            </ul>

            <p class="text-sm text-gray-700 dark:text-gray-300 mt-3">
                Using this method, our <strong>Online Mortgage Calculator</strong> helps you see how interest rates, loan terms, and extra payments affect your total <strong>home loan cost</strong>.
                Perfect for <strong>first-time home buyers</strong>, <strong>property investors</strong>, or anyone planning their <strong>mortgage budget</strong>.
            </p>

            <p class="text-sm text-gray-700 dark:text-gray-300">
                The <strong>Mortgage Calculator</strong> is also useful for comparing different <strong>loan options</strong>, visualizing <strong>amortization schedules</strong>, and ensuring your monthly payments align with your <strong>financial goals</strong>.
            </p>
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