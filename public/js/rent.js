(function ($) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });
    const $form = $("#rent-form");
    const $rule = $("#rule");
    const $customWrap = $("#custom_percent_wrap");

    const $headline = $("#headline");
    const $rti = $("#rti");
    const $tdti = $("#tdti");
    const $costRent = $("#cost_rent");
    const $costUtil = $("#cost_util");
    const $costIns = $("#cost_ins");
    const $costTotal = $("#cost_total");

    const $rangesWrap = $("#ranges_wrap");
    const $rngConsAmt = $("#rng_cons_amt");
    const $rngModAmt = $("#rng_mod_amt");
    const $rngAggAmt = $("#rng_agg_amt");

    const $notesUl = $("#notes");
    const $saving = $("#saving");
    const $errorBox = $("#error");
    const closePopupRentCalculator = $("#closePopupRentCalculator") ?? "";

    const API_ENDPOINT = "/v1/finance/rent";
    const fCurrency = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    });
    const fPct = (x) => (x * 100).toFixed(1) + "%";

    function showSuccessMessage(msg) {
        $("#rent-message").removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $("#rent-message").addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
        $("#rent-message").text(msg);
        setTimeout(() => {
            $("#rent-message").addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            $("#rent-message").removeClass(
                "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
            );
        }, 2000);
    }

    function showerrorMessage(msg) {
        $("#rent-message").removeClass("-translate-y-full opacity-0");
        $("#rent-message").text(msg);
        setTimeout(() => {
            $("#rent-message").addClass("-translate-y-full opacity-0");
        }, 2000);
    }

    // Open the modal when the button is clicked
    // document
    //     .getElementById("openPopupRentCalculator")
    //     .addEventListener("click", openModal);

    // Close the modal when the close button is clicked

    function toggleCustom() {
        if ($rule.val() === "custom_percent") $customWrap.show();
        else $customWrap.hide();
    }
    $rule.on("change", toggleCustom);
    toggleCustom();

    function debounce(fn, ms) {
        let h;
        return function () {
            clearTimeout(h);
            const ctx = this,
                args = arguments;
            h = setTimeout(function () {
                fn.apply(ctx, args);
            }, ms);
        };
    }

    function payloadFromForm() {
        const parse = (sel) => {
            const v = $(sel).val();
            const n = parseFloat(v);
            return isFinite(n) ? n : 0;
        };
        const payload = {
            monthly_income: parse("#monthly_income"),
            income_is_gross: $("#income_is_gross").is(":checked"),
            monthly_debts: parse("#monthly_debts"),
            rule: $("#rule").val(),
            utilities_monthly: parse("#utilities_monthly"),
            insurance_monthly: parse("#insurance_monthly"),
            target_savings_percent: parse("#target_savings_percent"),
            show_ranges: $("#show_ranges").is(":checked"),
        };
        if (payload.rule === "custom_percent") {
            const c = parseFloat($("#custom_percent").val());
            if (isFinite(c)) payload.custom_percent = c;
        }
        return payload;
    }

    function incomeAfterSavings(monthly_income, target_savings_percent) {
        const reserve = monthly_income * (target_savings_percent / 100);
        return Math.max(0, monthly_income - reserve);
    }

    function render(result) {
        $headline.text(fCurrency.format(result.max_rent));
        $rti.text(fPct(result.ratios.rent_to_income || 0));
        $tdti.text(fPct(result.ratios.total_dti || 0));

        $costRent.text(fCurrency.format(result.housing_costs.rent || 0));
        $costUtil.text(fCurrency.format(result.housing_costs.utilities || 0));
        $costIns.text(fCurrency.format(result.housing_costs.insurance || 0));
        $costTotal.text(
            fCurrency.format(result.housing_costs.total_housing || 0)
        );

        if (result.ranges) {
            const ie = result.inputs_echo || {};
            const incAdj = incomeAfterSavings(
                ie.monthly_income || 0,
                ie.target_savings_percent || 0
            );
            $rngConsAmt.text(
                fCurrency.format((result.ranges.conservative || 0) * incAdj)
            );
            $rngModAmt.text(
                fCurrency.format((result.ranges.moderate || 0) * incAdj)
            );
            $rngAggAmt.text(
                fCurrency.format((result.ranges.aggressive || 0) * incAdj)
            );
            $rangesWrap.show();
        } else {
            $rangesWrap.hide();
        }

        $notesUl.empty();
        (result.notes || []).forEach((n) => {
            $notesUl.append($("<li/>").text(n));
        });
    }

    function callApi(payload) {
        $saving.show();
        $errorBox.hide().text("");
        return $.ajax({
            url: API_ENDPOINT,
            method: "POST",
            data: JSON.stringify(payload),
            contentType: "application/json",
            dataType: "json",
        }).always(function () {
            $saving.hide();
        });
    }

    const onChange = debounce(function () {
        const payload = payloadFromForm();
        callApi(payload)
            .done(render)
            .fail(function (xhr) {
                let message = "Something went wrong";
                try {
                    const json = xhr.responseJSON;
                    if (json && (json.message || json.error))
                        message = json.message || json.error;
                } catch (_) {}
                $errorBox.text(message).show();
            });
    }, 300);

    // Submit button support
    $form.on("submit", function (e) {
        e.preventDefault();
        onChange();
    });

    // Live input/change watchers
    $form.find("input, select").on("input change", onChange);

    // Initial compute
    onChange();

    $("#save-rent").on("click", function () {
        const payload = payloadFromForm();
        $(this).html("saving...");
        try {
            calculate_rent(payload)
                .then((res) => {
                    return fetch("/v1/finance/rentsave", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        body: JSON.stringify(res),
                        credentials: "same-origin",
                    });
                })
                .then(async (data) => {
                    if (!data.ok) {
                        const errText = await data.text();
                        let errorMess = JSON.parse(errText);
                        showerrorMessage(errorMess.message);
                        $(this).html("Error ✗");
                        setTimeout(() => {
                            $(this).html(logo + " save");
                        }, 2000);
                        if (data.status == 402) {
                            window.location.href = "/checkout";
                        }
                        throw new Error(`${data.status} ${errText}`);
                    }

                    const ct = data.headers.get("content-type") || "";
                    const output = ct.includes("application/json")
                        ? await data.json()
                        : await data.text();

                    if (data.ok) {
                        showSuccessMessage(output.message);
                        $(this).html("✔ Saved");
                    }
                    setTimeout(() => {
                        $(this).html(logo + " save");
                    }, 2000);
                })
                .catch((e) => {
                    console.log("catch", e);
                });
        } catch (error) {
            console.error(error);
        }
    });

    async function calculate_rent(args) {
        try {
            return await callApi(args);
        } catch (error) {
            console.error(error);
            throw error; // rethrow so caller can handle it
        }
    }

    (function ($) {
        function historyInit(openBtnId, sheetId) {
            const $open = $("#" + openBtnId);
            const $sheet = $("#" + sheetId);
            if (!$open.length || !$sheet.length) return;

            if ($sheet.data("bound") === "1") return;
            $sheet.data("bound", "1");

            const $closeBtns = $sheet.find(
                '[id^="close"], [data-close], .js-close-sheet'
            );

            const hide = () => {
                $sheet.addClass(
                    "pointer-events-none opacity-0 translate-y-full"
                );
                $(document).off("keydown.historySheet");
            };

            const show = () => {
                $sheet.removeClass(
                    "pointer-events-none opacity-0 translate-y-full"
                );
                $(document).one("keydown.historySheet", function (e) {
                    if (e.key === "Escape") hide();
                });
                // TODO: load history items here if needed
                // fillHistory();
            };

            $open.on("click", function (e) {
                e.preventDefault();
                show();
            });

            $closeBtns.on("click", hide);

            // expose helpers if you need to call later
            $sheet.data("showSheet", show);
            $sheet.data("hideSheet", hide);
        }

        historyInit("openHistoryRent", "historySheetRent");
    })(jQuery);

    let historyListRent = $("#historyListRent");

    $("#openHistoryRent").on("click", function () {
        rent_history("/rent/calculation/calculator/rentHistory");
    });

    function rent_history(url) {
        $.ajax({
            url: url,
            method: "get",
            contentType: "application/json",
            dataType: "json",
            success: function (res) {
                render1(res.data.data);

                pagination(res.data);
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function pagination(data) {
        if (data.from == data.last_page) return;

        let links = data.links;

        $("#button_container").empty();

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
                    rent_history(link.url);
                });
            }

            $("#button_container").append($a);
        });
    }

    // helpers
    function fmtMoney(n) {
        const num = Number(n ?? 0);
        if (Number.isNaN(num)) return String(n ?? "");
        return new Intl.NumberFormat(undefined, {
            style: "currency",
            currency: "USD",
            maximumFractionDigits: 2,
        }).format(num);
    }

    function fmtDate(d) {
        if (!d) return "";
        const dt = new Date(d);
        return isNaN(dt) ? String(d) : dt.toLocaleString();
    }

    function escapeHtml(s) {
        return String(s ?? "")
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // assumes: const historyListRent = $('#historyListRent'); // UL/OL
    function render1(data) {
        const frag = $(document.createDocumentFragment());

        historyListRent.empty();

        (data || []).forEach((el) => {
            const income = fmtMoney(el.monthly_income);
            const debts = fmtMoney(el.monthly_debts);
            const savings = fmtMoney(el.target_savings);
            const ins = fmtMoney(el.insurance_monthly);
            const created = fmtDate(el.created_at);
            const rule = escapeHtml(el.rule);

            const $li = $("<li/>", {
                class: "group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-3 sm:p-4 mb-2 shadow-sm hover:shadow transition",
            });

            const html = `
      <div class="flex items-start justify-between gap-3">
        <div>
          <div class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400">Monthly Income</div>
          <div class="text-lg font-semibold text-slate-900 dark:text-slate-100">${income}</div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
          <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">${
              rule == "dti_36"
                  ? "dti_36"
                  : rule == "30_percent"
                  ? "30%"
                  : `${rule}%`
          }</span>
          <time class="text-xs text-slate-500">${created}</time>
          <button type="button" class="opacity-0 group-hover:opacity-100 transition text-slate-500 hover:text-slate-900 dark:hover:text-white" data-remove title="Remove">✕</button>
        </div>
      </div>

      <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-2">
        <div class="rounded-xl bg-slate-50 dark:bg-slate-800/50 p-2">
          <div class="text-[11px] text-slate-500">Monthly Debts</div>
          <div class="font-medium">${debts}</div>
        </div>

        <div class="rounded-xl bg-slate-50 dark:bg-slate-800/50 p-2">
          <div class="text-[11px] text-slate-500">Target Savings</div>
          <div class="font-medium">${savings}</div>
        </div>

        <div class="rounded-xl bg-slate-50 dark:bg-slate-800/50 p-2">
          <div class="text-[11px] text-slate-500">Insurance (Monthly)</div>
          <div class="font-medium">${ins}</div>
        </div>
      </div>
    `;

            $li.html(html);
            frag.append($li[0]);
        });

        historyListRent.append(frag);
    }

    $(document).on("click", "[data-remove]", function () {
        $(this).closest("li").remove();
    });
})(jQuery);
