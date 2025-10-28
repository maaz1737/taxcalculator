$(document).ready(function () {
    let $closeTaxModel = $("#closeTaxModel");
    let $openPopupTaxCalculator = $("#openPopupTaxCalculator");
    let $popupTaxCalculator = $("#popupTaxCalculator");

    $openPopupTaxCalculator.on("click", () => {
        openModal($popupTaxCalculator);
    });
    $closeTaxModel.on("click", () => {
        closeModal($popupTaxCalculator);
    });
    $popupTaxCalculator.on("click", function (e) {
        if (e.target === $popupTaxCalculator[0])
            closeModal($popupTaxCalculator);
    });

    $(window).on("keydown", function (e) {
        if (e.key === "Escape" && !$popupTaxCalculator.hasClass("hidden")) {
            closeModal($popupTaxCalculator);
        }
    });
    // ---------- Elements (meaningful names) ----------
    const incomeInputEl = $("#annualIncome");
    const levySelectEl = $("#levyPercent");
    const btnCalculateEl = $("#btnCalculate");
    const btnClearEl = $("#btnClear");
    const errorMessageEl2 = $("#errorMessageTax");

    const outputIncomeTaxEl = $("#outIncomeTax");
    const outputLevyEl = $("#outLevy");
    const outputTotalEl = $("#outTotal");
    const outputRemainingEl = $("#outRemaining");
    const taxpaid = $("#taxpaid");
    const remainingTax = $("#remainingTax");
    const paidtax = $("#paidtax");
    const remainingContent = $("#remainingContent");
    //jkdfghfjkghfkjghfjkghfkjghfjkghfjkghfjkghfjkghfkjghdfjkghfjkg
    const annual_cost_result = $("#annual_cost_result");
    const annual_revenue_result = $("#annual_revenue_result");
    const taxable_amount_result = $("#taxable_amount_result");
    const total_payable_result = $("#total_payable_result");
    const paid_tax = $("#paid_tax");
    const remaining_tax = $("#remaining_tax");
    const payerType = $("#payerType");
    let yearly_revenue = $("#yearly_revenue");
    let yearly_cost = $("#yearly_cost");

    function empty() {
        incomeInputEl.val(0);
        taxpaid.val(0);
        yearly_revenue.val(0);
        yearly_cost.val(0);
    }

    // ---------- Helpers ----------
    const aud = new Intl.NumberFormat("en-AU", {
        style: "currency",
        currency: "AUD",
        maximumFractionDigits: 2,
    });

    function showError(msg) {
        errorMessageEl2.text(msg).removeClass("-translate-y-full opacity-0");

        setTimeout(() => {
            errorMessageEl2.text(msg).addClass("-translate-y-full opacity-0");
        }, 2000);
    }
    function showSuccessMsg(msg) {
        errorMessageEl2
            .text(msg)
            .removeClass(
                "-translate-y-full opacity-0 dark:bg-red-400 dark:border-red-800 bg-red-100 border-red-200"
            );
        errorMessageEl2
            .text(msg)
            .addClass(
                " dark:bg-green-400 dark:border-green-800 bg-green-100 border-green-200"
            );

        setTimeout(() => {
            errorMessageEl2.removeClass(
                "dark:bg-green-400 dark:border-green-800 bg-green-100 border-green-200"
            );
            errorMessageEl2
                .text(msg)
                .addClass(
                    "-translate-y-full opacity-0 dark:bg-red-400 dark:border-red-800 bg-red-100 border-red-200"
                );
        }, 2000);
    }

    function clearError() {
        errorMessageEl2.addClass("-translate-y-full opacity-0").text("");
    }

    function setOutputs({
        incomeTax = 0,
        levy = 0,
        total = 0,
        remaining = 0,
        paid = 0,
        remain = 0,
    } = {}) {
        outputIncomeTaxEl.text(incomeTax ? aud.format(incomeTax) : "0");
        outputLevyEl.text(levy ? aud.format(levy) : "0");
        outputTotalEl.text(total ? aud.format(total) : "0");
        outputRemainingEl.text(remaining ? aud.format(remaining) : "0");
        paidtax.html(paid > 0 ? aud.format(paid) : "0");

        if (remain < 0) {
            remainingTax.html(remain ? aud.format(Math.abs(remain)) : "0");
            remainingContent.text("Tax Refund");
        } else {
            remainingTax.html(remain ? aud.format(remain) : "0");
            remainingContent.text("Tax Payable");
        }
    }

    // ---------- Core tax logic (Resident 2024–25) ----------
    function calculateIncomeTaxResident(income) {
        let tax = 0;

        // --- Base Tax Calculation ---
        if (income <= 18200) {
            tax = 0;
        } else if (income <= 45000) {
            tax = (income - 18200) * 0.16;
        } else if (income <= 135000) {
            tax = 4288 + (income - 45000) * 0.3;
        } else if (income <= 190000) {
            tax = 31288 + (income - 135000) * 0.37;
        } else {
            tax = 51638 + (income - 190000) * 0.45;
        }

        // --- LITO (Low Income Tax Offset) ---
        let lito = 0;
        if (income <= 37500) {
            lito = 700;
        } else if (income <= 45000) {
            lito = 700 - 0.05 * (income - 37500);
        } else if (income < 66667) {
            lito = 325 - 0.015 * (income - 45000);
        } else {
            lito = 0;
        }

        // --- Apply Offset ---
        const finalTax = Math.max(0, tax - lito);

        return finalTax;
    }

    function calculateMedicareLevy(income, levyPercent) {
        if (!levyPercent) return 0;
        return income * (levyPercent / 100);
    }
    function calculateIncomeTaxNonIndividual(revenue, cost) {
        const taxableIncome = Math.max(0, revenue - cost);
        const taxRate = taxableIncome < 50000000 ? 0.25 : 0.3;
        const taxPayable = taxableIncome * taxRate;

        return {
            revenue: revenue,
            cost: cost,
            taxableIncome: taxableIncome,
            entityType:
                taxableIncome < 50000000
                    ? "Base Rate Entity"
                    : "Full Rate Entity",
            taxRate: taxRate * 100 + "%",
            taxPayable: taxPayable,
        };
    }

    // ---------- Events ----------
    $(".change").on("input", function (e) {
        e.preventDefault();
        clearError();
        //sdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
        const paid = taxpaid.val();

        if (payerType.val() !== "company") {
            const rawIncome = Number(incomeInputEl.val());
            const levyPercent = Number(levySelectEl.val());

            if (!Number.isFinite(rawIncome) || rawIncome < 0) {
                showError("Please enter a valid non-negative income amount.");
                setOutputs({});
                return;
            }

            const incomeTax = calculateIncomeTaxResident(rawIncome);
            const levy = Number.isFinite(levyPercent)
                ? calculateMedicareLevy(rawIncome, levyPercent)
                : 0;
            const total = incomeTax + levy;
            const remaining = rawIncome - total;
            const remain = total - paid;

            setOutputs({
                incomeTax,
                levy,
                total,
                remaining,
                paid,
                remain,
            });
        } else {
            let x = calculateIncomeTaxNonIndividual(
                Number(yearly_revenue.val()),
                Number(yearly_cost.val())
            );
            let remaining_tax = x.taxPayable - paid;
            annual_cost_result.text(x.cost);
            annual_revenue_result.text(x.revenue);
            taxable_amount_result.text(x.taxableIncome);
            total_payable_result.text(x.taxPayable);
            paid_tax.text(paid);

            let new_value = remaining_tax < 0 ? "Tax Refund" : "Tax Payable";
            $("#remaining_text").text(new_value);
            $("#remaining_tax").text(Math.abs(remaining_tax));
        }
    });

    btnClearEl.on("click", function () {
        incomeInputEl.val("");
        levySelectEl.val("2");
        taxpaid.val("");
        clearError();
        setOutputs({});
        incomeInputEl.trigger("focus");
    });

    levySelectEl.val("2");
    setOutputs({});

    $(document).ready(function () {
        btnCalculateEl.on("click", function (e) {
            e.preventDefault();

            $(this).html("saving...");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Accept: "Application/Json",
                },
            });
            const payload = {
                income: incomeInputEl.val(),
                levy: levySelectEl.val(),
                taxpaid: taxpaid.val(),
                payerType: payerType.val(),
                yearly_revenue: yearly_revenue.val(),
                yearly_cost: yearly_cost.val(),
            };

            console.log(payload);
            if (payload.income == 0 && payload.yearly_revenue == 0) {
                showError("First Fill Inputs ");
                btnCalculateEl.html("Error ✗");
                setTimeout(() => {
                    btnCalculateEl.html(logo + " save");
                }, 2000);
                return;
            }

            $.ajax({
                url: "/v1/finance/income-tax",
                method: "POST",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function (res) {
                    showSuccessMsg(res.message);
                    btnCalculateEl.html("✔ Saved");

                    console.log("Response:", res.data);

                    remainingTax.html(res.data.taxLevy - res.data.taxpaid);
                    paidtax.html(res.data.taxpaid);
                    setTimeout(() => {
                        btnCalculateEl.html(logo + " save");
                    }, 2000);
                    loadTaxHistory("/gettax");
                    payload = {};
                },
                error: function (xhr) {
                    console.error("Status:", xhr.status);
                    console.error("Body:", xhr.responseText);
                    btnCalculateEl.html("Error ✗");
                    setTimeout(() => {
                        btnCalculateEl.html(logo + " save");
                    }, 2000);
                    let msg = JSON.parse(xhr.responseText);
                    showError(msg.message);
                },
            });
        });
    });

    // history of tax

    let btnTaxHistory = $("#btnOpenTaxHistory");
    let taxHistorySheet = $("#historySheetTax");
    let closeHistoryTax = $("#closeHistoryTax");
    let closeHistoryTax2 = $("#closeHistoryTax2");
    let HistoryListTax = $("#historyListTax");
    let pagecontent = $("#page-content");

    async function OpenHistory() {
        taxHistorySheet.removeClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }
    function CloseHistory() {
        taxHistorySheet.addClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }
    function loadTaxHistory(linker = "/gettax") {
        linker = linker.replace(/\/tax\/calculation\/calculator/, "");

        $.ajax({
            url: linker,
            method: "get",
            data: {
                perpage: 5,
            },
            success: function (res) {
                pagination(res.data.links);

                let data = res.data.data;
                HistoryListTax.html("");

                console.log(res);

                data.forEach((element) => {
                    let date = new Date(element.created_at).toUTCString();

                    let remainingTax =
                        Number(element.tax) +
                        Number(element.levy) -
                        Number(element.taxpaid);

                    if (element.payerType == "individual") {
                        var showdata = `
<li class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow duration-200 mb-3 p-4">
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-2 text-sm text-gray-700 dark:text-gray-300">
    <div><span class="font-semibold text-gray-900 dark:text-gray-100">Income:</span> <span class="font-normal">${
        element.total_income
    }</span></div>
    <div><span class="font-semibold">Levy:</span> <span class="font-medium">${
        element.levy
    }</span></div>
    <div><span class="font-semibold">Remain:</span> <span class="font-medium">${
        element.remaining_income
    }</span></div>
    <div><span class="font-semibold">Tax:</span> <span class="font-medium">${
        element.tax
    }</span></div>
    <div><span class="font-semibold">Paid:</span> <span class="font-medium">${
        element.taxpaid ?? "—"
    }</span></div>
    ${
        remainingTax.toFixed(2) < 0
            ? `<div><span class="font-semibold">Pay you back:</span> <span class="font-medium">${Math.abs(
                  remainingTax
              ).toFixed(2)}</span></div>`
            : `<div><span class="font-semibold">Remaining Tax:</span> <span class="font-medium">${remainingTax.toFixed(
                  2
              )}</span></div>`
    }
  </div>
  <div class="mt-3 text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-slate-700 pt-2">${date}</div>
</li>`;
                    } else {
                        var showdata = `
<li class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow duration-200 mb-3 p-4">
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-2 text-sm text-gray-700 dark:text-gray-300">
    <div><span class="font-semibold text-gray-900 dark:text-gray-100">Total Revenue:</span> <span class="font-normal">${
        element.total_income
    }</span></div>
    <div><span class="font-semibold">Cost:</span> <span class="font-medium">${
        element.cost
    }</span></div>
    <div><span class="font-semibold">Taxable Income:</span> <span class="font-medium">${
        element.total_income - element.cost
    }</span></div>
    <div><span class="font-semibold">Tax:</span> <span class="font-medium">${
        element.tax
    }</span></div>
    <div><span class="font-semibold">Paid:</span> <span class="font-medium">${
        element.taxpaid ?? "0"
    }</span></div>
    ${
        remainingTax.toFixed(2) < 0
            ? `<div><span class="font-semibold">Pay you back:</span> <span class="font-medium">${Math.abs(
                  remainingTax
              ).toFixed(2)}</span></div>`
            : `<div><span class="font-semibold">Remaining Tax:</span> <span class="font-medium">${remainingTax.toFixed(
                  2
              )}</span></div>`
    }
  </div>
  <div class="mt-3 text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-slate-700 pt-2">${date}</div>
</li>`;
                    }

                    let li = $("<li>").html(showdata);

                    HistoryListTax.append(li);
                    empty();
                });
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    btnTaxHistory.on("click", OpenHistory);
    btnTaxHistory.on("click", () => {
        loadTaxHistory();
    });

    closeHistoryTax.on("click", CloseHistory);
    closeHistoryTax2.on("click", CloseHistory);

    function pagination(links) {
        const $wrap = $("#forbuttonssss").empty();
        const frag = $(document.createDocumentFragment());
        let i = 20;

        if (links.length <= 3) {
            return;
        }

        links.forEach((link) => {
            i += 1;

            const $a = $("<a>", {
                text: link.label ?? String(i),
                target: "_self",
                active: link.active,
            }).addClass(
                "inline-flex cursor-pointer items-center justify-center mx-1 min-w-8 text-gray-500 h-8 rounded-md px-2 text-sm hover:text-white text-black dark:text-white hover:bg-black hover:dark:bg-white hover:dark:text-gray-900"
            );

            if (!link.url) {
                $a.attr("href", " ");
                $a.removeClass("cursor-pointer");
                return;
            }

            let newtext = $a.text();
            newtext = newtext.replace("&laquo; Previous", "«");
            newtext = newtext.replace("Next &raquo;", "»");
            $a.text(newtext);

            if (link.active) {
                $a.addClass(
                    "bg-black text-white dark:bg-white dark:text-black"
                );
                $a.removeClass("text-black");
            }

            $a.on("click", function () {
                $(this).attr("active", true);

                $(this).addClass(
                    "bg-black text-white dark:bg-white dark:text-black"
                );
                $a.removeClass("text-black");

                loadTaxHistory(link.url);
            });

            frag.append($a);
        });

        $wrap.append(frag);
    }

    const wrapper_levy = $("#wrapper_levy");
    const individual_income = $("#individual_income");
    const total_cost = $("#total_cost");
    const total_revenue = $("#total_revenue");
    const individual_income_result = $("#individual_income_result");
    const non_individual_income_result = $("#non_individual_income_result");

    function toggleCompany() {
        const type = payerType.val(); // ✅ correct way to get value from jQuery select

        // Toggle visibility based on payer type
        wrapper_levy.toggleClass("hidden", type === "company");
        individual_income.toggleClass("hidden", type === "company");
        total_cost.toggleClass("hidden", type !== "company");
        total_revenue.toggleClass("hidden", type !== "company");
        individual_income_result.toggleClass("hidden", type === "company");
        non_individual_income_result.toggleClass("hidden", type !== "company");
    }

    payerType.on("change", toggleCompany);
    toggleCompany();
});
