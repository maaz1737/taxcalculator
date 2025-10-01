    <div id="popupTaxCalculator" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" role="dialog" aria-modal="true" aria-labelledby="taxConverterTitle">
        <!-- Panel -->
        <div class="scroll-area popup-content w-[min(960px,95vw)] max-h-[85vh] overflow-y-auto rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 relative">
            <!-- Header (sticky) -->
            <div style="z-index:1;" class="sticky top-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur flex items-center justify-between px-5 py-3 rounded-t-2xl border-b border-slate-200 dark:border-slate-700">
                <h2 id="taxConverterTitle" class="text-xl font-semibold text-gray-900 dark:text-white">Australia – Income Tax (2024–25)</h2>
                <button id="closeTaxModel" class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.225 4.811a1 1 0 0 1 1.414 0L12 9.172l4.361-4.361a1 1 0 1 1 1.414 1.414L13.414 10.586l4.361 4.361a1 1 0 0 1-1.414 1.414L12 12l-4.361 4.361a1 1 0 0 1-1.414-1.414l4.361-4.361-4.361-4.361a1 1 0 0 1 0-1.414Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="p-6 sm:p-8 pb-8 ">
                <div class=" grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                    <div>
                        <!-- CARD: Form -->
                        <form id="taxCalcForm"
                            class="relative rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 shadow-sm">
                            <p id="errorMessageTax"
                                class="absolute top-0 left-0 w-full text-sm text-red-700 bg-red-100 border border-red-200
          dark:text-white dark:bg-red-400 dark:border-red-800 rounded-md px-3 py-2
          transform -translate-y-full opacity-0 transition-all duration-500 ease-out">
                            </p>
                            <div class="mb-4">
                                <label for="annualIncome" class="block text-sm font-medium text-gray-800 dark:text-gray-200">Annual taxable income (AUD)</label>
                                <input
                                    id="annualIncome"
                                    name="income"
                                    type="number"
                                    min="0"
                                    step="1"
                                    placeholder="e.g. 45000"
                                    class="search mt-1 change w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                                    required />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter income after deductions.</p>
                            </div>

                            <div class="mb-4">
                                <label for="levyPercent" class="block text-sm font-medium text-gray-800 dark:text-gray-200">Medicare levy</label>
                                <select
                                    id="levyPercent"
                                    name="levy"
                                    class="mt-1 change w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                    <option value="" selected>No levy</option>
                                    <option value="1.5">1.5%</option>
                                    <option value="2">2%</option>
                                    <option value="3">3%</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Standard Medicare levy is 2% (residents).</p>
                            </div>

                            <div class="mb-4">
                                <label for="taxpaid" class="block text-sm font-medium text-gray-800 dark:text-gray-200">Tax Paid</label>
                                <input
                                    id="taxpaid"
                                    name="taxpaid"
                                    type="number"
                                    min="0"
                                    step="1"
                                    placeholder="e.g. 10000"
                                    class=" search mt-1 change w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 px-3 py-2 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                                    required />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Paid tax.</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <button id="btnCalculate" class="rounded-lg bg-gray-900 text-white px-4 py-2 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                    save
                                </button>
                                <button id="btnClear" type="button" class="rounded-lg bg-gray-100 text-gray-900 px-4 py-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                                    Clear
                                </button>
                            </div>

                        </form>
                    </div>

                    <!-- RIGHT: Your results (card styled to match) -->
                    <div>
                        <!-- CARD: Results -->
                        <section class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5 shadow-sm">
                            <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Result</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400">Income tax</div>
                                    <div id="outIncomeTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400">Medicare levy</div>
                                    <div id="outLevy" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400">Total payable</div>
                                    <div id="outTotal" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400">Remaining (take-home)</div>
                                    <div id="outRemaining" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400">Tax paid</div>
                                    <div id="paidtax" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                <div class="rounded-lg border border-slate-200 dark:border-slate-700 p-3">
                                    <div class="text-gray-500 dark:text-gray-400" id="remainingContent">Remaining Tax</div>
                                    <div id="remainingTax" class="font-semibold text-gray-900 dark:text-white">—</div>
                                </div>
                                @auth

                                <button id="btnOpenTaxHistory" class="inline-flex items-center gap-2 rounded-lg px-2 w-[55%] py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                                    <!-- clock icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm.75 5a.75.75 0 0 0-1.5 0v5c0 .199.079.389.22.53l3 3a.75.75 0 0 0 1.06-1.06l-2.78-2.78V7Z" />
                                    </svg>
                                    History
                                </button>
                                @endauth

                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div id="historySheetTax" class="scroll-skin fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
                    <!-- Sheet header -->
                    <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tax – Full History</h3>
                        <button id="closeHistoryTax" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
                    </div>
                    <!-- Sheet body -->
                    <div class="scroll-area p-5 overflow-y-auto max-h-[70vh]">
                        <ol id="historyListTax" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div id="forbuttonssss" class="my-3"></div>
                    </div>
                    <!-- Sheet footer -->
                    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistoryTax2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

