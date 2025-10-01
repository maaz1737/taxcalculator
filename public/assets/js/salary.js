const token =
    $('meta[name="csrf-token"]').attr("content") ||
    $('#salary-form input[name="_token"]').val();
let error = $("#errorSalary");

function money(n) {
    const num = Number(n ?? 0);
    return num.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
}

function errorSalary(msg) {
    error.removeClass("-translate-y-full opacity-0");
    error.text(msg);
    setTimeout(() => {
        error.addClass("-translate-y-full opacity-0");
    }, 2000);
}
function successSalary(msg) {
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

$(document).ready(function () {
    const API = "/v1/finance/salary";
    const $f = $("#salary-form");
    const $saving = $("#saving");
    const $error = $("#error");
    const $overlay = $("#popupSalaryCalculator");
    const $levy_checkbox = $("#levy");
    let levy = 0;
    const fmt = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    });
    const valNum = (sel, d = 0) => parseFloat($(sel).val() || d);

    const valStr = (sel, d = "") => (($(sel).val() || d) + "").trim();

    $levy_checkbox.on("change", function (e) {
        levy = e.target.checked ? 2 : 0;
    });

    const payload = () => ({
        mode: valStr("#mode", "gross_to_net"),
        pay_frequency: valStr("#pay_frequency", "monthly"),
        amount: valNum("#amount"),
        hours_per_week: valNum("#hours_per_week"),
        weeks_per_year: valNum("#weeks_per_year", 52),
        country_code: valStr("#country_code", "US").toUpperCase(),
        region_code: valStr("#region_code", null),
        tax_year: parseInt(valNum("#tax_year", 2024)),
        pretax_deductions: valNum("#pretax_deductions"),
        posttax_deductions: valNum("#posttax_deductions"),
        employee_insurance: valNum("#employee_insurance"),
        employer_costs: 0,
        bonuses: valNum("#bonuses"),
        other_allowances: valNum("#other_allowances"),
        include_breakdown: true,
        levy: levy,
    });

    $("#openPopupSalaryCalculator").on("click", () => {
        $overlay.removeClass("hidden").attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    });
    $("#closePopupSalaryCalculator").on("click", () => {
        $overlay.addClass("hidden").attr("aria-hidden", "true");
        $("body").css("overflow", "");
    });

    function postJSON(url, data) {
        return $.ajax({
            url,
            type: "POST",
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            headers: token ? { "X-CSRF-TOKEN": token } : {},
        });
    }

    // usage
    $("#salary-form").on("input change", "input, select", function (e) {
        e.preventDefault();
        postJSON(API, payload())
            .done((res) => {
                const data = res.data ?? res.original?.data ?? res;
                showData(data);
            })
            .fail((err) => console.error(err));
    });

    $("#salary-form").on("submit", function (e) {
        e.preventDefault();
        postJSON(API, payload())
            .done((res) => {
                const data = res.data ?? res.original?.data ?? res;

                $.ajax({
                    url: "/v1/finance/salarysave",
                    type: "POST",
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    headers: token ? { "X-CSRF-TOKEN": token } : {},
                    dataType: "json",
                    success: function (res) {
                        console.log(res);

                        if (res.ok == true) {
                            successSalary(res.message);
                        }
                    },
                    error: function (e) {
                        errorSalary(e.responseJSON.message);
                    },
                });
            })
            .fail((err) => console.error(err));
    });

    let p_hourly = $("#p_hourly");
    let p_weekly = $("#p_weekly");
    let p_biweekly = $("#p_biweekly");
    let p_semimonthly = $("#p_semimonthly");
    let p_monthly = $("#p_monthly");
    let p_annual = $("#p_annual");
    let tax_total = $("#tax_total");
    let levy_out = $("#levy_out");
    let tax_out = $("#tax_out");

    function showData(data) {
        p_hourly.text("$ " + Number(data.hourly).toFixed(2));
        p_weekly.text("$ " + Number(data.weekly).toFixed(2));
        p_biweekly.text("$ " + Number(data.biweekly).toFixed(2));
        p_semimonthly.text("$ " + Number(data.semimonthly).toFixed(2));
        p_monthly.text("$ " + Number(data.monthly).toFixed(2));
        p_annual.text("$ " + Number(data.after_tax).toFixed(2));
        levy_out.text("$ " + Number(data.medicare_levy).toFixed(2));
        tax_out.text("$ " + Number(data.tax).toFixed(2));
        tax_total.text(
            "$ " + (Number(data.tax) + Number(data.medicare_levy)).toFixed(2)
        );
    }
});

$(function () {
    var $openBtn = $("#openHistorySalary");
    var $sheet = $("#historySheetSalary");
    var $salaryPagination = $("#salaryPagination");
    var $historyListSalary = $("#historyListSalary");
    if (!$openBtn.length || !$sheet.length) return;

    if ($sheet.data("bound") === 1) return;
    $sheet.data("bound", 1);

    var $closeBtns = $sheet.find(
        '[id^="close"], [data-close], .js-close-sheet'
    );

    function hide() {
        $sheet.addClass("pointer-events-none opacity-0 translate-y-full");
    }

    function show() {
        $sheet.removeClass("pointer-events-none opacity-0 translate-y-full");
        // ESC hides once (re-bind each time we open)
        $(document).one("keydown", function (e) {
            if (e.key === "Escape") hide();
        });
    }

    $openBtn.on("click", function (e) {
        e.preventDefault();
        show();
    });

    $closeBtns.on("click", hide);

    $openBtn.on("click", () => {
        fetchData("/v1/finance/salaryhistory");
    });

    function fetchData(url) {
        $.ajax({
            url: url,
            type: "get",
            data: {
                per_page: 20,
            },
            contentType: "application/json; charset=utf-8",
            headers: token ? { "X-CSRF-TOKEN": token } : {},
            dataType: "json",
            success: function (res) {
                let data = res.data;

                HistoryDisplay(data.data);

                pagination(data.links);
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function dt(iso) {
        const d = new Date(iso);
        return isNaN(d) ? "—" : d.toLocaleString(); // you can localize further if you want
    }

    // Build one <li> for a history row
    function renderHistoryItem(row) {
        const gross = money(row.annual_amount);
        const net = money(row.after_tax);
        const tax = money(row.tax);
        const med = money(row.medicare_levy);
        const whr = money(row.hourly);
        const wwk = money(row.weekly);
        const wbi = money(row.biweekly);
        const wsm = money(row.semimonthly);
        const wmo = money(row.monthly);

        const created = dt(row.created_at);

        // li container
        const $li = $(`
<li class="group rounded-xl border border-slate-200/60 dark:border-slate-800/60 bg-white/60 dark:bg-slate-900/30 backdrop-blur p-2.5 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition">
  <!-- Row 1 -->
  <div class="flex items-center gap-2 text-sm text-slate-900 dark:text-slate-100">
    <div class="inline-flex items-center gap-1.5 font-medium font-mono tabular-nums">
      <span>$${gross}</span>
      <span class="text-slate-500 dark:text-slate-400" aria-hidden="true">→</span>
      <span>$${net}</span>
    </div>

    <span class="ml-2 text-xs text-slate-500 dark:text-slate-400">
      ${created}
    </span>

    <span class="ml-auto inline-flex items-center gap-1 text-[11px] text-slate-500 dark:text-slate-400">
      <span class="hidden sm:inline">ID</span>
      <span class="inline-flex items-center rounded-full px-1.5 py-0.5 border border-slate-200 dark:border-slate-700 bg-slate-100/60 dark:bg-slate-800/60 font-mono tabular-nums">
        #${row.id ?? "—"}
      </span>
    </span>
  </div>

  <!-- Row 2 -->
  <div class="mt-1.5 flex items-center gap-3 text-[13px] text-slate-600 dark:text-slate-400 font-mono tabular-nums">
    <span>Hr&nbsp;$${whr}</span>
    <span class="text-slate-400">•</span>
    <span>Wk&nbsp;$${wwk}</span>
    <span class="text-slate-400">•</span>
    <span>Mo&nbsp;$${wmo}</span>

    <span class="ml-auto inline-flex items-center gap-2">
      <span class="inline-flex items-center rounded-md px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 text-[11px]">
        Tax&nbsp;$${tax}
      </span>
      <span class="inline-flex items-center rounded-md px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 text-[11px]">
        Med&nbsp;$${med}
      </span>
    </span>
  </div>
</li>

`);

        // (Optional) click to restore this history row into the form
        $li.css("cursor", "pointer").on("click", function () {
            $("#amount").val(row.monthly);
            $("#salary-form").trigger("change");
        });

        return $li;
    }

    function HistoryDisplay(data) {
        const $historyListSalary = $("#historyListSalary").empty();

        if (!Array.isArray(data) || data.length === 0) {
            $historyListSalary.append(`
    <li class="text-sm text-gray-500 dark:text-gray-400">No history yet.</li>
  `);
        } else {
            data.forEach((item) =>
                $historyListSalary.append(renderHistoryItem(item))
            );
        }
    }

    function pagination(links) {
        $salaryPagination.empty();

        console.log(links.length);
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
                    fetchData(link.url);
                });
            }

            $salaryPagination.append($a);
        });
    }
});
