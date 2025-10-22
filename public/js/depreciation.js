$(function () {
    var $err = $("#errorDepreciation");
    var $cost = $("#costDepreciation");
    var $salv = $("#salvageValueDepreciation");
    var $life = $("#lifeYearsDepreciation");
    var $meth = $("#methodDepreciation");
    var $ddb = $("#ddbSwitchToSlDepreciation");
    var $round = $("#roundDepreciation");

    var $deprSum = $("#deprSumDepreciation");
    var $endBV = $("#endBookValueDepreciation");
    var $tbody = $("#tableBodyDepreciation");
    let openHisDep = $("#openHistoryDep");

    var $overlay = $("#popupDepreciationCalculator");
    var $openBtn = $("#openPopupDepreciationCalculator");
    var $closeBtn = $("#closePopupDepreciationCalculator");
    var $btnSaveDepreciation = $("#btnSaveDepreciation");
    let error = $("#errorDepreciation");

    function money(n) {
        return Number(n).toLocaleString(undefined, {
            style: "currency",
            currency: "USD",
        });
    }

    function errorDepreciation(msg) {
        error.removeClass("-translate-y-full opacity-0");
        error.text(msg);
        setTimeout(() => {
            error.addClass("-translate-y-full opacity-0");
        }, 2000);
    }
    function successDepreciation(msg) {
        error.removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );

        error.addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );

        error.text(msg);

        setTimeout(() => {
            error.addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            error.removeClass(
                "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
            );
        }, 2000);
    }

    function openModal() {
        $overlay.removeClass("hidden").attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    }
    function closeModal() {
        $overlay.addClass("hidden").attr("aria-hidden", "true");
        $("body").css("overflow", "");
    }

    $openBtn.on("click", openModal);
    $closeBtn.on("click", closeModal);
    $(window).on("keydown", function (e) {
        if (e.key === "Escape") closeModal();
    });
    var payload = () => {
        return {
            cost: Number($cost.val()),
            salvage_value: $salv.val() === "" ? 0 : Number($salv.val()),
            life_years: Number($life.val()),
            method: $meth.val(),
            ddb_switch_to_sl: String($ddb.val()) === "true",
            round: Number($round.val()),
        };
    };
    function calc() {
        let x = payload();

        fetchData(x)
            .done(function (data) {
                $deprSum.text(money(data.totals.depr_sum));
                $endBV.text(money(data.totals.end_book_value));
                var rows = $.map(data.schedule || [], function (r) {
                    return `
  <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
    <td class="text-left py-2 px-3">${r.year}</td>
    <td class="py-2 px-3">${money(r.depreciation)}</td>
    <td class="py-2 px-3">${money(r.accumulated)}</td>
    <td class="py-2 px-3">${money(r.book_value)}</td>
    <td class="text-left py-2 px-3">${r.note || ""}</td>
  </tr>
`;
                }).join("");
                $tbody.html(rows);
            })
            .fail(function (xhr) {
                showError(xhr.responseText || "Request failed.");
            });
    }

    function debounce(fn, ms) {
        var t;
        return function () {
            clearTimeout(t);
            var ctx = this,
                args = arguments;
            t = setTimeout(function () {
                fn.apply(ctx, args);
            }, ms || 200);
        };
    }

    var debouncedCalc = debounce(calc, 200);

    // Trigger calc on inputs/selects
    $(
        "#costDepreciation, #salvageValueDepreciation, #lifeYearsDepreciation, #methodDepreciation, #ddbSwitchToSlDepreciation, #roundDepreciation"
    ).on("input change", debouncedCalc);

    function fetchData(payload) {
        return $.ajax({
            url: "v1/finance/depreciation",
            method: "POST",
            contentType: "application/json",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: JSON.stringify(payload),
        });
    }

    // Initial run
    calc();

    $btnSaveDepreciation.on("click", () => {
        let x = payload();
        const original = $btnSaveDepreciation.html();
        $btnSaveDepreciation.disabled = true;
        $btnSaveDepreciation.addClass("opacity-70", "cursor-wait");
        $btnSaveDepreciation.html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `);

        fetchData(x).then((res) => {
            $.ajax({
                url: "v1/finance/depreciationsave",
                method: "POST",
                contentType: "application/json",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: JSON.stringify(res),
                success: function (res) {
                    // console.log(res.message);
                    if (res.ok) {
                        successDepreciation(res.message);
                        $btnSaveDepreciation.disabled = false;
                        $btnSaveDepreciation.removeClass(
                            "opacity-70",
                            "cursor-wait"
                        );
                        $btnSaveDepreciation.html(original);
                    }
                },
                error: function (e) {
                    console.log(e);
                    if (!res.ok) {
                        errorDepreciation(e.responseJSON.message);
                    }
                },
            });
        });
    });

    openHisDep.on("click", () => {
        history("v1/finance/DepreciationHistory");
    });

    function history(url) {
        $.ajax({
            url: url,
            method: "get",
            contentType: "application/json",
            dataType: "json",

            success: function (res) {
                showHistory(res.data);
                pagination(res.rawdata.links);
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function showHistory(data) {
        const $list = $("#historyListDep");
        if (!Array.isArray(data)) return;
        $list.empty();

        const money = (n, digits = 2) =>
            Number(n ?? 0).toLocaleString(undefined, {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: digits,
                maximumFractionDigits: digits,
            });

        const titleCase = (s) =>
            String(s || "")
                .replace(/[_\-]+/g, " ")
                .replace(/\b\w/g, (m) => m.toUpperCase());

        data.forEach((row, idx) => {
            const inputs = row.inputs || row;
            const {
                cost = 0,
                salvage_value = 0,
                life_years = 0,
                round = 2,
                method = "",
                ddb_switch_to_sl = false,
                schedule = [],
                created_at = null,
            } = inputs;

            const id = `hist-${Date.now()}-${idx}`;
            const totals = row.totals || {};

            const methodBadge = `<span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
        ${titleCase(method || "Unknown")}
      </span>`;

            const ddbBadge = ddb_switch_to_sl
                ? `<span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300">
           DDB→SL
         </span>`
                : "";

            // ✅ Totals badges at the top (outside the table)
            const totalsChips =
                totals.depr_sum != null || totals.end_book_value != null
                    ? `
          <div class="flex flex-wrap gap-2 mt-2">
            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
              Total Depreciation: <strong class="ml-1">${money(
                  totals.depr_sum ?? 0,
                  round
              )}</strong>
            </span>
            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
              End Book Value: <strong class="ml-1">${money(
                  totals.end_book_value ?? 0,
                  round
              )}</strong>
            </span>
          </div>
        `
                    : "";

            const metaChips = `
      <div class="flex flex-wrap gap-2 mt-2">
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-slate-50 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300">
          Cost: <strong class="ml-1">${money(cost, round)}</strong>
        </span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-slate-50 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300">
          Salvage: <strong class="ml-1">${money(salvage_value, round)}</strong>
        </span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-slate-50 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300">
          Life: <strong class="ml-1">${life_years} yr</strong>
        </span>
        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs bg-slate-50 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300">
          Round: <strong class="ml-1">${round}</strong>
        </span>
      </div>
    `;

            // Schedule rows
            const rows = (Array.isArray(row.schedule) ? row.schedule : [])
                .map((r) => {
                    const yr = r.year ?? "";
                    const dep = money(r.depreciation ?? 0, round);
                    const acc = money(r.accumulated ?? 0, round);
                    const bv = money(r.book_value ?? 0, round);
                    const note = r.note ? String(r.note) : "";
                    return `
        <tr class="border-b border-slate-100 dark:border-slate-800">
          <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300">${yr}</td>
          <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300">${dep}</td>
          <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300">${acc}</td>
          <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300">${bv}</td>
          <td class="px-3 py-2 text-[10px] text-slate-500 dark:text-slate-400">${note}</td>
        </tr>`;
                })
                .join("");

            const scheduleTable = rows
                ? `
      <div class="mt-3 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-3 py-2 text-xs font-medium bg-slate-50 dark:bg-slate-900/40 text-slate-600 dark:text-slate-300">
          Schedule (${schedule.length} ${
                      schedule.length === 1 ? "row" : "rows"
                  })
        </div>
    <table class="min-w-full border-collapse">
  <thead class="bg-slate-50 dark:bg-slate-900/30">
    <tr class="text-center">
      <th class="px-2 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Year</th>
      <th class="px-3 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Depreciation</th>
      <th class="px-3 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Accumulated</th>
      <th class="px-3 mx-2 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Book Value</th>
      <th class="px-3 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Note</th>
    </tr>
  </thead>
</table>

<div class="overflow-x-auto max-h-64 overflow-y-auto">
  <table class="min-w-full border-collapse">
    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
      ${rows}
    </tbody>
  </table>
</div>

        </div>
      </div>`
                : `<div class="mt-3 text-xs text-slate-500 dark:text-slate-400">No schedule available.</div>`;

            // Card
            const li = $(`
      <li class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 shadow-sm p-4">
        <details id="${id}" class="group">
          <summary class="list-none cursor-pointer">
            <div class="flex items-start justify-between">
              <div>
                <div class="flex items-center gap-2">
                  ${methodBadge}
                  ${ddbBadge}
                </div>
                ${totalsChips} <!-- ✅ totals displayed here -->
                ${metaChips}
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
            <button type="button" class="px-3 py-1.5 text-xs rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700">
              Re-run
            </button>
            <button type="button" class="px-3 py-1.5 text-xs rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-700">
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
      <li class="rounded-xl border border-dashed border-slate-300 dark:border-slate-700 p-6 text-sm text-slate-500 dark:text-slate-400 text-center">
        No history yet.
      </li>
    `);
        }
    }

    function pagination(links) {
        $depreciationPagination = $("#depreciation_pagination");

        $depreciationPagination.empty();

        if (links.length <= 3) {
            return 0;
        }

        links.forEach((link, i) => {
            let label = link.label ?? String(i + 1);
            if (i === 0) label = "Previous";
            else if (i === links.length - 1) label = "Next";
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
                    history(link.url);
                });
            }

            $depreciationPagination.append($a);
        });
    }
});

(function () {
    const openHistory = document.getElementById("openHistoryDep");
    const sheet = document.getElementById("historySheetDep");
    const close1 = document.getElementById("closeHistoryDep");
    const close2 = document.getElementById("closeHistoryDep2");
    const saveBtn = document.getElementById("btnSaveDepreciation");

    function showSheet() {
        sheet.classList.remove(
            "pointer-events-none",
            "opacity-0",
            "translate-y-full"
        );
    }

    function hideSheet() {
        sheet.classList.add(
            "pointer-events-none",
            "opacity-0",
            "translate-y-full"
        );
    }
    if (openHistory)
        openHistory.addEventListener("click", (e) => {
            e.preventDefault();
            showSheet();
        });
    if (close1) close1.addEventListener("click", hideSheet);
    if (close2) close2.addEventListener("click", hideSheet);
})();
