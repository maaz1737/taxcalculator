<x-app
    :title="'Rent Calculator – Calculate Monthly, Weekly & Yearly Rent Online | QuickCalculatIt'"
    :des="'Use the QuickCalculatIt Rent Calculator to easily calculate your monthly, weekly, or yearly rent. Get accurate rent cost estimations, split rent among roommates, and plan your housing or apartment budget effectively. Perfect for tenants, landlords, and property managers looking for fast and precise rent calculations.'"
    :key="'rent calculator, rent cost calculator, monthly rent calculator, yearly rent calculator, weekly rent calculator, apartment rent calculator, housing rent estimator, rent splitter, rental cost tool, property management calculator, QuickCalculatIt rent calculator, online rent calculator'"
    :titleTwitter="'Rent Calculator – Quick & Accurate Rent Cost Estimator | QuickCalculatIt'" />



<div class="bg-emerald-50 dark:bg-slate-900/70">
    <div class="container mx-auto max-w-4xl px-4 py-6">
        <header class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Rent Icon -->
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                    🏠
                </div>
                <div class="mt-3">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Rent Affordability Calculator</h1>
                    <p class="text-sm mt-1 text-gray-600 dark:text-gray-400">Calculate your affordable rent based on income and debts.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>
        <div class="px-6 sm:px-8 py-6"><!-- reserve 56px for sticky bar -->
            <div class="relative z-[99999999999]">
                <div id="rent-message"
                    class="absolute top-0 left-0 w-1/2 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                <!-- Left Column: Inputs -->
                <div class="rounded-xl border border-yellow-300 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 p-5">

                    <form id="rent-form" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Income</label>
                            <input type="number" step="0.01" name="monthly_income" id="monthly_income"
                                value="6000"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40" required>
                        </div>
                        <!-- 
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="income_is_gross" class="mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        <label for="income_is_gross" class="text-sm text-gray-800 dark:text-gray-200">Income is Gross (before tax)</label>
                    </div> -->

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Debts</label>
                            <input type="number" step="0.01" id="monthly_debts" value="500"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rule</label>
                            <select id="rule"
                                class="mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                                <option value="dti_36" selected>DTI ≤ 36%</option>
                                <option value="30_percent">30% of Income</option>
                                <option value="custom_percent">Custom % of Income</option>
                            </select>
                        </div>

                        <div id="custom_percent_wrap" class="hidden">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Custom Percent (%)</label>
                            <input type="number" step="0.01" id="custom_percent" placeholder="e.g., 33"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Utilities (Monthly)</label>
                            <input type="number" step="0.01" id="utilities_monthly" value="300"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Renter’s Insurance (Monthly)</label>
                            <input type="number" step="0.01" id="insurance_monthly" value="0"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Target Savings (%)</label>
                            <input type="number" step="0.1" id="target_savings_percent" value="10"
                                class="search mt-1 change w-full rounded-xl border border-yellow-300 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="show_ranges" checked class="dark:bg-gray-700">
                            <label for="show_ranges" class="text-sm text-gray-800 dark:text-gray-200">Show Conservative/Moderate/Aggressive ranges</label>
                        </div>

                        <button type="submit"
                            id="save-rent"
                            class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-900 ">
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

                <!-- Right Column: Results -->
                <div class="rounded-xl relative border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 p-5">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Your Result</h2>
                    <div id="headline" class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">—</div>

                    <div id="breakdown" class=" space-y-2 text-sm text-gray-800 dark:text-gray-300">
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
                    @auth
                    <button id="openHistoryRent"
                        class="inline-flex absolute bottom-4 items-center rounded-lg px-3 py-1.5 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                        </svg>
                        <span class="ml-1"> History
                        </span>
                    </button>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Rent Calculation & Affordability Guide -->
        <div class="mt-8 px-6 py-5 space-y-4 rounded-xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Rent Affordability & Income Ratio Explained</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Understanding how rent is calculated helps you make smarter financial decisions. Our <strong>Rent Calculator</strong> uses your <strong>monthly income</strong>, <strong>debts</strong>, and <strong>savings goals</strong> to estimate what rent you can comfortably afford.
                This method helps both <strong>tenants</strong> and <strong>landlords</strong> determine fair and affordable rental payments while maintaining a healthy financial balance.
            </p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Key Factors in Rent Calculation</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li>The <strong>Debt-to-Income (DTI) ratio</strong> compares your total monthly debts to your gross income — ideally below <strong>36%</strong> for financial stability.</li>
                <li>The <strong>30% rule</strong> suggests spending no more than <strong>30% of your monthly income</strong> on rent. This standard ensures that rent payments stay affordable.</li>
                <li>You can also set a <strong>custom rent percentage</strong> based on your personal budget and savings goals for more flexibility.</li>
            </ul>
        </div>

        <!-- Step-by-Step Rent Calculation Example -->
        <div class="mt-6 px-6 py-5 space-y-5 rounded-xl border border-red-300 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Step-by-Step Rent Calculation Example</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                The <strong>Rent Affordability Calculator</strong> follows a simple process to estimate how much rent you can afford based on your income, debt, and expenses.
                Here’s an example breakdown for better understanding:
            </p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Example Scenario</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li><strong>Monthly Income:</strong> $5,000</li>
                <li><strong>Monthly Debts:</strong> $1,000</li>
                <li><strong>Utilities:</strong> $200</li>
                <li><strong>Insurance:</strong> $50</li>
                <li><strong>Target Savings:</strong> 10%</li>
                <li><strong>Rent Rule:</strong> 30% of income</li>
            </ul>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mt-3">Step-by-Step Calculation</h3>
            <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                <li><strong>Step 1:</strong> Calculate <strong>Income After Savings</strong>
                    <br><code>Income After Savings = 5000 - (5000 × 10%) = 4500</code>
                </li>
                <li><strong>Step 2:</strong> Determine <strong>Debt-to-Income (DTI) Ratio</strong>
                    <br><code>DTI = (1000 / 4500) × 100 = 22.22%</code>
                </li>
                <li><strong>Step 3:</strong> Apply <strong>Rent Rule (30%)</strong>
                    <br><code>Affordable Rent = 4500 × 30% = 1350</code>
                </li>
                <li><strong>Step 4:</strong> Add <strong>Total Housing Costs</strong>
                    <br><code>Total = Rent + Utilities + Insurance = 1200 + 200 + 50 = 1450</code>
                </li>
                <li><strong>Step 5:</strong> Compare <strong>Actual vs Affordable Rent</strong>
                    <br>John’s total housing cost ($1,450) is <strong>$100</strong> higher than his affordable rent ($1,350), meaning he’s slightly over budget.
                </li>
            </ul>

            <p class="text-sm text-gray-700 dark:text-gray-300 mt-3">
                This example shows how the <strong>Rent Estimator Tool</strong> helps you visualize your rent-to-income balance. It’s ideal for tenants looking to budget smartly, landlords setting fair prices, or financial planners analyzing housing affordability.
            </p>

            <p class="text-sm text-gray-700 dark:text-gray-300">
                The <strong>Rent Calculator</strong> also works great for <strong>roommate rent splitting</strong>, <strong>apartment budgeting</strong>, and <strong>rental affordability planning</strong>.
                With QuickCalculatIt, you can instantly see how changes in income, debts, or utility costs impact your rent range.
            </p>
        </div>


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

</div>

<x-appfooter></x-appfooter>