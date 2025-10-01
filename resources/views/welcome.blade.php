<x-app>Calculators</x-app>
<main class="min-h-[70vh]">
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-head dark:text-white">
                    Calculate smarter—instantly
                </h1>
                <p class="mt-3 text-slate-600 dark:text-slate-400">
                    All your Fitness, Finance, Health, and Utility calculators in one fast, beautiful place.
                </p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ url('/calculators') }}" class="rounded-xl bg-brand px-5 py-3 text-white font-semibold hover:bg-blue-600 transition">Browse Calculators</a>
                    <a href="{{ url('/builder') }}" class="rounded-xl border border-slate-200 px-5 py-3 hover:border-brand/30 hover:bg-white transition dark:border-slate-700 dark:hover:bg-slate-800">Create Your Own</a>
                </div>
            </div>
            <div class="lg:justify-self-end">
                <div class="rounded-2xl border border-slate-200 bg-white/70 p-6 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="text-sm text-slate-500 mb-2">Quick Access</div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                        $quick = [
                        ['name'=>'BMI','desc'=>'Body Mass Index','href'=>url('/calculators/bmi')],
                        ['name'=>'BMR','desc'=>'Basal Metabolic Rate','href'=>url('/calculators/bmr')],
                        ['name'=>'TDEE','desc'=>'Daily Energy Expenditure','href'=>url('/calculators/tdee')],
                        ['name'=>'Body Fat','desc'=>'US Navy method','href'=>url('/calculators/body-fat')],
                        ['name'=>'Loan EMI','desc'=>'Finance','href'=>url('/calculators/emi')],
                        ['name'=>'Unit Convert','desc'=>'Converters','href'=>url('/calculators/convert')],
                        ];
                        @endphp
                        @foreach($quick as $c)
                        <a href="{{ $c['href'] }}" class="group rounded-xl border border-slate-200 bg-white p-4 hover:shadow-card transition dark:bg-slate-900 dark:border-slate-700">
                            <div class="font-semibold">{{ $c['name'] }}</div>
                            <div class="text-xs text-slate-500">{{ $c['desc'] }}</div>
                            <div class="mt-3 text-brand text-sm opacity-0 group-hover:opacity-100 transition">Open →</div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Calculators -->
    {{-- your existing section (unchanged except data-open-form + href="#") --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">Featured Calculators</h2>
            <a href="{{ url('/calculators') }}" class="text-sm text-brand hover:underline">View all</a>
        </div>

        @php
        $featured = [
        ['id'=>'openPopupCalculator','title'=>'Arithmatic Calculator','tag'=>'calculator','summary'=>'Arthmetic Operations','name'=>'Open Calculator'],
        ['id'=>'openPopupSalaryCalculator','title'=>'Salary Calculator','tag'=>'Salary','summary'=>'Salary Calculator','name'=>'Open Salary Calculator'],
        ['id'=>'openPopupRentCalculator','title'=>'Rent Calculator','tag'=>'Rent','summary'=>'Rent Category','name'=>'Open Rent Calculator'],
        ['id'=>'openPopupDepreciationCalculator','title'=>'Depreciation Calculator','tag'=>'Depreciation','summary'=>'Check your BMI & category','name'=>'Open Depreciation Calculator'],
        ['id'=>'openPopupMortgageCalculator','title'=>'Mortgage Calculator','tag'=>'Mortgage','summary'=>'Mortgage Calculator','name'=>'Open Mortgage Calculator'],
        ['id'=>'openPopupVolumeConverter','title'=>'volume Calculator','tag'=>'volume','summary'=>'volume converter','name'=>'Open Volume Converter'],
        ['id'=>'openPopupTimeConverter','title'=>'Time Calculator','tag'=>'Time','summary'=>'Time Converter','name'=>'Open Time Converter'],

        ['id'=>'openPopupTemperatureConverter','title'=>'Temperature Calculator','tag'=>'Temperature','summary'=>'Temperature Converter','name'=>'Open Temperature Converter '],
        ['id'=>'openPopupWeightConverter','title'=>'Weight Calculator','tag'=>'Weight','summary'=>'weight converter','name'=>'Open Weight Converter'],
        ['id'=>'openPopupAreaConverterNew','title'=>'Area Converter','tag'=>'Area','summary'=>'Calculate area','name'=>'Open Area Converter'],
        ['id'=>"openPopupLengthConverter",'title'=>'Length Converter','tag'=>'length','summary'=>'Convert Length','name'=>'Open length Calculator'],
        ['id'=>'openFitnessBtn','title'=>'Fitness Calculator','tag'=>'Fitness','summary'=>'check your BMI & BMR','name'=>'Open Fitness Calculator'],
        ['id'=>'openPopupTaxCalculator','title'=>'openPopupTaxCalculator','tag'=>'Income Tax','summary'=>'Check your BMI & category','name'=>'Open tax Calculator'],

        ];
        @endphp


        <x-card :featured="$featured" />



        <!-- Categories carousel -->
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <h2 class="text-xl font-bold mb-3">Categories</h2>
            <div class="flex gap-3 overflow-x-auto pb-2">
                @foreach (['Fitness','Finance','Converters','Health','Utilities','Engineering','Other'] as $cat)
                <a href="{{ url('/categories/'.strtolower($cat)) }}"
                    class="shrink-0 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm hover:border-brand/30 hover:bg-white transition dark:bg-slate-800 dark:border-slate-700">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
        </section>

        <!-- Why BRAND -->
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
            <h2 class="text-xl font-bold mb-4">Why [BRAND]</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Accuracy</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Well-tested formulas and unit handling.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Speed (AJAX)</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Instant results with debounced requests.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-card dark:bg-slate-800 dark:border-slate-700">
                    <div class="font-semibold mb-1">Privacy</div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Local storage for history; sync when logged in.</p>
                </div>
            </div>
        </section>

        <x-bmimodel />
        <x-bmi />
        <x-lengthmodel />
        <x-areamodel />
        <x-weightmodel />
        <x-temperaturemodel />
        <x-timemodel />
        <x-volumemodel />
        <x-depreciationmodel />
        <x-rentmodel />
        <x-salarymodel />
        <x-simplecalculator />
        <x-incometax />
        <x-mortgagemodel />







</main>


<button id="openSciCalc"
    class="rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">
    Open Scientific Calculator
</button>
<!-- Modal -->
<div id="sciCalcModal"
    class="fixed inset-0 z-[80] hidden opacity-0 pointer-events-none transition-opacity duration-200"
    role="dialog" aria-modal="true" aria-labelledby="sciCalcTitle" aria-hidden="true">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" data-overlay></div>

    <!-- Panel -->
    <div class="relative mx-auto my-8 w-[min(960px,95vw)] max-h-[90vh]">
        <!-- Your calculator card (unchanged styles) -->
        <div id="sciCalc" class="rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 overflow-hidden">

            <!-- Header / Controls (made sticky + added close button) -->
            <div class="sticky top-0 left-0 flex items-center justify-between px-5 py-3 bg-gray-100/70 dark:bg-gray-800/70 backdrop-blur border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-2">
                    <h1 id="sciCalcTitle" class="text-lg font-semibold text-gray-900 dark:text-white">Scientific Calculator</h1>
                    <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">(keyboard friendly)</span>
                </div>
                <div class="flex items-center gap-2">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                        Angle:
                        <select id="angleMode" class="px-2 py-1 rounded-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            <option value="deg">Deg</option>
                            <option value="rad" selected>Rad</option>
                        </select>
                    </label>
                    <button id="btnClearAll" class="btn rounded-md px-3 py-1.5 text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-300">AC</button>

                    <!-- Close (X) -->
                    <button id="closeSciCalc"
                        class="ml-1 inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-200/70 dark:text-gray-300 dark:hover:text-gray-100 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                        aria-label="Close">✕</button>
                </div>
            </div>

            <!-- ====== your existing calculator body (Display, Keypad, History, etc.) goes here unchanged ====== -->
            <!-- Keep all your existing HTML from “Display” to the end of the grid, exactly as you had it. -->
            <!-- (I omitted it here for brevity, but you can paste your current “Display + Keypad + History” block) -->

            <!-- Display -->
            <div class="px-5 pt-5">
                <div class="text-right text-xs text-gray-500 dark:text-gray-400 h-5" id="displayExpr">&nbsp;</div>
                <div class="mt-1 text-right text-4xl sm:text-5xl font-semibold tracking-tight text-gray-900 dark:text-white leading-tight select-text" id="displayValue">0</div>
                <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                    <div>
                        <span class="mr-2">Mem: <span id="memIndicator">0</span></span>
                        <span>Ans: <span id="ansIndicator">0</span></span>
                    </div>
                    <div id="errorMsg" class="text-rose-600"></div>
                </div>
            </div>

            <div id="sciCalc" class="min-h-full flex items-center justify-center px-4 py-10">
                <div class="w-full max-w-3xl">
                    <div class="rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 overflow-hidden">
                        <!-- Header / Controls -->




                        <!-- Keypad & History -->
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 p-5">
                            <!-- KEYPAD (spans 3-4 cols) -->
                            <div class="lg:col-span-3 grid grid-cols-5 gap-2">
                                <!-- Memory & edit row -->
                                <button data-key="MC" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">MC</button>
                                <button data-key="MR" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">MR</button>
                                <button data-key="M+" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">M+</button>
                                <button data-key="M-" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">M-</button>
                                <button data-key="DEL" class="btn rounded-lg px-3 py-2 bg-amber-100 hover:bg-amber-200 text-amber-900 dark:bg-amber-900/30 dark:text-amber-200">⌫</button>

                                <!-- Functions row -->
                                <button data-fn="sin" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">sin</button>
                                <button data-fn="cos" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">cos</button>
                                <button data-fn="tan" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">tan</button>
                                <button data-fn="ln" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">ln</button>
                                <button data-fn="log" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">log</button>

                                <!-- More functions -->
                                <button data-fn="sqrt" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">√</button>
                                <button data-fn="square" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">x²</button>
                                <button data-fn="pow" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">xʸ</button>
                                <button data-fn="recip" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">1/x</button>
                                <button data-fn="fact" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">x!</button>

                                <!-- Parentheses & constants -->
                                <button data-key="(" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">(</button>
                                <button data-key=")" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">)</button>
                                <button data-key="pi" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">π</button>
                                <button data-key="e" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">e</button>
                                <button data-fn="sign" class="btn rounded-lg px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">±</button>

                                <!-- Digits & ops -->
                                <button data-key="7" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">7</button>
                                <button data-key="8" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">8</button>
                                <button data-key="9" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">9</button>
                                <button data-op="/" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">÷</button>
                                <button id="btnClear" class="btn rounded-lg px-3 py-3 bg-rose-100 hover:bg-rose-200 text-rose-900 dark:bg-rose-900/30 dark:text-rose-200">C</button>

                                <button data-key="4" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">4</button>
                                <button data-key="5" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">5</button>
                                <button data-key="6" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">6</button>
                                <button data-op="*" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">×</button>
                                <button data-op="-" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">−</button>

                                <button data-key="1" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">1</button>
                                <button data-key="2" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">2</button>
                                <button data-key="3" class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">3</button>
                                <button data-op="+" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">+</button>
                                <button data-op="^" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">^</button>

                                <button data-key="0" class="col-span-2 btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">0</button>
                                <button data-key="." class="btn rounded-lg px-3 py-3 bg-white hover:bg-gray-100 text-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">.</button>
                                <button data-fn="percent" class="btn rounded-lg px-3 py-3 bg-slate-100 hover:bg-slate-200 text-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">%</button>
                                <button id="btnEq" class="btn rounded-lg px-3 py-3 bg-gray-900 hover:bg-gray-800 text-white dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">=</button>
                            </div>

                            <!-- HISTORY (spans remaining cols) -->
                            <div class="lg:col-span-2">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300">History</div>
                                    <button id="btnClearHist" class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Clear</button>
                                </div>
                                <div id="history" class="scroll-area h-[320px] overflow-y-auto rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white dark:bg-gray-900 p-3 text-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    (function() {
        const modal = document.getElementById('sciCalcModal');
        const overlay = modal.querySelector('[data-overlay]');
        const openBtn = document.getElementById('openSciCalc');
        const closeBtn = document.getElementById('closeSciCalc');
        const firstFocus = document.getElementById('angleMode'); // where we focus on open

        const isOpen = () => !modal.classList.contains('hidden');

        function openModal() {
            modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
            modal.removeAttribute('aria-hidden');
            document.documentElement.classList.add('overflow-hidden');
            setTimeout(() => firstFocus?.focus({
                preventScroll: true
            }), 0);
        }

        function closeModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.setAttribute('aria-hidden', 'true');
            document.documentElement.classList.remove('overflow-hidden');
            // after fade, hide
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        openBtn?.addEventListener('click', openModal);
        closeBtn?.addEventListener('click', closeModal);
        overlay?.addEventListener('click', closeModal);

        // Close on ESC only when open
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isOpen()) closeModal();
        });

        (() => {
            // ====== ELEMENTS ======
            const displayExpr = document.getElementById('displayExpr');
            const displayValue = document.getElementById('displayValue');
            const errorMsg = document.getElementById('errorMsg');
            const angleModeEl = document.getElementById('angleMode');
            const memIndicator = document.getElementById('memIndicator');
            const ansIndicator = document.getElementById('ansIndicator');
            const historyEl = document.getElementById('history');

            // ====== STATE ======
            let input = '';
            let lastAns = 0;
            let memory = 0;
            const insStack = []; // tracks insertions as chunks: { len:number, origin:'btn'|'key' }

            // ====== CONSTANTS & HELPERS ======
            const CONSTANTS = {
                'pi': Math.PI,
                'π': Math.PI,
                'e': Math.E
            };
            const PRECEDENCE = {
                'u-': 5,
                '!': 5,
                '%': 5,
                '^': 4,
                '*': 3,
                '/': 3,
                '+': 2,
                '-': 2
            };
            const RIGHT_ASSOC = {
                '^': true,
                'u-': true
            };

            const isDigit = (c) => /[0-9]/.test(c);
            const isAlpha = (c) => /[a-zA-Zµπ]/.test(c);

            function escapeHtml(s) {
                return (s || '').replace(/[&<>\"']/g, m => ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    "\"": "&quot;",
                    "'": "&#39;"
                } [m]));
            }

            function render() {
                if (displayExpr) displayExpr.textContent = input || '\u00A0';
            }

            function formatNum(n) {
                if (!Number.isFinite(n)) return '∞';
                const abs = Math.abs(n);
                if (abs !== 0 && (abs < 1e-6 || abs >= 1e9)) return n.toExponential(10).replace(/0+e/, 'e');
                return (+n.toFixed(12)).toString();
            }

            function push(s, origin = 'btn') {
                input += s;
                insStack.push({
                    len: s.length,
                    origin
                });
                render();
            }

            function setInput(s, origin = 'set') {
                input = s || '';
                insStack.length = 0;
                if (origin === 'btn') {
                    insStack.push({
                        len: input.length,
                        origin: 'btn'
                    });
                } else {
                    for (let i = 0; i < input.length; i++) insStack.push({
                        len: 1,
                        origin: 'key'
                    });
                }
                render();
            }

            function clearAll() {
                setInput('');
                if (displayValue) displayValue.textContent = '0';
                if (errorMsg) errorMsg.textContent = '';
            }

            function delOne() {
                if (!input.length) return;
                if (insStack.length) {
                    const {
                        len
                    } = insStack.pop();
                    input = input.slice(0, -len);
                } else {
                    input = input.slice(0, -1);
                }
                render();
            }

            // ====== TOKENIZER ======
            function tokenize(expr) {
                const tokens = [];
                let i = 0,
                    prev = null;
                while (i < expr.length) {
                    let c = expr[i];
                    if (c === ' ') {
                        i++;
                        continue;
                    }

                    // number
                    if (isDigit(c) || (c === '.' && isDigit(expr[i + 1]))) {
                        let s = c;
                        i++;
                        while (i < expr.length && /[0-9.]/.test(expr[i])) s += expr[i++];
                        tokens.push({
                            type: 'num',
                            val: parseFloat(s)
                        });
                        prev = 'num';
                        continue;
                    }

                    // constants
                    if (c === 'π') {
                        tokens.push({
                            type: 'num',
                            val: Math.PI
                        });
                        i++;
                        prev = 'num';
                        continue;
                    }
                    if (c in CONSTANTS) {
                        tokens.push({
                            type: 'num',
                            val: CONSTANTS[c]
                        });
                        i++;
                        prev = 'num';
                        continue;
                    }

                    // identifier (function name)
                    if (isAlpha(c)) {
                        let s = c;
                        i++;
                        while (i < expr.length && /[a-zA-Z0-9_µ]/.test(expr[i])) s += expr[i++];
                        tokens.push({
                            type: 'id',
                            val: s.toLowerCase()
                        });
                        prev = 'id';
                        continue;
                    }

                    // parentheses
                    if (c === '(' || c === ')') {
                        tokens.push({
                            type: c
                        });
                        i++;
                        prev = c;
                        continue;
                    }

                    // postfix & percent
                    if (c === '!' || c === '%') {
                        tokens.push({
                            type: 'op',
                            val: c
                        });
                        i++;
                        prev = 'op';
                        continue;
                    }

                    // operators (detect unary -)
                    if ('+-*/^'.includes(c)) {
                        if (c === '-' && (prev == null || (prev !== 'num' && prev !== ')'))) {
                            tokens.push({
                                type: 'op',
                                val: 'u-'
                            });
                            i++;
                            prev = 'op';
                            continue;
                        }
                        tokens.push({
                            type: 'op',
                            val: c
                        });
                        i++;
                        prev = 'op';
                        continue;
                    }

                    throw new Error('Unexpected character: ' + c);
                }
                return tokens;
            }

            // ====== SHUNTING-YARD ======
            function shuntingYard(tokens) {
                const out = [],
                    stack = [];
                for (const t of tokens) {
                    if (t.type === 'num') {
                        out.push(t);
                        continue;
                    }
                    if (t.type === 'id') {
                        stack.push(t);
                        continue;
                    } // function name before '('
                    if (t.type === 'op') {
                        while (stack.length) {
                            const top = stack[stack.length - 1];
                            if (top.type === 'op' && ((RIGHT_ASSOC[t.val] ? PRECEDENCE[t.val] < PRECEDENCE[top.val] : PRECEDENCE[t.val] <= PRECEDENCE[top.val]))) {
                                out.push(stack.pop());
                            } else break;
                        }
                        stack.push(t);
                        continue;
                    }
                    if (t.type === '(') {
                        stack.push(t);
                        continue;
                    }
                    if (t.type === ')') {
                        while (stack.length && stack[stack.length - 1].type !== '(') out.push(stack.pop());
                        if (!stack.length) throw new Error('Mismatched parentheses');
                        stack.pop(); // pop '('
                        // if function on top, pop it to output (unary funcs)
                        if (stack.length && stack[stack.length - 1].type === 'id') out.push(stack.pop());
                        continue;
                    }
                }
                while (stack.length) {
                    const x = stack.pop();
                    if (x.type === '(' || x.type === ')') throw new Error('Mismatched parentheses');
                    out.push(x);
                }
                return out;
            }

            // ====== EVALUATOR ======
            function factorial(n) {
                if (!Number.isFinite(n) || n < 0) throw new Error('Invalid factorial');
                if (Math.floor(n) !== n) throw new Error('Factorial only for integers');
                let r = 1;
                for (let i = 2; i <= n; i++) r *= i;
                return r;
            }
            const toRadians = (x) => angleModeEl && angleModeEl.value === 'deg' ? (x * Math.PI / 180) : x;
            const fromRadians = (x) => angleModeEl && angleModeEl.value === 'deg' ? (x * 180 / Math.PI) : x;

            function evalRPN(rpn) {
                const st = [];
                for (const t of rpn) {
                    if (t.type === 'num') {
                        st.push(t.val);
                        continue;
                    }

                    if (t.type === 'op') {
                        if (t.val === 'u-') {
                            const a = st.pop();
                            st.push(-a);
                            continue;
                        }
                        if (t.val === '!') {
                            const a = st.pop();
                            st.push(factorial(a));
                            continue;
                        }
                        if (t.val === '%') {
                            const a = st.pop();
                            st.push(a / 100);
                            continue;
                        }
                        const b = st.pop(),
                            a = st.pop();
                        switch (t.val) {
                            case '+':
                                st.push(a + b);
                                break;
                            case '-':
                                st.push(a - b);
                                break;
                            case '*':
                                st.push(a * b);
                                break;
                            case '/':
                                st.push(a / b);
                                break;
                            case '^':
                                st.push(Math.pow(a, b));
                                break;
                        }
                        continue;
                    }

                    if (t.type === 'id') {
                        const fn = t.val;
                        let a;
                        switch (fn) {
                            case 'sin':
                                a = toRadians(st.pop());
                                st.push(Math.sin(a));
                                break;
                            case 'cos':
                                a = toRadians(st.pop());
                                st.push(Math.cos(a));
                                break;
                            case 'tan':
                                a = toRadians(st.pop());
                                st.push(Math.tan(a));
                                break;
                            case 'asin':
                                a = st.pop();
                                st.push(fromRadians(Math.asin(a)));
                                break;
                            case 'acos':
                                a = st.pop();
                                st.push(fromRadians(Math.acos(a)));
                                break;
                            case 'atan':
                                a = st.pop();
                                st.push(fromRadians(Math.atan(a)));
                                break;
                            case 'ln':
                                a = st.pop();
                                st.push(Math.log(a));
                                break;
                            case 'log':
                                a = st.pop();
                                st.push(Math.log10(a));
                                break;
                            case 'sqrt':
                                a = st.pop();
                                st.push(Math.sqrt(a));
                                break;
                            case 'square':
                                a = st.pop();
                                st.push(a * a);
                                break;
                            case 'recip':
                                a = st.pop();
                                st.push(1 / a);
                                break;
                            case 'sign':
                                a = st.pop();
                                st.push(-a);
                                break;
                            default:
                                throw new Error('Unknown fn: ' + fn);
                        }
                        continue;
                    }
                    throw new Error('Bad token');
                }
                if (st.length !== 1) throw new Error('Malformed expression');
                return st[0];
            }

            // ====== CALCULATE & HISTORY ======
            function calculate() {
                try {
                    if (errorMsg) errorMsg.textContent = '';
                    const tokens = tokenize(input);
                    const rpn = shuntingYard(tokens);
                    const val = evalRPN(rpn);
                    lastAns = val;
                    if (ansIndicator) ansIndicator.textContent = formatNum(val);
                    if (displayValue) displayValue.textContent = formatNum(val);
                    appendHistory(input, val);
                } catch (e) {
                    if (errorMsg) errorMsg.textContent = e.message || 'Error';
                }
            }

            function appendHistory(expr, result) {
                if (!historyEl) return;
                const row = document.createElement('div');
                row.className = 'group flex items-start justify-between gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800';
                row.innerHTML = `
      <div>
        <div class="text-gray-500 dark:text-gray-400">${escapeHtml(expr)}</div>
        <div class="font-medium text-gray-900 dark:text-gray-100">${formatNum(result)}</div>
      </div>
      <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
        <button class="text-xs text-blue-600 dark:text-blue-400 hover:underline" data-act="use">Use</button>
        <button class="text-xs text-rose-600 dark:text-rose-400 hover:underline" data-act="del">Delete</button>
      </div>`;
                row.addEventListener('click', (e) => {
                    const act = e.target.getAttribute('data-act');
                    if (act === 'use') {
                        setInput(expr);
                        if (displayValue) displayValue.textContent = '0';
                    }
                    if (act === 'del') {
                        row.remove();
                    }
                });
                historyEl.prepend(row);
            }

            // ====== CLICK HANDLER ======
            document.addEventListener('click', (e) => {
                const b = e.target.closest('button');
                if (!b) return;

                // common buttons by id
                if (b.id === 'btnClear') {
                    setInput('');
                    return;
                }
                if (b.id === 'btnClearAll') {
                    clearAll();
                    return;
                }
                if (b.id === 'btnEq') {
                    calculate();
                    return;
                }
                if (b.id === 'btnClearHist') {
                    if (historyEl) historyEl.innerHTML = '';
                    return;
                }

                const key = b.getAttribute('data-key');
                const op = b.getAttribute('data-op');
                const fn = b.getAttribute('data-fn');

                // Keys (digits, constants, memory, DEL)
                if (key) {
                    if (key === 'DEL') {
                        delOne();
                        return;
                    }

                    if (key === 'MC') {
                        memory = 0;
                        if (memIndicator) memIndicator.textContent = '0';
                        return;
                    }
                    if (key === 'MR') {
                        push(formatNum(memory));
                        return;
                    }
                    if (key === 'M+') {
                        const v = parseFloat(displayValue?.textContent || '0') || 0;
                        memory += v;
                        if (memIndicator) memIndicator.textContent = formatNum(memory);
                        return;
                    }
                    if (key === 'M-') {
                        const v = parseFloat(displayValue?.textContent || '0') || 0;
                        memory -= v;
                        if (memIndicator) memIndicator.textContent = formatNum(memory);
                        return;
                    }

                    if (key === 'pi') {
                        push('π');
                        return;
                    }
                    if (key === 'e') {
                        push('e');
                        return;
                    }

                    // numeric or parentheses or dot
                    push(key);
                    return;
                }

                // Operators
                if (op) {
                    push(op);
                    return;
                }

                // Functions
                if (fn) {
                    if (fn === 'percent') {
                        push('%');
                        return;
                    }
                    if (fn === 'pow') {
                        push('^');
                        return;
                    } // xʸ uses ^ operator (no commas needed)
                    if (fn === 'fact') {
                        push('!');
                        return;
                    } // postfix
                    if (fn === 'square') {
                        push('square(');
                        return;
                    }
                    if (fn === 'recip') {
                        push('recip(');
                        return;
                    }
                    if (fn === 'sign') {
                        push('sign(');
                        return;
                    }
                    // default unary with parenthesis
                    if (['sin', 'cos', 'tan', 'asin', 'acos', 'atan', 'ln', 'log', 'sqrt'].includes(fn)) {
                        push(fn + '(');
                        return;
                    }
                }
            });

            // ====== KEYBOARD HANDLER ======
            document.addEventListener('keydown', (e) => {
                if (e.defaultPrevented) return;
                const k = e.key;

                // digits, dot, parens as keyboard chunks
                if (/^[0-9]$/.test(k) || k === '.' || k === '(' || k === ')') {
                    push(k, 'key');
                    return;
                }

                // ops as keyboard chunks
                if (k === '+' || k === '-' || k === '*' || k === '/' || k === '^') {
                    push(k, 'key');
                    return;
                }

                if (k === 'Backspace') {
                    e.preventDefault();
                    delOne();
                    return;
                }
                if (k === 'Enter' || k === '=') {
                    e.preventDefault();
                    calculate();
                    return;
                }
            });

            // init
            render();
        })();
    })();
</script>






<script src="assets/js/simplecalculator.js"></script>
<script src="assets/js/salary.js"></script>
<script src="assets/js/rent.js"></script>
<script src='assets/js/fitness/model.js'></script>
<script src="assets/js/fitness/fitness.js"></script>
<script src="assets/js/length.js"></script>
<script src="assets/js/area.js"></script>
<script src="assets/js/weight.js"> </script>
<script src="assets/js/temperature.js"></script>
<script src="assets/js/time.js"></script>
<script src="assets/js/volume.js"></script>
<script src="assets/js/mortgage.js"></script>
<script src="assets/js/depreciation.js"></script>

<script src="assets/js/filter.js"></script>
<script src="assets/js/taxcalculation.js"></script>


<x-appfooter></x-appfooter>