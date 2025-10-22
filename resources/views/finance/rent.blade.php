<x-app
    :title="'Rent Calculator – Calculate Your Monthly Rent | QuickCalculatIt'"
    :des="'QuickCalculatIt Rent Calculator helps you calculate your monthly or yearly rent payments with ease and accuracy for better financial planning.'"
    :key="'rent calculator, finance tools, monthly rent calculator, rent estimation, QuickCalculatIt'" />


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
            <div class="rounded-xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 p-5">

                <form id="rent-form" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Income</label>
                        <input type="number" step="0.01" name="monthly_income" id="monthly_income"
                            value="6000"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40" required>
                    </div>
                    <!-- 
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="income_is_gross" class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                        <label for="income_is_gross" class="text-sm text-gray-800 dark:text-gray-200">Income is Gross (before tax)</label>
                    </div> -->

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Debts</label>
                        <input type="number" step="0.01" id="monthly_debts" value="500"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rule</label>
                        <select id="rule"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                            <option value="dti_36" selected>DTI ≤ 36%</option>
                            <option value="30_percent">30% of Income</option>
                            <option value="custom_percent">Custom % of Income</option>
                        </select>
                    </div>

                    <div id="custom_percent_wrap" class="hidden">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Custom Percent (%)</label>
                        <input type="number" step="0.01" id="custom_percent" placeholder="e.g., 33"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Utilities (Monthly)</label>
                        <input type="number" step="0.01" id="utilities_monthly" value="300"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Renter’s Insurance (Monthly)</label>
                        <input type="number" step="0.01" id="insurance_monthly" value="0"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Target Savings (%)</label>
                        <input type="number" step="0.1" id="target_savings_percent" value="10"
                            class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="show_ranges" checked class="dark:bg-gray-700">
                        <label for="show_ranges" class="text-sm text-gray-800 dark:text-gray-200">Show Conservative/Moderate/Aggressive ranges</label>
                    </div>

                    <button type="submit"
                        id="save-rent"
                        class="inline-flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-indigo-900 dark:hover:bg-indigo-800 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
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
            <div class="rounded-xl relative border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 p-5">
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
                    class="inline-flex absolute bottom-4 items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-slate-600">
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

    <!-- Explanation on Rent Calculation and DTI -->
    <div class="mt-8 px-6 py-5 space-y-4 rounded-xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">How Rent is Calculated</h3>
        <p class="text-sm text-gray-700 dark:text-gray-300">
            Rent affordability is calculated based on your **monthly income**, **monthly debts**, and a **rule** that determines the percentage of your income that can be allocated towards rent.
        </p>
        <ul class="list-disc pl-5 space-y-1">
            <li>We consider a **Debt-to-Income (DTI)** ratio, which compares your monthly debts to your gross monthly income. The common rule is to keep the DTI under **36%** for affordability.</li>
            <li>Another common approach is using **30% of your income** as a benchmark for rent affordability. However, a **custom percentage** can also be applied based on personal preferences.</li>
        </ul>
    </div>


    <div class="mt-4 px-6 py-5 space-y-4 rounded-xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800">
        <h1 class="text-2xl font-bold ml-8 mb-4 ml-8 text-gray-900 dark:text-white">How Rent is Calculated</h1>

        <div class="px-6 sm:px-8 py-1">
            <!-- Rent Calculation Explanation -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Step-by-Step Rent Calculation</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Rent affordability is determined based on your <strong>monthly income</strong>, <strong>monthly debts</strong>, and a <strong>rule</strong> that allocates a percentage of your income towards rent. The first thing you do is subtract your **target savings** from your income to see what remains for rent.
                </p>

                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Step 1:</strong> Calculate your <strong>Income After Savings</strong> (first subtract savings percentage).</li>
                    <li><strong>Step 2:</strong> Calculate your <strong>Debt-to-Income (DTI)</strong> ratio.</li>
                    <li><strong>Step 3:</strong> Apply the <strong>rent rule</strong> (usually 30% of income, but can be customized).</li>
                    <li><strong>Step 4:</strong> Calculate your <strong>total housing cost</strong> (rent + utilities + insurance).</li>
                    <li><strong>Step 5:</strong> Compare your <strong>housing cost</strong> to the affordable rent.</li>
                </ul>
            </div>

            <!-- Example Calculation -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Example Calculation</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Let’s assume the following for <strong>John</strong>:
                </p>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Monthly Income:</strong> $5,000</li>
                    <li><strong>Monthly Debts:</strong> $1,000</li>
                    <li><strong>Utilities:</strong> $200</li>
                    <li><strong>Insurance:</strong> $50</li>
                    <li><strong>Target Savings:</strong> 10%</li>
                    <li><strong>Rent Rule:</strong> 30% of income</li>
                </ul>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Step 1:</strong> Calculate the **Income After Savings**:
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <code>Income After Savings = 5000 - (5000 × 10%) = 5000 - 500 = 4500</code>
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Step 2:</strong> Calculate the **DTI Ratio**:
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <code>DTI = (1000 / 4500) × 100 = 22.22%</code>
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Step 3:</strong> Apply the rent rule:
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <code>Affordable Rent = 4500 × 30% = 1350</code>
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Step 4:</strong> Calculate the **Total Housing Costs**:
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <code>Total Housing Cost = Rent + Utilities + Insurance = 1200 + 200 + 50 = 1450</code>
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    <strong>Step 5:</strong> Compare housing costs with affordable rent:
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    John’s total housing cost ($1,450) is **$100** more than his affordable rent ($1,350).
                </p>
            </div>
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