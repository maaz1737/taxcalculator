<x-app
    :title="'Tax Calculator – Online Income Tax Calculator | online Income Tax Estimator'"
    :titleTwitter="'Income Tax Calculator – online Income Tax Calculator '"
    :des="'Use our free Online Tax Calculator to estimate your income tax based on salary, deductions, tax slabs, and financial year rules. Quick, accurate, and easy to use for employees, freelancers, and individuals.'"
    :key="'tax calculator, online tax calculator, income tax calculator, salary tax calculator, income tax estimate, tax deduction calculator, financial year tax calculator, tax slab calculator, employee tax calculator, tax return calculation, online finance calculator, QuickCalculatIt tax tools'" />


<main class="bg-emerald-50 dark:bg-slate-900">
    <div class="max-w-3xl mx-auto p-6 ">
        {{-- Title --}}
        <header class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">🧾</div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Australia Income Tax Calculator </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Calculate Your Annual & Monthly Tax</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>


        <form id="taxCalcForm" class="relative rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <p id="errorMessageTax"
                class="absolute top-0 left-0 w-full text-sm text-red-700 bg-red-100 border border-red-200
          dark:text-white dark:bg-red-400 dark:border-red-800 rounded-md px-3 py-2
          transform -translate-y-full opacity-0 transition-all duration-500 ease-out">
            </p>

            {{-- New: Entity Type --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Entity type</label>
                <select id="payerType" class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    <option value="individual" selected>Individual (resident)</option>
                    <option value="company">Non-individual (company)</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Individuals use marginal brackets; companies typically use a flat rate.</p>


            </div>

            <div class="mb-4" class='hidden' id="individual_income">
                <label for="annualIncome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Annual taxable income (AUD)</label>
                <input
                    id="annualIncome"
                    name="income"
                    type="number"
                    min="0"
                    step="1"
                    value="0"
                    placeholder="e.g. 45000"
                    class="search mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
                    required />
                <p class="mt-1 text-xs text-gray-500">Enter income after deductions.</p>
            </div>
            <div class="mb-4" class='hidden' id="total_revenue">
                <label for="revenue" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Annual Revenue</label>
                <input
                    id="yearly_revenue"
                    name="yearly_revenue"
                    type="number"
                    min="0"
                    value="0"
                    step="1"
                    placeholder="e.g. 45000"
                    class="search mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
                    required />
                <p class="mt-1 text-xs text-gray-500">Enter genrated revenue .</p>
            </div>
            <div class="mb-4" class='hidden' id="total_cost">
                <label for="cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Annual Cost</label>
                <input
                    id="yearly_cost"
                    name="yearly_cost"
                    type="number"
                    min="0"
                    step="1"
                    value="0"
                    placeholder="e.g. 45000"
                    class="search mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
                    required />
                <p class="mt-1 text-xs text-gray-500">Enter Cost.</p>
            </div>
            <div class="mb-4" class='hidden' id="wrapper_levy">
                <label for="levyPercent" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicare levy</label>
                <select
                    id="levyPercent"
                    name="levy"
                    class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    <option value="" selected>No levy</option>
                    <option value="1.5">1.5%</option>
                    <option value="2">2%</option>
                    <option value="3">3%</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Standard Medicare levy is 2% (residents). Typically not applied to companies.</p>
            </div>

            <div class="mb-5">
                <label for="taxpaid" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax Paid</label>
                <input
                    id="taxpaid"
                    name="taxpaid"
                    type="number"
                    min="0"
                    value="0"
                    step="1"
                    placeholder="e.g. 12000"
                    class="search mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
                    required />
                <p class="mt-1 text-xs text-gray-500">PAYG withheld or total tax already paid.</p>
            </div>

            <div class="flex items-center gap-3">
                <button id="btnCalculate" class="rounded-xl bg-indigo-600 flex items-center gap-1 px-4 py-2 text-white text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
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
                <button id="btnClear" type="button" class="rounded-xl bg-gray-100 dark:bg-slate-700 text-gray-900 dark:text-gray-100 px-4 py-2 text-sm hover:bg-gray-200 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-400/40">
                    Clear
                </button>
            </div>

            <p id="errorMessage" class="mt-3 hidden text-sm text-red-700 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900/50 rounded-md px-3 py-2"></p>
        </form>
        <div class="mt-6 rounded-2xl border border-yellow-200 bg-yellow-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <!-- CARD: Results -->
            <section id="individual_income_result" class="">
                <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Income After Tax</div>
                        <div id="outRemaining" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Total Income Tax</div>
                        <div id="outIncomeTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Medicare levy</div>
                        <div id="outLevy" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Total Tax ( tax + levy)</div>
                        <div id="outTotal" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>

                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Tax Paid on Your Income</div>
                        <div id="paidtax" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400" id="remainingContent">Tax Payable</div>
                        <div id="remainingTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                </div>
            </section>
            <section id="non_individual_income_result" class="">
                <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Annual Cost</div>
                        <div id="annual_cost_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Annual Revenue</div>
                        <div id="annual_revenue_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Total Taxable Income</div>
                        <div id="taxable_amount_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Total Tax</div>
                        <div id="total_payable_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400">Tax Paid On Your Income</div>
                        <div id="paid_tax" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                    <div class="rounded-xl border border-yellow-300 bg-yellow-100 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <div class="text-gray-500 dark:text-gray-400" id="remaining_text">Tax Payable</div>
                        <div id="remaining_tax" class="font-semibold text-gray-900 dark:text-white">—</div>
                    </div>
                </div>
            </section>
            <div class="mt-4 flex items-end ">
                <button
                    id="btnOpenTaxHistory"
                    class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                    🕓 History
                </button>
            </div>

        </div>



        <section class="mt-8 space-y-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                How Australia Income Tax Is Calculated (Resident & Non-Resident Rules)
            </h2>

            <!-- Individual vs Company overview -->
            <div class="rounded-2xl border border-red-200 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Individual vs Non-individual (Company)</h3>

                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    Australian income tax is calculated differently for <strong>individual taxpayers</strong> and <strong>companies</strong>.
                    In Australia, individuals pay tax according to their income. People who earn more are taxed at higher rates. Companies pay tax at a single rate on all the money they earn. This means that whether a company is very small or very large, the same percentage of their total profits is taken as tax.
                    Below is a breakdown of how each category is taxed according to the latest Australian tax rules.
                </p>

                <div class="grid gap-4 sm:grid-cols-2 text-sm text-gray-700 dark:text-gray-300">
                    <div class="rounded-xl border border-red-200 bg-red-100/80 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">Individual Tax (Residents)</h4>
                        <ul class="mt-1 list-disc pl-5 space-y-1">
                            <li>Tax calculated based on <strong>Australian marginal tax brackets</strong>.</li>
                            <li><strong>Medicare levy</strong> (generally 2%) applies to most taxpayers, except those who are exempt.</li>
                            <li>Eligible <strong>tax offsets</strong> like LITO reduce payable tax.</li>
                            <li>Used for personal tax returns, PAYG tax, salary calculations.</li>
                        </ul>
                    </div>

                    <div class="rounded-xl border border-red-200 bg-red-100/80 dark:border-slate-700 dark:bg-slate-800 p-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">Company Tax (Non-individual)</h4>
                        <ul class="mt-1 list-disc pl-5 space-y-1">
                            <li>Flat tax rate: typically <strong>25% to 30%</strong> depending on company type.</li>
                            <li>Medicare levy <strong>does not apply</strong>.</li>
                            <li>No LITO or personal offsets.</li>
                            <li>Used for business tax, corporate tax reporting, and ASIC compliance.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Offsets -->
            <div class="rounded-2xl border border-red-200 bg-red-100/80 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Common Australian Tax Offsets & How They Affect Your Tax</h3>

                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    Tax offsets directly reduce your <strong>tax payable</strong>, not your taxable income.
                    In the Australian tax system, offsets such as LITO and SAPTO play an important role in lowering the final amount you owe.
                </p>

                <div class="overflow-x-auto rounded-xl border border-red-200 dark:border-slate-700">
                    <table class="min-w-full text-sm">
                        <thead class="bg-red-200 dark:bg-slate-900/50 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="text-left font-medium py-2 pl-3 pr-6">Offset</th>
                                <th class="text-left font-medium py-2 px-3">Eligible Income</th>
                                <th class="text-left font-medium py-2 px-3">Formula</th>
                                <th class="text-left font-medium py-2 px-3">How It Applies</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>LITO (Low Income Tax Offset)</strong></td>
                                <td class="py-2 px-3">Up to approx. <em>$66,667</em></td>
                                <td class="py-2 px-3">Max <strong>$700</strong>; phases out gradually</td>
                                <td class="py-2 px-3">Subtract from tax after bracket calculation</td>
                            </tr>
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>SAPTO</strong></td>
                                <td class="py-2 px-3">Eligible seniors/pensioners</td>
                                <td class="py-2 px-3">Capped offset; reduces as income rises</td>
                                <td class="py-2 px-3">Applied after calculating normal tax</td>
                            </tr>
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>Zone/Overseas Forces</strong></td>
                                <td class="py-2 px-3">Remote areas/eligible service</td>
                                <td class="py-2 px-3">Fixed or variable amounts</td>
                                <td class="py-2 px-3">Added after bracket tax</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Step-by-step -->
            <div class="rounded-2xl border border-red-200 bg-red-100/80 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Step-by-Step Australian Tax Calculation (With Medicare & Offsets)</h3>

                <ol class="list-decimal pl-5 text-sm text-gray-700 dark:text-gray-300 space-y-2">
                    <li>Start with your <strong>taxable income</strong> after deductions.</li>
                    <li>Apply <strong>Australian marginal tax brackets</strong>, meaning income is taxed in stages, with different rates for residents and non-residents.</li>
                    <li>For companies, apply <strong>flat company tax rate</strong>.</li>
                    <li>Apply eligible <strong>tax offsets</strong> such as LITO or SAPTO.</li>
                    <li>Add <strong>Medicare levy</strong> (if applicable).</li>
                    <li>Final tax payable = tax after offsets + Medicare levy.</li>
                    <li>Compare with tax already paid (PAYG) to calculate <strong>refund or amount owing</strong>.</li>
                    <li>Calculate <strong>take-home pay</strong> after tax.</li>
                </ol>
            </div>

            <!-- Examples -->
            <div class="rounded-2xl border border-red-200 bg-red-100/30 dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Australian Income Tax Examples</h3>

                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                    Here are simplified examples showing how Australian income tax, Medicare levy, and offsets impact your net income.
                    These help you understand how the calculator processes your inputs.
                </p>

                <div class="grid gap-4 sm:grid-cols-2 text-sm text-gray-700 dark:text-gray-300">
                    <div class="rounded-xl border border-red-200 bg-red-100/80 dark:bg-slate-800 dark:border-slate-700 p-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">Individual (with LITO & Medicare Levy)</h4>
                        <p class="mt-1">Income: <strong>$45,000</strong>, Medicare levy: <strong>2%</strong></p>
                        <ul class="list-disc pl-5 mt-1 space-y-1">
                            <li>Bracket tax: <code>$4,288</code></li>
                            <li>LITO reduces tax by approx. <strong>$700</strong></li>
                            <li>Levy: <code>$900</code></li>
                            <li>Total payable ≈ <strong>$4,488</strong></li>
                        </ul>
                    </div>

                    <div class="rounded-xl border border-red-200 bg-red-100/80 dark:bg-slate-800 dark:border-slate-700 p-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">Company Tax Example</h4>
                        <p class="mt-1">Income: <strong>$90,000</strong>, Company rate: <strong>25%</strong></p>
                        <ul class="list-disc pl-5 mt-1 space-y-1">
                            <li>Company tax: <code>$22,500</code></li>
                            <li>No Medicare levy</li>
                            <li>Total payable = <strong>$22,500</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>
<!-- Sticky History trigger -->


<!-- History Bottom Sheet -->
<div id="historySheetTax"
    class="scroll-skin fixed inset-0 bg-black/30 backdrop-blur-sm opacity-0 translate-y-full pointer-events-none flex-col justify-end z-50">
    <div class="scroll-skin bg-white dark:bg-slate-900 rounded-t-2xl shadow-xl max-h-[100vh] overflow-y-auto border-t border-gray-200 dark:border-slate-700 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Calculation History</h3>
            <button id="closeHistoryTax" class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-300">✕</button>
        </div>
        <ul id="historyListTax" class="scroll-area space-y-3 text-sm text-gray-700 dark:text-gray-300">
        </ul>
        <div id="forbuttonssss"></div>
    </div>
    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
        <button id="closeHistoryTax2" class="rounded-lg grid px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
    </div>
</div>



<x-appfooter />