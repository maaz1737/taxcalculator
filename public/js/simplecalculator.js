$(document).ready(function () {
    let currentInput = "0"; // To store current input on screen
    let isResult = false; // To check if the result is already calculated

    // Open Modal
    $("#openPopupCalculator").click(function () {
        $("#popupCalculator")
            .removeClass("hidden")
            .attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    });

    // Close Modal
    $("#closePopupCalculator").click(function () {
        $("#popupCalculator").addClass("hidden").attr("aria-hidden", "true");
        $("body").css("overflow", "");
    });

    // Close Modal with 'Escape' Key
    $(window).on("keydown", function (e) {
        if (e.key === "Escape") {
            $("#popupCalculator")
                .addClass("hidden")
                .attr("aria-hidden", "true");
            $("body").css("overflow", "");
        }
    });

    let current = "0";
    let result = null;
    let justCalculated = false;

    const $screen = $("#calc-screen");

    // Helpers
    const isOperator = (t) => /^[+\-*/%]$/.test(t);
    const isDigitOrDot = (t) => /^(\d|\.)$/.test(t);

    // Button: numbers/operators (NOT equals/clear)
    $(".calc-btn").on("click", function calculation() {
        let key = $(this).text().trim();
        if (key == "Ac" || key == "C") {
            $screen.text("0");
            current = "0";
        }
        if (["=", "C", "Del", "Ac"].includes(key)) return;
        key = key
            .replace(/[−–—]/g, "-")
            .replace(/[×x·]/gi, "*")
            .replace(/÷/g, "/");

        if (justCalculated) {
            if (isDigitOrDot(key)) {
                current = key === "." ? (result !== null ? "0." : "0.") : key;
                result = null;
            } else if (isOperator(key)) {
                const base = result !== null ? String(result) : current;
                current = base + key;
            }
            justCalculated = false;
            $screen.text(current);
            return;
        }

        if (current === "0") {
            if (isDigitOrDot(key)) {
                current = key === "." ? "0." : key;
            } else if (isOperator(key)) {
                current = "0" + key;
            }
        } else {
            if (isOperator(key) && isOperator(current.slice(-1))) {
                current = current.slice(0, -1) + key;
            } else {
                current += key;
            }
        }

        $screen.text(current);
    });

    // Button: equals
    $("#btn-equals").on("click", function () {
        const regexDot = /. *\(/;
        const regexdot = /. *\)/;

        if (isOperator(current.slice(-1))) current = current.slice(0, -1);

        try {
            if (regexDot.test(current)) {
                current = current.replace(/(\d+)\(/g, "$1*(");
            }
            if (regexdot.test(current)) {
                current = current.replace(/\)(\d+)/g, ")*$1");
            }
            result = eval(current);
            console.log(result);

            $screen.text(result);
            justCalculated = true;
        } catch (e) {
            console.log("current");
            $screen.text("Error");
            result = null;
            justCalculated = false;
        }
    });

    // Button: clear
    $("#btn-clear").on("click", clear_screen);

    function clear_screen() {
        current = "0";
        result = null;
        justCalculated = false;
        $screen.text("0");
    }

    $("#delete")
        .off("click")
        .on("click", function () {
            let input = $("#calc-screen");

            let value = input.text().trim();
            if (value == "Error" || justCalculated === true) {
                clear_screen();
                return;
            }

            if (value.length > 0 && value != "Error" && value != 0) {
                current = value.slice(0, value.length - 1);
                input.text(current);
                if (value.length == 1) {
                    input.text("0");
                }
            }
        });
});

$(document).ready(function () {
    let current = "0";
    let result = null;
    let justCalculated = false;
    let backdrop;

    const $screen = $("#bigCalcScreen");
    const $bigCalculator = $("#bigCalculator");

    // ---- Helpers ----
    const isOperator = (t) => /^[+\-*/%]$/.test(t);
    const isDigitOrDot = (t) => /^(\d|\.)$/.test(t);

    // ---- Button: Numbers / Operators ----
    $(".calc-btn").on("click", function () {
        let key = $(this).text().trim();

        if (key == "Ac" || key == "C") {
            $screen.text("0");
            current = "0";
        }
        if (["=", "C", "Del", "Ac"].includes(key)) return;
        key = key
            .replace(/[−–—]/g, "-")
            .replace(/[×x·]/gi, "*")
            .replace(/÷/g, "/");

        if (justCalculated) {
            if (isDigitOrDot(key)) {
                current = key === "." ? "0." : key;
                result = null;
            } else if (isOperator(key)) {
                const base = result !== null ? String(result) : current;
                current = base + key;
            }
            justCalculated = false;
            $screen.text(current);
            return;
        }

        if (current === "0") {
            if (isDigitOrDot(key)) {
                current = key === "." ? "0." : key;
            } else if (isOperator(key)) {
                current = "0" + key;
            }
        } else {
            if (isOperator(key) && isOperator(current.slice(-1))) {
                current = current.slice(0, -1) + key;
            } else {
                current += key;
            }
        }

        $screen.text(current);
    });

    // ---- Button: Equals ----
    $("#btn-equals-big").on("click", function () {
        const regexDot = /.*\(/;
        const regexClose = /.*\)/;

        if (isOperator(current.slice(-1))) current = current.slice(0, -1);

        try {
            if (regexDot.test(current)) {
                current = current.replace(/(\d+)\(/g, "$1*(");
            }
            if (regexClose.test(current)) {
                current = current.replace(/\)(\d+)/g, ")*$1");
            }
            result = eval(current);
            $screen.text(result);
            justCalculated = true;
        } catch (e) {
            $screen.text("Error");
            result = null;
            justCalculated = false;
        }
    });

    // ---- Button: Clear ----
    $("#btn-clear").on("click", function () {
        current = "0";
        result = null;
        justCalculated = false;
        $screen.text("0");
    });

    // ---- Button: Delete ----
    $("#delete-big")
        .off("click")
        .on("click", function () {
            let value = $screen.text().trim();

            if (value === "Error" || justCalculated) {
                current = "0";
                result = null;
                justCalculated = false;
                $screen.text("0");
                return;
            }

            if (value.length > 1) {
                current = value.slice(0, -1);
            } else {
                current = "0";
            }

            $screen.text(current);
        });
});
