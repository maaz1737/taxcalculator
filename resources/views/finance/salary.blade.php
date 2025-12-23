<x-app
    :title="'Salary Calculator – Net Salary, Gross Salary & Take-Home Pay Calculation | online calculator'"
    :titleTwitter="'Salary Calculator – Calculate Net & Gross Salary Online'"
    :des="'Calculate your net salary, gross salary, take-home pay, tax deductions, and allowances instantly with QuickCalculatIt. Our advanced salary calculator helps you estimate income after tax, employer deductions, benefits, pension, and overtime. Ideal for employees, freelancers, and HR professionals looking for accurate salary breakdown and financial planning.'"
    :key="'salary calculator, net salary calculator, gross salary calculator, take home pay calculator, salary after tax, salary breakdown, income calculator, wage calculator, paycheck calculator, monthly salary calculator, yearly salary calculator, salary estimation tool, tax deduction calculator, allowances calculator, overtime calculator, employee salary calculator, freelancer salary calculator, payroll calculator, HR salary calculator, finance calculator, salary calculation online, QuickCalculatIt salary calculator, income tax salary calculator'" />


<main class="bg-emerald-50 dark:bg-slate-900">
    <div class="container mx-auto max-w-5xl px-4 py-6 ">
        <header class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Rent Icon -->
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                    💼
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Salary (Gross ↔ Net) Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Calculate Gross to Net or Net to Gross based on your income and deductions.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 relative border border-yellow-300 rounded-xl bg-yellow-100/50 dark:bg-slate-800 dark:border-slate-500  shadow-sm">
                <div id="errorSalary"
                    class="absolute top-0 left-2 w-[90%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                    ddd
                </div>
                <form id="salary-form">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Mode</label>
                        <select id="mode" class="w-full border border-yellow-300 rounded-xl p-3 bg-white dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                            <option value="gross_to_net" selected>Gross → Net</option>
                            <option value="net_to_gross">Net → Gross</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Pay Frequency</label>
                        <select id="pay_frequency" class="w-full border border-yellow-300 rounded-xl p-3 bg-white dark:border-slate-500 dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                            <option value="hourly">Hourly</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Bi-Weekly</option>
                            <option value="semimonthly">Semi-Monthly</option>
                            <option value="monthly" selected>Monthly</option>
                            <option value="annual">Annual</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Amount</label>
                        <input type="number" step="0.01" id="amount" class="search w-full border border-yellow-300 rounded-xl dark:border-slate-500 p-3 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400" value="6000" required>
                        <p class="text-xs text-gray-500 mt-1">Gross if Gross→Net; Target Net if Net→Gross.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Hours / Week</label>
                            <input type="number" step="0.1" id="hours_per_week" class="search w-full border border-yellow-300 rounded-xl dark:border-slate-500 p-3 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Weeks / Year</label>
                            <input type="number" step="0.1" id="weeks_per_year" class="search w-full border border-yellow-300 rounded-xl dark:border-slate-500 p-3 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400" value="52">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6 mt-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Country</label>
                            <input type="text" id="country_code" class="search w-full border border-yellow-300 rounded-xl p-3 dark:border-slate-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400" value="AUS">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Region</label>
                            <input type="text" id="region_code" class="search w-full border border-yellow-300 rounded-xl p-3 dark:border-slate-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400" placeholder="CA / ON / PK-ISB">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Tax Year</label>
                            <input type="number" id="tax_year" class="search w-full border border-yellow-300 rounded-xl p-3 dark:border-slate-500 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-400" value="2025">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button id='saveSalary' class="px-4 py-2 flex items-center gap-1 rounded-lg bg-emerald-600 text-white text-sm hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-900" type="submit">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                                <path d="M9 5h4v4H9z" />
                            </svg>
                            save
                        </button>
                        <div id="error" class="text-sm text-red-600 mt-2 hidden"></div>
                    </div>
                </form>
            </div>

            <!-- Result Section -->
            <div class="relative py-14 px-4 lg:py-6 sm:py-14 md:p-6 border border-red-300 rounded-xl dark:border-slate-500 bg-red-100/30 dark:bg-slate-800 shadow-sm">
                <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>
                <div class="space-y-4">
                    <!-- Headline Section -->
                    <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:text-gray-100 dark:border-slate-500 rounded-lg">
                        <strong>Headline:</strong> <span id="headline">—</span>
                    </div>

                    <!-- Salary Results in Boxes -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Hourly: <span id="p_hourly">—</span>
                        </div>
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Weekly: <span id="p_weekly">—</span>
                        </div>
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Bi-Weekly: <span id="p_biweekly">—</span>
                        </div>
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Semi-Monthly: <span id="p_semimonthly">—</span>
                        </div>
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Monthly: <span id="p_monthly">—</span>
                        </div>
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-90 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Annual: <span id="p_annual">—</span>
                        </div>
                    </div>

                    <!-- Taxes Section -->
                    <div class="mt-4">
                        <div class="p-4 border border-red-300 bg-red-100 dark:bg-slate-900 text-gray-900 dark:border-slate-500 dark:text-gray-100 rounded-lg">
                            Total Taxes: <span id="tax_total">—</span>
                        </div>
                    </div>

                </div>
                @auth
                <button id="openHistorySalary"
                    class="inline-flex absolute bottom-5 items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-100 bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                    </svg>
                    <span class="ml-1"> History
                    </span>
                </button>
                @endauth
            </div>
        </div>

        <!-- Explanation Section -->
        <p class=" tracking-wide text-sm text-gray-700 dark:text-gray-300 mt-8 bg-red-100/30 dark:bg-slate-800 p-4 rounded-lg border border-red-300 dark:border-slate-500">
            It’s important to know how your <strong>salary</strong> is calculated so you can better understand your <strong>income in Australia</strong>. Whether you’re converting <strong>gross salary to net pay</strong> (your <strong>income before tax</strong> into what you actually <strong>take home</strong>) or working backwards from <strong>net pay to gross salary</strong> (your <strong>take-home amount</strong> back to your <strong>total earnings</strong>), factors such as <strong>Australian tax rates</strong>, <strong>compulsory superannuation contributions</strong>, and the <strong>Medicare levy</strong> all play an important role in determining your <strong>final income</strong>. This <strong>Salary Calculator Australia</strong> uses <strong>accurate tax brackets</strong>, <strong>deductions</strong>, and <strong>superannuation details</strong> to estimate your <strong>take-home pay</strong> in seconds.
        </p>

        <div class=" tracking-wide text-sm text-gray-700 dark:text-gray-300 mt-8 bg-red-100/30 dark:bg-slate-800 p-4 rounded-lg border border-red-300 dark:border-slate-500">
            <h4 class="font-semibold text-gray-900 dark:text-white">
                Step 1: Gross to Net Salary Calculation in Australia
            </h4>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                1. Start with your <strong>gross salary</strong>, which is your full income before tax, super, or any deductions.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                2. Apply <strong>pre-tax deductions</strong> such as salary sacrifice, additional superannuation contributions, or approved tax-deductible payments.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                3. Calculate <strong>income tax</strong> and the <strong>Medicare levy</strong> based on the Australian Tax Office (ATO) tax brackets.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                4. Deduct any <strong>post-tax costs</strong> like union fees or after-tax super contributions.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                The remaining amount is your <strong>net salary</strong> or <strong>take-home pay</strong>, showing how much you actually receive after taxes and deductions.
            </p>
        </div>

        <div class="tracking-wide text-sm text-gray-700 dark:text-gray-300 mt-8 bg-red-100/30 dark:bg-slate-800 p-4 rounded-lg border border-red-300 dark:border-slate-500">
            <h4 class="font-semibold text-gray-900 dark:text-white">
                Step 2: Net to Gross Salary Calculation in Australia
            </h4>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                1. Begin with your <strong>desired net income</strong>—the amount you want to receive after all deductions.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                2. Add back any <strong>post-tax deductions</strong> that you must cover, including union fees or after-tax contributions.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                3. Reverse the tax calculation using Australian income tax rates, Medicare levy rules, and applicable thresholds to determine the required <strong>gross salary</strong>.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                4. Include all <strong>pre-tax deductions</strong> such as voluntary superannuation contributions or salary-sacrifice amounts.
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                This gives you an accurate estimate of the <strong>gross income</strong> needed to achieve your target <strong>take-home pay</strong> in Australia.
            </p>
        </div>



        <!-- History Section -->
        <section>
            <div id="historySheetSalary" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Salary – History</h3>
                        <button id="closeHistorySalary"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListSalary" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="my-2" id="salaryPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySalary2"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<x-appfooter></x-appfooter>