$(function () {
    const $modal = $("#sciCalcModal");
    const $overlay = $modal.find("[data-overlay]");
    const $openBtn = $("#openSciCalc");
    const $closeBtn = $("#closeSciCalc");
    const $firstFocus = $("#angleMode");
    const $sci_errors = $("#sci_errors");
    const $btnClearHist = $("#btnClearHist");

    const isOpen = () => !$modal.hasClass("hidden");

    $openBtn.on("click", () => {
        openModal($modal);
    });
    $closeBtn.on("click", () => {
        closeModal($modal);
    });
    $overlay.on("click", () => {
        closeModal($modal);
    });

    // Close on ESC only when open
    $(document).on("keydown", function (e) {
        if (e.key === "Escape" && isOpen()) closeModal();
    });

    // ====== ELEMENTS ======
    const $displayExpr = $("#displayExpr");
    const $displayValue = $("#displayValue");
    const $errorMsg = $("#errorMsg");
    const $angleModeEl = $("#angleMode");
    const $memIndicator = $("#memIndicator");
    const $ansIndicator = $("#ansIndicator");
    const $historyEl = $("#history");

    // ====== STATE ======
    let input = "";
    let lastAns = 0;
    let memory = 0;
    const insStack = []; // tracks insertions as chunks: { len:number, origin:'btn'|'key' }

    // ====== CONSTANTS & HELPERS ======
    const CONSTANTS = {
        pi: Math.PI,
        π: Math.PI,
        e: Math.E,
    };
    const PRECEDENCE = {
        "u-": 5,
        "!": 5,
        "%": 5,
        "^": 4,
        "*": 3,
        "/": 3,
        "+": 2,
        "-": 2,
    };
    const RIGHT_ASSOC = {
        "^": true,
        "u-": true,
    };

    const isDigit = (c) => /[0-9]/.test(c);
    const isAlpha = (c) => /[a-zA-Zµπ]/.test(c);

    function escapeHtml(s) {
        return (s || "").replace(
            /[&<>\"']/g,
            (m) =>
                ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    '"': "&quot;",
                    "'": "&#39;",
                }[m])
        );
    }

    function render() {
        if ($displayExpr.length) $displayExpr.text(input || "\u00A0");
    }

    function formatNum(n) {
        if (!Number.isFinite(n)) return "∞";
        const abs = Math.abs(n);
        if (abs !== 0 && (abs < 1e-6 || abs >= 1e9))
            return n.toExponential(10).replace(/0+e/, "e");
        return (+n.toFixed(12)).toString();
    }

    function push(s, origin = "btn") {
        input += s;
        insStack.push({
            len: s.length,
            origin,
        });
        render();
    }

    function setInput(s, origin = "set") {
        input = s || "";
        insStack.length = 0;
        if (origin === "btn") {
            insStack.push({
                len: input.length,
                origin: "btn",
            });
        } else {
            for (let i = 0; i < input.length; i++)
                insStack.push({
                    len: 1,
                    origin: "key",
                });
        }
        render();
    }

    function clearAll() {
        setInput("");
        if ($displayValue.length) $displayValue.text("0");
        if ($errorMsg.length) $errorMsg.text("");
    }

    function delOne() {
        if (!input.length) return;
        if (insStack.length) {
            const { len } = insStack.pop();
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
            if (c === " ") {
                i++;
                continue;
            }

            // number
            if (isDigit(c) || (c === "." && isDigit(expr[i + 1]))) {
                let s = c;
                i++;
                while (i < expr.length && /[0-9.]/.test(expr[i]))
                    s += expr[i++];
                tokens.push({
                    type: "num",
                    val: parseFloat(s),
                });
                prev = "num";
                continue;
            }

            // constants
            if (c === "π") {
                tokens.push({
                    type: "num",
                    val: Math.PI,
                });
                i++;
                prev = "num";
                continue;
            }
            if (c in CONSTANTS) {
                tokens.push({
                    type: "num",
                    val: CONSTANTS[c],
                });
                i++;
                prev = "num";
                continue;
            }

            // identifier (function name)
            if (isAlpha(c)) {
                let s = c;
                i++;
                while (i < expr.length && /[a-zA-Z0-9_µ]/.test(expr[i]))
                    s += expr[i++];
                tokens.push({
                    type: "id",
                    val: s.toLowerCase(),
                });
                prev = "id";
                continue;
            }

            // parentheses
            if (c === "(" || c === ")") {
                tokens.push({
                    type: c,
                });
                i++;
                prev = c;
                continue;
            }

            // postfix & percent
            if (c === "!" || c === "%") {
                tokens.push({
                    type: "op",
                    val: c,
                });
                i++;
                prev = "op";
                continue;
            }

            // operators (detect unary -)
            if ("+-*/^".includes(c)) {
                if (
                    c === "-" &&
                    (prev == null || (prev !== "num" && prev !== ")"))
                ) {
                    tokens.push({
                        type: "op",
                        val: "u-",
                    });
                    i++;
                    prev = "op";
                    continue;
                }
                tokens.push({
                    type: "op",
                    val: c,
                });
                i++;
                prev = "op";
                continue;
            }

            throw new Error("Unexpected character: " + c);
        }
        return tokens;
    }

    // ====== SHUNTING-YARD ======
    function shuntingYard(tokens) {
        const out = [],
            stack = [];
        for (const t of tokens) {
            if (t.type === "num") {
                out.push(t);
                continue;
            }
            if (t.type === "id") {
                stack.push(t);
                continue;
            } // function name before '('
            if (t.type === "op") {
                while (stack.length) {
                    const top = stack[stack.length - 1];
                    if (
                        top.type === "op" &&
                        (RIGHT_ASSOC[t.val]
                            ? PRECEDENCE[t.val] < PRECEDENCE[top.val]
                            : PRECEDENCE[t.val] <= PRECEDENCE[top.val])
                    ) {
                        out.push(stack.pop());
                    } else break;
                }
                stack.push(t);
                continue;
            }
            if (t.type === "(") {
                stack.push(t);
                continue;
            }
            if (t.type === ")") {
                while (stack.length && stack[stack.length - 1].type !== "(")
                    out.push(stack.pop());
                if (!stack.length) throw new Error("Mismatched parentheses");
                stack.pop(); // pop '('
                if (stack.length && stack[stack.length - 1].type === "id")
                    out.push(stack.pop());
                continue;
            }
        }
        while (stack.length) {
            const x = stack.pop();
            if (x.type === "(" || x.type === ")")
                throw new Error("Mismatched parentheses");
            out.push(x);
        }
        return out;
    }

    // ====== EVALUATOR ======
    function factorial(n) {
        if (!Number.isFinite(n) || n < 0) throw new Error("Invalid factorial");
        if (Math.floor(n) !== n) throw new Error("Factorial only for integers");
        let r = 1;
        for (let i = 2; i <= n; i++) r *= i;
        return r;
    }
    const toRadians = (x) =>
        $angleModeEl.length && $angleModeEl.val() === "deg"
            ? (x * Math.PI) / 180
            : x;
    const fromRadians = (x) =>
        $angleModeEl.length && $angleModeEl.val() === "deg"
            ? (x * 180) / Math.PI
            : x;

    function evalRPN(rpn) {
        const st = [];
        for (const t of rpn) {
            if (t.type === "num") {
                st.push(t.val);
                continue;
            }

            if (t.type === "op") {
                if (t.val === "u-") {
                    const a = st.pop();
                    st.push(-a);
                    continue;
                }
                if (t.val === "!") {
                    const a = st.pop();
                    st.push(factorial(a));
                    continue;
                }
                if (t.val === "%") {
                    const a = st.pop();
                    st.push(a / 100);
                    continue;
                }
                const b = st.pop(),
                    a = st.pop();
                switch (t.val) {
                    case "+":
                        st.push(a + b);
                        break;
                    case "-":
                        st.push(a - b);
                        break;
                    case "*":
                        st.push(a * b);
                        break;
                    case "/":
                        st.push(a / b);
                        break;
                    case "^":
                        st.push(Math.pow(a, b));
                        break;
                }
                continue;
            }

            if (t.type === "id") {
                const fn = t.val;
                let a;
                switch (fn) {
                    case "sin":
                        a = toRadians(st.pop());
                        st.push(Math.sin(a));
                        break;
                    case "cos":
                        a = toRadians(st.pop());
                        st.push(Math.cos(a));
                        break;
                    case "tan":
                        a = toRadians(st.pop());
                        st.push(Math.tan(a));
                        break;
                    case "asin":
                        a = st.pop();
                        st.push(fromRadians(Math.asin(a)));
                        break;
                    case "acos":
                        a = st.pop();
                        st.push(fromRadians(Math.acos(a)));
                        break;
                    case "atan":
                        a = st.pop();
                        st.push(fromRadians(Math.atan(a)));
                        break;
                    case "ln":
                        a = st.pop();
                        st.push(Math.log(a));
                        break;
                    case "log":
                        a = st.pop();
                        st.push(Math.log10(a));
                        break;
                    case "sqrt":
                        a = st.pop();
                        st.push(Math.sqrt(a));
                        break;
                    case "square":
                        a = st.pop();
                        st.push(a * a);
                        break;
                    case "recip":
                        a = st.pop();
                        st.push(1 / a);
                        break;
                    case "sign":
                        a = st.pop();
                        st.push(-a);
                        break;
                    default:
                        throw new Error("Unknown fn: " + fn);
                }
                continue;
            }
            throw new Error("Bad token");
        }
        if (st.length !== 1) throw new Error("Malformed expression");
        return st[0];
    }

    // ====== CALCULATE & HISTORY ======
    function calculate() {
        try {
            if ($errorMsg.length) $errorMsg.text("");
            const tokens = tokenize(input);
            const rpn = shuntingYard(tokens);
            const val = evalRPN(rpn);
            lastAns = val;
            if ($ansIndicator.length) $ansIndicator.text(formatNum(val));
            if ($displayValue.length) $displayValue.text(formatNum(val));
            appendHistory(input, val);
        } catch (e) {
            if ($errorMsg.length) $errorMsg.text(e.message || "Error");
        }
    }
    appendHistory();

    function appendHistory(expr, result) {
        $.ajax({
            url: "get/history",
            method: "get",
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: {
                withCredentials: true,
            },
            success: function (res) {
                console.log(res.data);
                $historyEl.empty();

                let history = res.data;
                history.forEach((element) => {
                    const $row = $(`
          <div class="group flex items-start justify-between gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
            <div>
              <div class="text-gray-500 dark:text-gray-400">${escapeHtml(
                  element.expr
              )}</div>
              <div class="font-medium text-gray-900 dark:text-gray-100">${Number(
                  element.result
              )}</div>
            </div>
            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
              <button class="text-xs text-blue-600 dark:text-blue-400 hover:underline" data-act="use">Use</button>
              <button class="text-xs text-rose-600 dark:text-rose-400 hover:underline" data-id='${
                  element.id
              }' data-act="del">Delete</button>
            </div>
          </div>
        `);
                    $historyEl.append($row);

                    $row.on("click", function (e) {
                        const act = $(e.target).attr("data-act");
                        if (act === "use") {
                            setInput(element.expr);
                            if ($displayValue.length)
                                $displayValue.text(element.result);
                        }
                        if (act === "del") {
                            $row.remove();
                        }
                    });
                });
            },
            error: function (xhr) {
                let error = xhr.responseJSON || xhr.responseText;
            },
        });

        if (expr != null) {
            save_history({
                expr,
                result,
            })
                .then((data) => {
                    console.log(data);
                    showSuccessMessage(data.message);
                    appendHistory();
                })
                .catch((xhr) => {
                    let error = xhr.responseJSON || xhr.responseText;
                    showError(error.message);
                });
        }
    }

    function save_history(data) {
        return $.ajax({
            url: "save/history",
            method: "POST",
            data: JSON.stringify(data || {}),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: {
                withCredentials: true,
            },
        });
    }

    $btnClearHist.on("click", function () {
        $.ajax({
            url: "delete/history",
            method: "POST",
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: {
                withCredentials: true,
            },
            success: function (res) {
                showSuccessMessage(res.message);
            },
            error: function () {},
        });
    });

    // ====== CLICK HANDLER ======
    $(document).on("click", function (e) {
        const $btn = $(e.target).closest("button");
        if (!$btn.length) return;

        const id = $btn.attr("id");

        // common buttons by id
        if (id === "btnClear") {
            setInput("");
            return;
        }
        if (id === "btnClearAll") {
            clearAll();
            return;
        }
        if (id === "btnEq") {
            calculate();
            return;
        }
        if (id === "btnClearHist") {
            if ($historyEl.length) $historyEl.html("");
            return;
        }

        const key = $btn.attr("data-key");
        const op = $btn.attr("data-op");
        const fn = $btn.attr("data-fn");

        // Keys (digits, constants, memory, DEL)
        if (key) {
            if (key === "DEL") {
                delOne();
                return;
            }

            if (key === "MC") {
                memory = 0;
                if ($memIndicator.length) $memIndicator.text("0");
                return;
            }
            if (key === "MR") {
                push(formatNum(memory));
                return;
            }
            if (key === "M+") {
                const v = parseFloat($displayValue.text() || "0") || 0;
                memory += v;
                if ($memIndicator.length) $memIndicator.text(formatNum(memory));
                return;
            }
            if (key === "M-") {
                const v = parseFloat($displayValue.text() || "0") || 0;
                memory -= v;
                if ($memIndicator.length) $memIndicator.text(formatNum(memory));
                return;
            }

            if (key === "pi") {
                push("π");
                return;
            }
            if (key === "e") {
                push("e");
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
            if (fn === "percent") {
                push("%");
                return;
            }
            if (fn === "pow") {
                push("^");
                return;
            } // xʸ uses ^
            if (fn === "fact") {
                push("!");
                return;
            } // postfix
            if (fn === "square") {
                push("square(");
                return;
            }
            if (fn === "recip") {
                push("recip(");
                return;
            }
            if (fn === "sign") {
                push("sign(");
                return;
            }
            if (
                [
                    "sin",
                    "cos",
                    "tan",
                    "asin",
                    "acos",
                    "atan",
                    "ln",
                    "log",
                    "sqrt",
                ].includes(fn)
            ) {
                push(fn + "(");
                return;
            }
        }
    });

    // ====== KEYBOARD HANDLER ======
    $(document).on("keydown", function (e) {
        if (e.isDefaultPrevented && e.isDefaultPrevented()) return;
        const k = e.key;

        if (/^[0-9]$/.test(k) || k === "." || k === "(" || k === ")") {
            push(k, "key");
            return;
        }

        if (k === "+" || k === "-" || k === "*" || k === "/" || k === "^") {
            push(k, "key");
            return;
        }

        if (k === "Backspace") {
            e.preventDefault();
            delOne();
            return;
        }
        if (k === "Enter" || k === "=") {
            e.preventDefault();
            calculate();
            return;
        }
    });

    // init
    render();

    function showSuccessMessage(msg) {
        $sci_errors.removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $sci_errors.addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
        $sci_errors.text(msg);
        setTimeout(() => {
            $sci_errors.addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            $sci_errors.removeClass(
                "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
            );
        }, 2000);
    }

    function showError(msg) {
        $sci_errors.removeClass("-translate-y-full opacity-0");
        $sci_errors.text(msg);
        setTimeout(() => {
            $sci_errors.addClass("-translate-y-full opacity-0");
        }, 2000);
    }
})();
