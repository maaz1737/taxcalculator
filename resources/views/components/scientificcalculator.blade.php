<!-- ✅ Scientific Calculator Modal -->
<div id="sciCalcModal"
    class="fixed inset-0 z-50 hidden opacity-0 pointer-events-none transition-opacity duration-300 backdrop-blur-sm flex items-center justify-center"
    role="dialog" aria-modal="true" aria-labelledby="sciCalcTitle">

    <!-- Overlay (click to close if needed) -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- Panel -->
    <div class="relative z-10 w-[min(700px,90vw)] max-h-[90vh] rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 overflow-hidden transform scale-95 transition-transform duration-300">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-3 bg-emerald-800 dark:bg-gray-800/70 backdrop-blur border-b border-slate-200 dark:border-slate-800 sticky top-0">
            <div class="flex items-center gap-2">
                <h1 id="sciCalcTitle" class="text-base font-semibold text-gray-100 dark:text-white">
                    Scientific Calculator
                </h1>
                <span class="text-xs text-white dark:text-gray-400 hidden sm:inline">(keyboard friendly)</span>
            </div>
            <div class="flex items-center gap-2">
                <label class="inline-flex items-center gap-2 text-sm text-gray-100 dark:text-gray-200">
                    Angle:
                    <select id="angleMode"
                        class="px-2 py-1 rounded-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                        <option value="deg">Deg</option>
                        <option value="rad" selected>Rad</option>
                    </select>
                </label>
                <button id="btnClearAll"
                    class="rounded-md px-3 py-1.5 text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-300">AC</button>
                <button id="closeSciCalc"
                    class="ml-1 inline-flex items-center justify-center h-8 w-8 rounded-full text-white hover:text-gray-900 hover:bg-gray-200/70 dark:text-gray-300 dark:hover:text-gray-100 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                    aria-label="Close">✕</button>
            </div>
        </div>

        <!-- Display -->
        <div class="px-4 pt-4 pb-2 bg-red-50 dark:bg-slate-700/30">
            <div class="text-right text-lg tracking-widest text-gray-700 dark:text-gray-200 h-5" id="displayExpr">&nbsp;</div>
            <div class="mt-1 text-right text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900 dark:text-white leading-tight select-text"
                id="displayValue">0</div>
            <div class="flex items-center justify-between mt-1 text-xs text-gray-700 dark:text-gray-400">
                <div>
                    <span class="mr-2">Mem: <span id="memIndicator">0</span></span>
                    <span>Ans: <span id="ansIndicator">0</span></span>
                </div>
                <div id="errorMsg" class="text-rose-600"></div>
            </div>
        </div>

        <!-- Keypad + History -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-3 p-4 overflow-y-auto max-h-[70vh]">

            <!-- KEYPAD -->
            <div class="lg:col-span-3 grid grid-cols-5 gap-1.5 text-sm">
                <!-- Memory -->
                <button data-key="MC" class="btn bg-gray-100 dark:bg-gray-800">MC</button>
                <button data-key="MR" class="btn bg-gray-100 dark:bg-gray-800">MR</button>
                <button data-key="M+" class="btn bg-gray-100 dark:bg-gray-800">M+</button>
                <button data-key="M-" class="btn bg-gray-100 dark:bg-gray-800">M-</button>
                <button data-key="DEL" class="btn bg-amber-100 dark:bg-amber-900/30 text-amber-900 dark:text-amber-200">⌫</button>

                <!-- Functions -->
                <button data-fn="sin" class="btn bg-gray-100 dark:bg-gray-800">sin</button>
                <button data-fn="cos" class="btn bg-gray-100 dark:bg-gray-800">cos</button>
                <button data-fn="tan" class="btn bg-gray-100 dark:bg-gray-800">tan</button>
                <button data-fn="ln" class="btn bg-gray-100 dark:bg-gray-800">ln</button>
                <button data-fn="log" class="btn bg-gray-100 dark:bg-gray-800">log</button>

                <button data-fn="sqrt" class="btn bg-gray-100 dark:bg-gray-800">√</button>
                <button data-fn="square" class="btn bg-gray-100 dark:bg-gray-800">x²</button>
                <button data-fn="pow" class="btn bg-gray-100 dark:bg-gray-800">xʸ</button>
                <button data-fn="recip" class="btn bg-gray-100 dark:bg-gray-800">1/x</button>
                <button data-fn="fact" class="btn bg-gray-100 dark:bg-gray-800">x!</button>

                <button data-key="(" class="btn bg-gray-100 dark:bg-gray-800">(</button>
                <button data-key=")" class="btn bg-gray-100 dark:bg-gray-800">)</button>
                <button data-key="pi" class="btn bg-gray-100 dark:bg-gray-800">π</button>
                <button data-key="e" class="btn bg-gray-100 dark:bg-gray-800">e</button>
                <button data-fn="sign" class="btn bg-gray-100 dark:bg-gray-800">±</button>

                <button data-key="7" class="btn bg-emerald-100/70 dark:bg-gray-800">7</button>
                <button data-key="8" class="btn bg-emerald-100/70 dark:bg-gray-800">8</button>
                <button data-key="9" class="btn bg-emerald-100/70 dark:bg-gray-800">9</button>
                <button data-op="/" class="btn bg-slate-100 dark:bg-gray-800">÷</button>
                <button id="btnClear" class="btn bg-rose-100 dark:bg-rose-900/30 text-rose-900 dark:text-rose-200">C</button>

                <button data-key="4" class="btn bg-emerald-100/70 dark:bg-gray-800">4</button>
                <button data-key="5" class="btn bg-emerald-100/70 dark:bg-gray-800">5</button>
                <button data-key="6" class="btn bg-emerald-100/70 dark:bg-gray-800">6</button>
                <button data-op="*" class="btn bg-slate-100 dark:bg-gray-800">×</button>
                <button data-op="-" class="btn bg-slate-100 dark:bg-gray-800">−</button>

                <button data-key="1" class="btn bg-emerald-100/70 dark:bg-gray-800">1</button>
                <button data-key="2" class="btn bg-emerald-100/70 dark:bg-gray-800">2</button>
                <button data-key="3" class="btn bg-emerald-100/70 dark:bg-gray-800">3</button>
                <button data-op="+" class="btn bg-slate-100 dark:bg-gray-800">+</button>
                <button data-op="^" class="btn bg-slate-100 dark:bg-gray-800">^</button>

                <button data-key="0" class="col-span-2 btn bg-emerald-100/70 dark:bg-gray-800">0</button>
                <button data-key="." class="btn bg-emerald-100/70 dark:bg-gray-800">.</button>
                <button data-fn="percent" class="btn bg-slate-100 dark:bg-gray-800">%</button>
                <button id="btnEq" class="btn bg-gray-900 text-white dark:bg-white dark:text-gray-900">=</button>
            </div>

            <!-- HISTORY -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">History</div>
                    <button id="btnClearHist"
                        class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Clear</button>
                </div>
                <div id="history"
                    class="scroll-area h-[280px] overflow-y-auto rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white dark:bg-gray-900 p-2 text-sm"></div>
            </div>
        </div>
    </div>
</div>