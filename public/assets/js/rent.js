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

    const API_ENDPOINT = "/v1/finance/rent";
    const fCurrency = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    });
    const fPct = (x) => (x * 100).toFixed(1) + "%";

    // Modal open/close logic
    const openModal = () => {
        const overlayRentCalculator = document.getElementById(
            "popupRentCalculator"
        );
        overlayRentCalculator.classList.remove("hidden");
        overlayRentCalculator.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    };

    const closeModal = () => {
        const overlayRentCalculator = document.getElementById(
            "popupRentCalculator"
        );
        overlayRentCalculator.classList.add("hidden");
        overlayRentCalculator.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };

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
    document
        .getElementById("closePopupRentCalculator")
        .addEventListener("click", closeModal);

    // Close modal with 'Escape' key
    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeModal();
        }
    });

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
                        throw new Error(`${data.status} ${errText}`);
                    }

                    const ct = data.headers.get("content-type") || "";
                    const output = ct.includes("application/json")
                        ? await data.json()
                        : await data.text();

                    if (data.ok) {
                        showSuccessMessage(output.message);
                    }
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
})(jQuery);
