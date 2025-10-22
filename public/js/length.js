(function ($) {
    const $overlayLengthConverter = $("#popupLengthConverter");
    const $openLengthConverterBtn = $("#openPopupLengthConverter");
    const $closeLengthConverterBtn =
        $overlayLengthConverter.find(".close-popup");

    $openLengthConverterBtn.on("click", () => {
        openModal($overlayLengthConverter);
    });
    $closeLengthConverterBtn.on("click", () => {
        closeModal($overlayLengthConverter);
    });

    $overlayLengthConverter.on("click", function (e) {
        if (e.target === $overlayLengthConverter[0])
            closeModal($overlayLengthConverter);
    });

    $(window).on("keydown", function (e) {
        if (e.key === "Escape" && !$overlayLengthConverter.hasClass("hidden")) {
            closeModal($overlayLengthConverter);
        }
    });

    const $elValue = $("#value");
    const $elFrom = $("#from");
    const $elTo = $("#to");
    const $elResult = $("#result");
    const $elToUnit = $("#toUnit");
    const $elTable = $("#tableBody");
    const $elError = $("#Length_errors");
    const $elSave = $("#btnSaveLengthss");

    function showError(msg) {
        $elError.removeClass("-translate-y-full opacity-0");
        $elError.text(msg);
        setTimeout(() => {
            $elError.addClass("-translate-y-full opacity-0");
        }, 2000);
    }
    function clearError() {}

    function showSuccessMessage(msg) {
        $elError.removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $elError.addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
        $elError.text(msg);
        setTimeout(() => {
            $elError.addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            $elError.removeClass(
                "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
            );
        }, 2000);
    }

    function fetchJson(url, params) {
        return $.ajax({
            url: url,
            method: "GET",
            data: params || {},
            headers: { Accept: "application/json" },
        }).catch(async (xhr) => {
            const txt = xhr.responseText || "HTTP " + xhr.status;
            throw new Error(txt);
        });
    }

    function postJson(url, payload) {
        const token = $('meta[name="csrf-token"]').attr("content");
        return $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(payload || {}),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                ...(token ? { "X-CSRF-TOKEN": token } : {}),
            },
        }).catch(async (xhr) => {
            const txt = xhr.responseText || "HTTP " + xhr.status;
            throw new Error(txt);
        });
    }

    async function update() {
        const value = parseFloat($elValue.val());
        if (Number.isNaN(value)) {
            showError("Please enter a numeric value.");
            return;
        }

        const from = $elFrom.val();
        const to = $elTo.val();
        resultValue = 2;

        try {
            const conv = await fetchJson("/convert", {
                category: "length",
                from,
                to,
                value,
            });
            $elResult.text(conv.result);
            $elToUnit.text(to);

            const tbl = await fetchJson("/convert/table", {
                category: "length",
                from,
                value,
            });

            $elTable.empty();
            for (const row of tbl.rows || []) {
                const $tr = $("<tr>");
                const $tdU = $("<td>").text(row.unit);
                const $tdV = $("<td>").text(row.value);
                $tr.append($tdU, $tdV);
                $elTable.append($tr);

                const $elHistoryList = $("#historyList");

                async function loadHistory(url) {
                    try {
                        const res = await fetchJson(url, {
                            category: "length",
                            per_page: 10,
                            sort: "created_at",
                            order: "desc",
                        });

                        const items = Array.isArray(res?.data)
                            ? res.data
                            : Array.isArray(res)
                            ? res
                            : [];
                        pagination(res.links);
                        $elHistoryList.empty();

                        let Conversion_units = {
                            mm: "Millimeter",
                            cm: "Centimeter",
                            m: "Meter",
                            km: "Kilometer",
                            in: "Inch",
                            ft: "Foot",
                            yd: "Yard",
                            mi: "Mile",
                        };

                        $.each(items, function (_, r) {
                            const $li = $(`
                <li class="flex items-start gap-3">
                  <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
                  <div>
                    <div class="font-medium text-gray-900 dark:text-gray-200">
                      ${Conversion_units[r.from_unit]} → ${
                                Conversion_units[r.to_unit]
                            }
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                      value: ${parseFloat(Number(r.value).toFixed(2))} • 
                      Result: ${parseFloat(Number(r.result).toFixed(2))} • ${
                                r.category
                            } • ${new Date(r.created_at).toLocaleString()}
                    </div>
                  </div>
                </li>
              `);
                            $elHistoryList.append($li);
                        });

                        // (optional) build simple next/prev using res.meta/res.links
                        // console.log(res.meta, res.links);
                    } catch (e) {
                        showError(e.message);
                    }
                }

                if ($openHistory.length) {
                    $openHistory.on("click", function (e) {
                        console.log("this");

                        e.preventDefault();
                        showSheet();
                        loadHistory("/lenghts");
                    });
                }

                function pagination(links) {

                    $length_pagination = $("#length_pagination");

                    $length_pagination.empty();

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
                                loadHistory(link.url);
                            });
                        }

                        $length_pagination.append($a);
                    });
                }
            }
        } catch (e) {
            showError(e.message);
        }
    }

    async function saveConversion() {
        clearError();

        const value = parseFloat($elValue.val());
        if (Number.isNaN(value) || value == null || value != Number(value)) {
            showError("Please enter numeric value.");
            return;
        }

        const from = $elFrom.val();
        const to = $elTo.val();
        const resultValue = parseFloat($elResult.text());
        const category = "length";

        $elSave.prop("disabled", true);
        const original = $elSave.html();
        $elSave.html("Saving…");

        try {
            await postJson("/lenghtsave", {
                from,
                to,
                value,
                category,
                resultValue,
            });
            $elSave.html("Saved ✓");
            setTimeout(() => $elSave.html(original), 1500);
            showSuccessMessage("Conversion Saved Successfully.");
        } catch (e) {
            let error = {};
            try {
                error = JSON.parse(e.message);
            } catch {}
            showError(error.message);
            $elSave.html("Error ✗");
            setTimeout(() => {
                $elSave.html(original);
                // window.location.href = "/login";
            }, 1000);
        } finally {
            $elSave.prop("disabled", false);
        }
    }

    ["input", "change"].forEach((evt) => {
        $elValue.on(evt, update);
        $elFrom.on(evt, update);
        $elTo.on(evt, update);
    });

    update();

    if ($elSave.length) $elSave.on("click", saveConversion);

    $openLengthConverterBtn.on("click", function () {
        setTimeout(update, 0);
        $elValue.trigger("focus");
    });

    $("#btnSaveLength").on("click", function () {
        const val = $("#value").val();
        const from = $("#from").val();
        const to = $("#to").val();

        const $btn = $("#btnSaveLength");
        const original = $btn.html();
        $btn.html("Saved ✓");
        setTimeout(() => $btn.html(original), 1200);
    });

    const $sheet = $("#historySheet");
    const $openHistory = $("#openHistory");
    const $closeHistory = $("#closeHistory");
    const $closeHistory2 = $("#closeHistory2");

    function showSheet() {
        $sheet.removeClass("translate-y-full opacity-0 pointer-events-none");
    }

    function hideSheet() {
        $sheet.addClass("translate-y-full opacity-0 pointer-events-none");
    }

    if ($openHistory.length) {
        $openHistory.on("click", function (e) {
            e.preventDefault();
            showSheet();
        });
    }
    $closeHistory.on("click", hideSheet);
    $closeHistory2.on("click", hideSheet);

    $(document).on("keydown", function (e) {
        if (e.key === "Escape") hideSheet();
    });
})(jQuery);
