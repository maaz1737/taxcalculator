<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Scrollbar styling (light/dark) scoped to the calculator wrapper */
        #sciCalc {
            --scroll-thumb: rgba(100, 116, 139, .6);
            --scroll-thumb-hover: rgba(71, 85, 105, .8);
            --scroll-track: rgba(241, 245, 249, .9);
        }

        .dark #sciCalc {
            --scroll-thumb: rgba(148, 163, 184, .5);
            --scroll-thumb-hover: rgba(203, 213, 225, .6);
            --scroll-track: rgba(17, 24, 39, .85);
        }

        #sciCalc .scroll-area {
            scrollbar-width: thin;
            scrollbar-color: var(--scroll-thumb) var(--scroll-track);
        }

        #sciCalc .scroll-area::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        #sciCalc .scroll-area::-webkit-scrollbar-track {
            background: var(--scroll-track);
            border-radius: 9999px;
        }

        #sciCalc .scroll-area::-webkit-scrollbar-thumb {
            background: var(--scroll-thumb);
            border-radius: 9999px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #sciCalc .scroll-area:hover::-webkit-scrollbar-thumb {
            background: var(--scroll-thumb-hover);
        }

        /* Button press animation */
        .btn:active {
            transform: translateY(1px);
        }

        /* Prevent text selection on buttons */
        .btn {
            user-select: none;
        }
    </style>
</head>

    <div id="sciCalc" class="min-h-full flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-3xl">
            <div class="rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900 overflow-hidden">
                <!-- Header / Controls -->
                <div class="flex items-center justify-between px-5 py-3 bg-gray-100/70 dark:bg-gray-800/70 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Scientific Calculator</h1>
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
                    </div>
                </div>

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

    <script>
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
    </script>

</body>

</html>