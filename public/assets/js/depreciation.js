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

    var $overlay = $("#popupDepreciationCalculator");
    var $openBtn = $("#openPopupDepreciationCalculator");
    var $closeBtn = $("#closePopupDepreciationCalculator");

    function money(n) {
        return Number(n).toLocaleString(undefined, {
            style: "currency",
            currency: "USD",
        });
    }

    function showError(msg) {
        $err.text(msg || "Something went wrong.").show();
    }
    function clearError() {
        $err.hide().text("");
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

    function calc() {
        clearError();

        var payload = {
            cost: Number($cost.val()),
            salvage_value: $salv.val() === "" ? 0 : Number($salv.val()),
            life_years: Number($life.val()),
            method: $meth.val(),
            ddb_switch_to_sl: String($ddb.val()) === "true",
            round: Number($round.val()),
        };

        $.ajax({
            url: "v1/finance/depreciation",
            method: "POST",
            contentType: "application/json",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: JSON.stringify(payload),
        })
            .done(function (data) {
                $deprSum.text(money(data.totals.depr_sum));
                $endBV.text(money(data.totals.end_book_value));

                var rows = $.map(data.schedule || [], function (r) {
                    return `
          <tr>
            <td style="text-align:left">${r.year}</td>
            <td>${money(r.depreciation)}</td>
            <td>${money(r.accumulated)}</td>
            <td>${money(r.book_value)}</td>
            <td style="text-align:left">${r.note || ""}</td>
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

    // Initial run
    calc();
});
