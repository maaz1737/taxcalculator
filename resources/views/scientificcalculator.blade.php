<x-app
    :title="'Advanced Scientific Calculator | Free Online Calculator with Functions'"
    :des="'Use our advanced scientific calculator online for free. Perform complex calculations like trigonometric, logarithmic, and exponential functions instantly and easily.'"
    :key="'scientific calculator, online calculator, sin cos tan, trigonometric calculator, math tools, advanced calculator'" />

<div class="h-screen flex items-center justify-center bg-gradient-to-br from-slate-800 via-slate-900 to-slate-950 dark:from-slate-900 dark:via-slate-900/90 dark:to-black px-3 sm:px-6 py-4 sm:py-8">
    <div class="w-full max-w-md sm:max-w-3xl lg:max-w-5xl h-[95vh] flex flex-col transition-all duration-300">

        <div class="flex-1 rounded-3xl shadow-2xl ring-1 ring-slate-200/50 dark:ring-slate-700/60 backdrop-blur-xl bg-gradient-to-br from-slate-100/70 to-white/60 dark:from-slate-900/70 dark:via-slate-900/70 dark:to-slate-950/70 overflow-hidden flex flex-col">

            <!-- Header -->
            <div class="flex items-center justify-between px-4 sm:px-6 py-3 bg-gradient-to-r from-slate-200/70 via-slate-100/70 to-white/60 dark:from-slate-900/70 dark:via-slate-900/70 dark:to-slate-950/70 border-b border-slate-200/50 dark:border-slate-700/50 shrink-0">
                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                    <h1 class="text-lg sm:text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Scientific Calculator</h1>
                    <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">(Keyboard Friendly)</span>
                </div>
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                        Angle:
                        <select id="angleMode" class="px-2 py-1 rounded-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900/70 text-gray-900 dark:text-white">
                            <option value="deg">Deg</option>
                            <option value="rad" selected>Rad</option>
                        </select>
                    </label>
                    <button id="btnClearAll" class="px-3 py-1.5 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-rose-500 to-rose-700 hover:from-rose-600 hover:to-rose-800 focus:ring-2 focus:ring-rose-300">AC</button>
                </div>
            </div>

            <!-- Display -->
            <div class="px-4 sm:px-6 pt-4 pb-3 bg-white/60 dark:bg-slate-900/70 shrink-0">
                <div class="text-right text-xs sm:text-sm text-gray-500 dark:text-gray-400 h-5" id="displayExpr">&nbsp;</div>
                <div class="mt-1 text-right text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-gray-900 dark:text-white select-text drop-shadow-sm" id="displayValue">0</div>
                <div class="flex items-center justify-between mt-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                    <div>
                        <span class="mr-3">Mem: <span id="memIndicator" class="text-indigo-600 dark:text-indigo-400 font-medium">0</span></span>
                        <span>Ans: <span id="ansIndicator" class="text-emerald-600 dark:text-emerald-400 font-medium">0</span></span>
                    </div>
                    <div id="errorMsg" class="text-rose-600 font-medium"></div>
                </div>
            </div>

            <!-- Keypad + History -->
            <div class="flex-1 grid grid-cols-1 lg:grid-cols-5 gap-2 sm:gap-3 p-2 sm:p-4 bg-gradient-to-b from-slate-50/80 to-white/60 dark:from-slate-900/70 dark:to-slate-950/70 overflow-hidden">

                <!-- Keypad -->
                <div class="lg:col-span-3 grid grid-cols-4 sm:grid-cols-5 gap-1.5 sm:gap-2 overflow-y-auto">
                    @php
                    $btnClass = 'btn rounded-lg px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm md:text-base font-semibold text-gray-900 dark:text-white bg-white/90 dark:bg-slate-900/70 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-150 transform';
                    @endphp

                    <!-- Memory -->
                    <button data-key="MC" class="{{ $btnClass }}">MC</button>
                    <button data-key="MR" class="{{ $btnClass }}">MR</button>
                    <button data-key="M+" class="{{ $btnClass }}">M+</button>
                    <button data-key="M-" class="{{ $btnClass }}">M-</button>
                    <button data-key="DEL" class="{{ $btnClass }} bg-amber-100 dark:bg-amber-900/30 text-amber-900 dark:text-amber-200">⌫</button>

                    <!-- Functions -->
                    <button data-fn="sin" class="{{ $btnClass }}">sin</button>
                    <button data-fn="cos" class="{{ $btnClass }}">cos</button>
                    <button data-fn="tan" class="{{ $btnClass }}">tan</button>
                    <button data-fn="ln" class="{{ $btnClass }}">ln</button>
                    <button data-fn="log" class="{{ $btnClass }}">log</button>

                    <button data-fn="sqrt" class="{{ $btnClass }}">√</button>
                    <button data-fn="square" class="{{ $btnClass }}">x²</button>
                    <button data-fn="pow" class="{{ $btnClass }}">xʸ</button>
                    <button data-fn="recip" class="{{ $btnClass }}">1/x</button>
                    <button data-fn="fact" class="{{ $btnClass }}">x!</button>

                    <button data-key="(" class="{{ $btnClass }}">(</button>
                    <button data-key=")" class="{{ $btnClass }}">)</button>
                    <button data-key="pi" class="{{ $btnClass }}">π</button>
                    <button data-key="e" class="{{ $btnClass }}">e</button>
                    <button data-fn="sign" class="{{ $btnClass }}">±</button>

                    <button data-key="7" class="{{ $btnClass }}">7</button>
                    <button data-key="8" class="{{ $btnClass }}">8</button>
                    <button data-key="9" class="{{ $btnClass }}">9</button>
                    <button data-op="/" class="{{ $btnClass }}">÷</button>
                    <button id="btnClear" class="{{ $btnClass }} bg-rose-100 dark:bg-rose-900/30 text-rose-900 dark:text-rose-200">C</button>

                    <button data-key="4" class="{{ $btnClass }}">4</button>
                    <button data-key="5" class="{{ $btnClass }}">5</button>
                    <button data-key="6" class="{{ $btnClass }}">6</button>
                    <button data-op="*" class="{{ $btnClass }}">×</button>
                    <button data-op="-" class="{{ $btnClass }}">−</button>

                    <button data-key="1" class="{{ $btnClass }}">1</button>
                    <button data-key="2" class="{{ $btnClass }}">2</button>
                    <button data-key="3" class="{{ $btnClass }}">3</button>
                    <button data-op="+" class="{{ $btnClass }}">+</button>
                    <button data-op="^" class="{{ $btnClass }}">^</button>

                    <button data-key="0" class="col-span-2 {{ $btnClass }}">0</button>
                    <button data-key="." class="{{ $btnClass }}">.</button>
                    <button data-fn="percent" class="{{ $btnClass }}">%</button>
                    <button id="btnEq" class="{{ $btnClass }} bg-gray-900 text-white dark:bg-white dark:text-gray-900">=</button>
                </div>

                <!-- History -->
                <div class="lg:col-span-2 flex flex-col overflow-hidden">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">History</h2>
                        <button id="btnClearHist" class="text-xs text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">Clear</button>
                    </div>
                    <div id="history" class="flex-1 overflow-y-auto rounded-xl border border-slate-200/50 dark:border-slate-700/50 bg-white/70 dark:bg-slate-900/70 p-3 text-sm shadow-inner"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<x-appfooter />