$(document).ready(function () {
    $("#openPopupTaxCalculator").on("click", function () {
        $("#popupTaxCalculator").removeClass("hidden");
    });
    $("#closeTaxModel").on("click", function () {
        $("#popupTaxCalculator").addClass("hidden");
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

    // ---------- Helpers ----------
    const aud = new Intl.NumberFormat("en-AU", {
        style: "currency",
        currency: "AUD",
        maximumFractionDigits: 0,
    });

    function showError(msg) {
        errorMessageEl2.text(msg).removeClass("-translate-y-full opacity-0");

        setTimeout(() => {
            errorMessageEl2.text(msg).addClass("-translate-y-full opacity-0");
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
        console.log(remain);
        outputIncomeTaxEl.text(incomeTax ? aud.format(incomeTax) : "—");
        outputLevyEl.text(levy ? aud.format(levy) : "—");
        outputTotalEl.text(total ? aud.format(total) : "—");
        outputRemainingEl.text(remaining ? aud.format(remaining) : "—");
        paidtax.html(paid ? aud.format(paid) : "—");

        if (remain < 0) {
            remainingTax.html(remain ? aud.format(Math.abs(remain)) : "—");
            remainingContent.text("Pay You Back");
        } else {
            remainingTax.html(remain ? aud.format(remain) : "—");
            remainingContent.text("Remaing Tax");
        }
    }

    // ---------- Core tax logic (Resident 2024–25) ----------
    function calculateIncomeTaxResident(income) {
        let tax = 0;

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

        return tax;
    }

    function calculateMedicareLevy(income, levyPercent) {
        if (!levyPercent) return 0;
        return income * (levyPercent / 100);
    }

    // ---------- Events ----------
    $(".change").on("input", function (e) {
        e.preventDefault();
        clearError();

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
        const paid = taxpaid.val();
        const remain = total - paid;

        setOutputs({
            incomeTax,
            levy,
            total,
            remaining,
            paid,
            remain,
        });
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
            };

            $.ajax({
                url: "/v1/finance/income-tax",
                method: "POST",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(payload),
                dataType: "json",
                success: function (res) {
                    alert("this is hello");
                    console.log("Response:", res.data);

                    remainingTax.html(res.data.taxLevy - res.data.taxpaid);
                    paidtax.html(res.data.taxpaid);
                },
                error: function (xhr) {
                    console.error("Status:", xhr.status);
                    console.error("Body:", xhr.responseText);

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

    function loadTaxHistory(linker = "v1/finance/gettax") {
        $.ajax({
            url: linker,
            method: "get",
            data: {
                perpage: 4,
            },
            success: function (res) {
                pagination(res.data.links);

                let data = res.data.data;
                HistoryListTax.html("");

                data.forEach((element) => {
                    let date = new Date(element.created_at).toUTCString();

                    let remainingTax =
                        Number(element.tax) +
                        Number(element.levy) -
                        Number(element.taxpaid);

                    let showdata = `
        <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 p-2 border-b border-slate-200 dark:border-slate-700 text-sm">
            <span class="font-medium text-slate-700 dark:text-slate-200">Income: ${
                element.total_income
            }</span>
            <span>Levy: ${element.levy}</span>
            <span>Remain: ${element.remaining_income}</span>
            <span>Tax: ${element.tax}</span>
            <span>Paid: ${element.taxpaid ?? "—"}</span>
            <span>Paid: ${remainingTax.toFixed(2) ?? "—"}</span>
            <span class="text-xs text-slate-500">${date}</span>
        </div>
    `;
                    let li = $("<li>").html(showdata);

                    HistoryListTax.append(li);
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
});
