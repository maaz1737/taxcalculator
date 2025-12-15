$(function () {
    // ---------- Element refs ----------
    const $price = $("#mortgage_price");
    const $down = $("#mortgage_down_amount");
    const $years = $("#mortgage_years");
    const $apr = $("#mortgage_apr_percent");
    const $tax = $("#mortgage_annual_property_tax");
    const $ins = $("#mortgage_annual_home_insurance");
    const $pmi = $("#mortgage_pmi_percent");
    const $hoa = $("#mortgage_hoa_monthly");
    const $start = $("#mortgage_start_date");

    const $err = $("#mortgage_error");
    const $mtotal = $("#mortgage_monthly_total");
    const $mpi = $("#mortgage_monthly_PI");
    const $mtax = $("#mortgage_monthly_tax");
    const $mins = $("#mortgage_monthly_ins");
    const $mpmi = $("#mortgage_monthly_pmi");
    const $mhoa = $("#mortgage_monthly_hoa");
    const $loan = $("#mortgage_loan_amount");
    const $tint = $("#mortgage_total_interest");
    const $payoff = $("#mortgage_payoff_date");
    const $tbody = $("#mortgage_tableBody");
    const btnSaveMortgage = $("#btnSaveMortgage");

    // ---------- Helpers ----------
    function showError(msg) {
        $err.removeClass("-translate-y-full opacity-0");
        $err.text(msg);
        setTimeout(() => {
            $err.addClass("-translate-y-full opacity-0");
        }, 2000);
    }
    function showSuccessMessage(msg) {
        $err.removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $err.addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
        $err.text(msg);
        setTimeout(() => {
            $err.addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            $err.removeClass(
                "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
            );
        }, 2000);
    }

    function ajaxJson(url, params) {
        const csrf = $('meta[name="csrf-token"]').attr("content") || "";
        return $.ajax({
            url,
            method: "POST",
            data: JSON.stringify(params),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrf,
            },
        });
    }

    // Simple debounce
    function debounce(fn, ms) {
        let t;
        return function () {
            clearTimeout(t);
            const ctx = this,
                args = arguments;
            t = setTimeout(function () {
                fn.apply(ctx, args);
            }, ms || 150);
        };
    }

    function payload() {
        const price = parseFloat($price.val());
        const years = parseInt($years.val(), 10);
        const apr = parseFloat($apr.val());

        if (Number.isNaN(price)) return showError("Price is required.");
        if (Number.isNaN(years)) return showError("Years is required.");
        if (Number.isNaN(apr)) return showError("APR Percent is required.");

        return {
            price: price,
            down_amount: parseFloat($down.val()),
            years: years,
            apr_percent: apr,
            annual_property_tax: parseFloat($tax.val()),
            annual_home_insurance: parseFloat($ins.val()),
            pmi_percent: $pmi.val() ? parseFloat($pmi.val()) : null,
            hoa_monthly: $hoa.val() ? parseFloat($hoa.val()) : null,
            start_date: $start.val(),
        };
    }

    // ---------- Main update ----------
    function update() {
        let x = payload();
        ajaxJson("v1/finance/mortgage", x)
            .done(function (data) {
                $mtotal.text(data.monthly_total);
                $mpi.text(data.monthly_PI);
                $mtax.text(data.monthly_tax);
                $mins.text(data.monthly_ins);
                $mpmi.text(data.monthly_pmi);
                $mhoa.text(data.monthly_hoa);
                $loan.text(data.loan_amount);
                $tint.text(data.total_interest);
                $payoff.text(data.payoff_date || "—");

                const maxRows = x.years * 12;
                const rows = (data.schedule || []).slice(0, maxRows);

                const html = $.map(rows, function (r) {
                    return `
    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-900/40 transition-colors">
      <td class="py-2 px-3 text-center">${r.index ?? ""}</td>
      <td class="py-2 px-3 text-left">${r.date ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.payment ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.interest ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.principal ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.balance ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.pmi ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.tax ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.ins ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.hoa ?? ""}</td>
      <td class="py-2 px-3 text-right">${r.total_monthly ?? ""}</td>
    </tr>
  `;
                }).join("");
                $("#mortgage_tableBody").html(html);
            })
            .fail(function (xhr) {
                const msg =
                    (xhr.responseJSON &&
                        (xhr.responseJSON.message || xhr.responseJSON.error)) ||
                    "HTTP " + xhr.status;
                showError(msg);
            });
    }

    // ---------- Bind inputs (input + change) ----------
    const inputs = $([
        $price[0],
        $down[0],
        $years[0],
        $apr[0],
        $tax[0],
        $ins[0],
        $pmi[0],
        $hoa[0],
        $start[0],
    ]);

    inputs.on("input change", debounce(update, 150));

    // Initial compute
    update();

    btnSaveMortgage.on("click", mortagageSave);
    const original = btnSaveMortgage.html();

    function mortagageSave() {
        let x = payload();
        const csrf = $('meta[name="csrf-token"]').attr("content") || "";
        $.ajax({
            url: "v1/finance/mortgagesave",
            method: "POST",
            data: JSON.stringify(x),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrf,
            },
            success: function (res) {
                console.log(res);
                showSuccessMessage(res.message);
                btnSaveMortgage.text("saving...");
                setTimeout(() => {
                    btnSaveMortgage.html(original);
                }, 2000);
            },
            error: function (xhr) {
                console.log(xhr);
                btnSaveMortgage.text("Error x");
                setTimeout(() => {
                    btnSaveMortgage.html(original);
                }, 2000);
                showError(xhr.responseJSON.message);

                if (xhr.status == 402) {
                    window.location.href = "/checkout";
                }
            },
        });
    }

    const $openHistoryMortgage = $("#openHistoryMortgage");
    const $sheet = $("#historySheetMortgage");

    if (!$openHistoryMortgage.length || !$sheet.length) return;
    if ($sheet.data("bound") === "1") return;
    $sheet.data("bound", "1");

    const $closeBtns = $sheet.find(
        '[id^="close"], [data-close], .js-close-sheet'
    );

    function show() {
        $sheet.removeClass("pointer-events-none opacity-0 translate-y-full");
        $(document).on("keydown.history", function (e) {
            if (e.key === "Escape") hide();
        });
        // TODO: fetch & render history items into #historyListMortgage if needed
        // fillMortgageHistory();
    }

    function hide() {
        $sheet.addClass("pointer-events-none opacity-0 translate-y-full");
        $(document).off("keydown.history");
    }

    $openHistoryMortgage.on("click", function (e) {
        e.preventDefault();
        show();
        loadMortgageHistory("v1/finance/mortgageHistory");
    });

    $closeBtns.on("click", hide);

    // Optional expose to global (if you want to call from outside)
    $sheet[0].showSheet = show;
    $sheet[0].hideSheet = hide;

    function loadMortgageHistory(url) {
        const csrf = $('meta[name="csrf-token"]').attr("content") || "";
        $.ajax({
            url: url,
            method: "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrf,
            },
            success: function (res) {
                // showSuccessMessage(res.message);
                // console.log(res.authUserData);
                showMortgageHistory(res.data);
                pagination(res.dataForPagination.links);
            },
            error: function (xhr) {
                console.log(xhr);
            },
        });
    }

    function pagination(links) {
        $mortgage_pagination = $("#mortgage_pagination");

        $mortgage_pagination.empty();

        if (links.length <= 3) {
            return 0;
        }

        links.forEach((link, i) => {
            let label = link.label ?? String(i + 1);
            if (i === 0) label = "«";
            else if (i === links.length - 1) label = "»";
            else {
                label = $("<span>").html(label).text().trim();
            }

            const $a = $("<a>", {
                text: label,
                href: link.url || "#",
                target: "_self",
                "aria-label": label,
            }).addClass(
                "inline-flex mx-1 items-center justify-center min-w-8 h-8 px-2 rounded-md text-sm " +
                    "text-gray-700 dark:text-gray-200 hover:bg-gray-900 hover:text-white"
            );

            if (link.active) {
                $a.addClass(
                    "bg-gray-900 text-white dark:bg-white dark:text-gray-900"
                );
            }

            if (!link.url) {
                $a.removeAttr("href")
                    .addClass("opacity-50 cursor-not-allowed")
                    .attr("aria-disabled", "true");
            } else {
                $a.on("click", (e) => {
                    e.preventDefault();
                    loadMortgageHistory(link.url);
                });
            }

            $mortgage_pagination.append($a);
        });
    }

    function showMortgageHistory(data) {
        const $list = $("#historyListMortgage");
        if (!Array.isArray(data)) return;
        $list.empty();

        const money = (n, digits = 2) =>
            Number(n ?? 0).toLocaleString(undefined, {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: digits,
                maximumFractionDigits: digits,
            });

        const fmtDate = (s) => (s ? String(s) : "—");

        data.forEach((row, idx) => {
            const {
                loan_amount = 0,
                monthly_PI = 0,
                monthly_tax = 0,
                monthly_ins = 0,
                monthly_pmi = 0,
                monthly_hoa = 0,
                monthly_total = 0,
                payoff_date = null,
                schedules = row.schedule ?? [], // keep your source flexible
                created_at = null,
            } = row || {};

            const id = `mort-${Date.now()}-${idx}`;

            // Subtle, unified chip styles
            const chip = (label, val, extra = "") => `
      <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-[11px] leading-none
                  bg-slate-50/70 ring-1 ring-slate-200 text-slate-700
                  dark:bg-slate-900/40 dark:ring-slate-800 dark:text-slate-200 ${extra}">
        <span class="opacity-70">${label}:</span>
        <strong class="font-semibold">${val}</strong>
      </span>`;

            const topChips = `
      <div class="flex flex-wrap gap-1.5 mt-2">
        ${chip("Loan", money(loan_amount))}
        ${chip("P&I", money(monthly_PI))}
        ${chip("Tax", money(monthly_tax))}
        ${chip("Ins", money(monthly_ins))}
        ${chip("PMI", money(monthly_pmi))}
        ${chip("HOA", money(monthly_hoa))}
        ${chip(
            "Total",
            money(monthly_total),
            "bg-indigo-50/70 ring-indigo-200 text-indigo-700 dark:bg-indigo-900/20 dark:ring-indigo-800 dark:text-indigo-300"
        )}
        ${chip("Payoff", fmtDate(payoff_date))}
      </div>
    `;

            // Table rows
            const rowsHtml = (Array.isArray(schedules) ? schedules : [])
                .map((r) => {
                    return `
          <tr class="border-b border-slate-100/70 dark:border-slate-800/70 hover:bg-slate-50/60 dark:hover:bg-slate-900/40 transition-colors">
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-center">${
                r.index ?? ""
            }</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300">${fmtDate(
                r.date
            )}</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-right">${money(
                r.payment
            )}</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-right">${money(
                r.interest
            )}</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-right">${money(
                r.principal
            )}</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-right">${money(
                r.balance
            )}</td>
            <td class="px-2 py-2 text-[11px] text-slate-600 dark:text-slate-400 text-right">${money(
                r.pmi
            )}</td>
            <td class="px-2 py-2 text-[11px] text-slate-600 dark:text-slate-400 text-right">${money(
                r.tax
            )}</td>
            <td class="px-2 py-2 text-[11px] text-slate-600 dark:text-slate-400 text-right">${money(
                r.ins
            )}</td>
            <td class="px-2 py-2 text-[11px] text-slate-600 dark:text-slate-400 text-right">${money(
                r.hoa
            )}</td>
            <td class="px-2 py-2 text-xs text-slate-700 dark:text-slate-300 text-right">${money(
                r.total_monthly
            )}</td>
          </tr>
        `;
                })
                .join("");

            const scheduleTable = rowsHtml
                ? `
        <div class="mt-3 rounded-2xl ring-1 ring-slate-200 dark:ring-slate-800 overflow-hidden bg-white/60 dark:bg-slate-950/40">
          <div class="px-3 py-2 text-[11px] font-medium bg-slate-50/80 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300 tracking-wide">
            Schedule (${schedules.length} ${
                      schedules.length === 1 ? "row" : "rows"
                  })
          </div>

          <div class="max-h-64 overflow-auto">
            <table class="min-w-full border-collapse">
              <thead class="sticky top-0 bg-white/85 backdrop-blur-sm dark:bg-slate-950/70 border-b border-slate-200/70 dark:border-slate-800/70">
                <tr class="text-center">
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300">#</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-left">Date</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-right">Payment</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-right">Interest</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-right">Principal</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-right">Balance</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-500 dark:text-slate-400 text-right">PMI</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-500 dark:text-slate-400 text-right">Tax</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-500 dark:text-slate-400 text-right">Ins</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-500 dark:text-slate-400 text-right">HOA</th>
                  <th class="px-2 py-2 text-[11px] font-semibold text-slate-600 dark:text-slate-300 text-right">Total</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                ${rowsHtml}
              </tbody>
            </table>
          </div>
        </div>
      `
                : `<div class="mt-3 text-xs text-slate-500 dark:text-slate-400">No schedule available.</div>`;

            const li = $(`
      <li class="rounded-2xl ring-1 ring-slate-200 dark:ring-slate-800 bg-white/70 dark:bg-slate-950/60 shadow-sm p-4">
        <details id="${id}" class="group">
          <summary class="list-none cursor-pointer">
            <div class="flex items-start justify-between">
              <div>
                ${topChips}
                ${
                    created_at
                        ? `<div class="mt-1 text-[10px] text-slate-400">Created: ${created_at}</div>`
                        : ""
                }
              </div>
              <div class="ml-3 shrink-0 opacity-60 group-open:rotate-180 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 9 6 6 6-6"/>
                </svg>
              </div>
            </div>
          </summary>

          ${scheduleTable}

          <div class="mt-3 flex flex-wrap gap-2">
            <button type="button" class="px-3 py-1.5 text-xs rounded-xl
                    bg-slate-100 hover:bg-slate-200 text-slate-700 ring-1 ring-slate-200
                    dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-200 dark:ring-slate-700">
              Re-run
            </button>
            <button type="button" class="px-3 py-1.5 text-xs rounded-xl
                    bg-indigo-50 hover:bg-indigo-100 text-indigo-700 ring-1 ring-indigo-200
                    dark:bg-indigo-900/20 dark:hover:bg-indigo-900/30 dark:text-indigo-300 dark:ring-indigo-800">
              Duplicate
            </button>
          </div>
        </details>
      </li>
    `);

            $list.append(li);
        });

        if ($list.children().length === 0) {
            $list.append(`
      <li class="rounded-2xl ring-1 ring-dashed ring-slate-300 dark:ring-slate-700 p-6 text-sm text-slate-500 dark:text-slate-400 text-center">
        No history yet.
      </li>
    `);
        }
    }
});
