<x-app
    :title="'Tax Calculator – Estimate Your Income Tax | QuickCalculatIt'"
    :des="'QuickCalculatIt Tax Calculator helps you estimate your income tax based on salary, deductions, and current tax rules quickly and accurately.'"
    :key="'tax calculator, income tax calculator, finance calculator, tax estimation, QuickCalculatIt'" />

<main class="max-w-3xl mx-auto p-6 bg-gray-50 dark:bg-slate-900">
    {{-- Title --}}
    <header class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">🧾</div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Australia — Income Tax </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Resident rates with optional Medicare levy & offsets.</p>
            </div>
        </div>
        <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
            Dark mode ready
        </span>
    </header>


    <form id="taxCalcForm" class="relative rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
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
                class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
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
                class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
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
                class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
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
                class="mt-1 change w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400/40"
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
    <div class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
        <!-- CARD: Results -->
        <section id="individual_income_result" class="">
            <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Income tax</div>
                    <div id="outIncomeTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Medicare levy</div>
                    <div id="outLevy" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Total payable</div>
                    <div id="outTotal" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Remaining (take-home)</div>
                    <div id="outRemaining" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Tax paid</div>
                    <div id="paidtax" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400" id="remainingContent">Remaining tax</div>
                    <div id="remainingTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
            </div>
        </section>
        <section id="non_individual_income_result" class="">
            <h2 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Result</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Annual Cost</div>
                    <div id="annual_cost_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Annual Revenue</div>
                    <div id="annual_revenue_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Taxable Amount</div>
                    <div id="taxable_amount_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Total Payable</div>
                    <div id="total_payable_result" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400">Tax paid</div>
                    <div id="paid_tax" class="font-semibold text-gray-900 dark:text-white">—</div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-slate-700 p-3">
                    <div class="text-gray-500 dark:text-gray-400" id="remaining_text">Remaining tax</div>
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



    {{-- DETAILS: How tax is calculated --}}
    <section class="mt-8 space-y-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">How your tax is calculated</h3>

        {{-- Individual vs Company overview --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div class="font-medium text-gray-900 dark:text-white mb-2">Individual vs Non-individual (company)</div>
            <div class="grid gap-4 sm:grid-cols-2 text-sm text-gray-700 dark:text-gray-300">
                <div class="rounded-xl border border-gray-100 dark:border-slate-700 p-3">
                    <div class="font-medium">Individual (resident)</div>
                    <ul class="mt-1 list-disc pl-5 space-y-1">
                        <li>Taxed by <strong>marginal brackets</strong> you listed above.</li>
                        <li><strong>Medicare levy</strong> (if selected) is added.</li>
                        <li><strong>Offsets</strong> (e.g., LITO) may reduce calculated tax.</li>
                    </ul>
                </div>
                <div class="rounded-xl border border-gray-100 dark:border-slate-700 p-3">
                    <div class="font-medium">Non-individual (company)</div>
                    <ul class="mt-1 list-disc pl-5 space-y-1">
                        <li>Typically a <strong>flat rate</strong> (e.g., 25% or 30%) on taxable income.</li>
                        <li>Medicare levy <em>not applicable</em>.</li>
                        <li>Offsets differ or don’t apply like individuals (handled in company tax rules).</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Offsets (concise & practical) --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div class="font-medium text-gray-900 dark:text-white mb-2">Common offsets (how & when applied)</div>
            <div class="text-sm text-gray-700 dark:text-gray-300">
                <p class="mb-3">Offsets reduce your <em>calculated tax</em> (they don’t reduce taxable income). In this calculator you can implement them after computing bracket tax.</p>

                <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-slate-700">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-slate-900/50 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="text-left font-medium py-2 pl-3 pr-6">Offset</th>
                                <th class="text-left font-medium py-2 px-3">Applies to income</th>
                                <th class="text-left font-medium py-2 px-3">Amount / Formula</th>
                                <th class="text-left font-medium py-2 px-3">How to apply</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>LITO</strong> (Low Income Tax Offset)</td>
                                <td class="py-2 px-3">Up to ~<em>$66,667</em> (phases out)</td>
                                <td class="py-2 px-3">
                                    Example: max <strong>$700</strong>; reduces by <strong>5c per $1</strong> above ~<em>$37,500</em> until nil.
                                </td>
                                <td class="py-2 px-3">Compute bracket tax → subtract LITO (not below zero).</td>
                            </tr>
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>Senior & pensioner (SAPTO)</strong></td>
                                <td class="py-2 px-3">Eligible seniors; thresholds vary</td>
                                <td class="py-2 px-3">Capped offset that phases out as income rises.</td>
                                <td class="py-2 px-3">Apply after bracket tax; depends on eligibility.</td>
                            </tr>
                            <tr>
                                <td class="py-2 pl-3 pr-6"><strong>Zone/Overseas forces</strong></td>
                                <td class="py-2 px-3">Specific living/service criteria</td>
                                <td class="py-2 px-3">Fixed or scaled amounts</td>
                                <td class="py-2 px-3">Add after brackets; confirm eligibility.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Notes: Offsets are capped and subject to eligibility. Exact thresholds/amounts can change; confirm current values for production use.
                </p>
            </div>
        </div>

        {{-- Step-by-step (with offsets) --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div class="font-medium text-gray-900 dark:text-white mb-2">Step-by-step (calculation order)</div>
            <ol class="list-decimal pl-5 text-sm text-gray-700 dark:text-gray-300 space-y-2">
                <li>Start with <strong>taxable income</strong> (after deductions).</li>
                <li>If <strong>Individual</strong>: compute tax via the <strong>marginal brackets</strong> you provided.</li>
                <li>If <strong>Company</strong>: compute tax = <code>income × (rate/100)</code>.</li>
                <li>Apply <strong>offsets</strong> (e.g., LITO) to reduce tax, not below zero.</li>
                <li>Add <strong>Medicare levy</strong> (if selected and Individual).</li>
                <li><strong>Total payable</strong> = tax after offsets + levy.</li>
                <li>Compare with <strong>Tax paid</strong> → you get <em>remaining payable</em> (or refund).</li>
                <li><strong>Take-home</strong> = income − total payable.</li>
            </ol>
        </div>

        {{-- Example walkthrough --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-slate-700 dark:bg-slate-800 shadow-sm p-5">
            <div class="font-medium text-gray-900 dark:text-white mb-2">Examples</div>
            <div class="grid gap-4 sm:grid-cols-2 text-sm text-gray-700 dark:text-gray-300">
                <div class="rounded-xl border border-gray-100 dark:border-slate-700 p-3">
                    <div class="font-medium">Individual (with LITO & levy)</div>
                    <p class="mt-1">Income <strong>$45,000</strong>, levy <strong>2%</strong>.</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1">
                        <li>Bracket tax (per your schedule): <code>$4,288 + 30%×(45,000−45,000)= $4,288</code>.</li>
                        <li>Illustrative LITO: say <strong>$700</strong> (phase rules may reduce).</li>
                        <li>Tax after offsets: <code>$4,288 − $700 = $3,588</code> (min 0).</li>
                        <li>Levy: <code>45,000 × 2% = $900</code>.</li>
                        <li>Total payable ≈ <strong>$4,488</strong>.</li>
                    </ul>
                </div>
                <div class="rounded-xl border border-gray-100 dark:border-slate-700 p-3">
                    <div class="font-medium">Company (flat rate)</div>
                    <p class="mt-1">Income <strong>$90,000</strong>, rate <strong>25%</strong>.</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1">
                        <li>Company tax: <code>$90,000 × 25% = $22,500</code>.</li>
                        <li>No Medicare levy.</li>
                        <li>Total payable ≈ <strong>$22,500</strong> (before any company-specific adjustments).</li>
                    </ul>
                </div>
            </div>
            <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Examples are illustrative; wire your exact rules into the calculator logic.</p>
        </div>
    </section>
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