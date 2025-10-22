(function ($) {
    /* ===========================
     * Modal open/close logic for Area Converter
     * =========================== */
    const $overlayAreaConverter = $("#popupAreaConverterNew");
    const $openAreaConverterBtn = $("#openPopupAreaConverterNew");
    const $closeAreaConverterBtn = $overlayAreaConverter.find(".close-popup");

    $openAreaConverterBtn.on("click", () => {
        openModal($overlayAreaConverter);
    });
    $closeAreaConverterBtn.on("click", () => {
        closeModal($overlayAreaConverter);
    });

    // Close modal if clicking outside of the modal content
    $overlayAreaConverter.on("click", function (e) {
        if (e.target === $overlayAreaConverter[0])
            closeModal($overlayAreaConverter);
    });

    // Close modal with 'Escape' key
    $(window).on("keydown", function (e) {
        if (e.key === "Escape" && !$overlayAreaConverter.hasClass("hidden")) {
            closeModal($overlayAreaConverter);
        }
    });

    /* ===========================
     * DOM refs
     * =========================== */
    const $elValue = $("#valueAreaConverter");
    const $elFrom = $("#fromAreaConverter");
    const $elTo = $("#toAreaConverter");
    const $elResult = $("#resultAreaConverter");
    const $elToUnit = $("#toUnitAreaConverter");
    const $elTable = $("#tableBodyAreaConverter");
    const $elError = $("#errorAreaConverter");

    /* ===========================
     * Error helpers
     * =========================== */
    function showError(msg) {
        console.log(msg);
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

    /* ===========================
     * HTTP helpers
     * =========================== */
    function fetchJson(url, params) {
        return $.ajax({
            url: url,
            method: "GET",
            data: params || {},
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    }

    /* ===========================
     * Update the area conversion and table
     * =========================== */
    async function update() {
        clearError();
        const value = parseFloat($elValue.val());
        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const from = $elFrom.val();
        const to = $elTo.val();

        try {
            // Get the conversion result from the API
            const conv = await fetchJson("/convert", {
                category: "area",
                from,
                to,
                value,
            });
            $elResult.text(conv.result);
            $elToUnit.text(to);

            // Get the conversion table from the API
            const tbl = await fetchJson("/convert/table", {
                category: "area",
                from,
                value,
            });

            $elTable.empty();
            $.each(tbl.rows || [], function (_, row) {
                $elTable.append(
                    `<tr><td class="px-4 py-1">${row.unit}</td><td class="px-4 py-1">${row.value}</td></tr>`
                );
            });
        } catch (e) {
            console.log(e);
            showError(e.responseJSON.message);
        }
    }

    // Debounce
    const debounce = (fn, ms = 150) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    // Add event listeners for the value, from, and to input changes
    ["input", "change"].forEach((evt) => {
        if (evt === "input") $elValue.on(evt, debounce(update, 150));
        else $elValue.on(evt, update);
        $elFrom.on(evt, update);
        $elTo.on(evt, update);
    });

    // Initialize the conversion on page load
    update();

    /* ========================================================================
     * SAVE + HISTORY (same logic as your original, converted to jQuery)
     * ======================================================================== */

    const $btnSaveArea = $("#btnSaveArea");
    const $resultEl = $("#resultAreaConverter");
    const $valueEl = $("#valueAreaConverter");
    const $fromEl = $("#fromAreaConverter");
    const $toEl = $("#toAreaConverter");
    const $errorAreaConverter = $("#errorAreaConverter");

    // History sheet controls
    const $closeHistory = $("#closeHistoryArea");
    const $closeHistory2 = $("#closeHistoryArea2");
    const $historySheet = $("#historySheetArea");
    const $historyList = $("#historyListArea");
    const $openHistory = $("#openHistoryArea").length
        ? $("#openHistoryArea")
        : $closeHistory2;

    // ---- SAVE HANDLER ----
    $btnSaveArea.on("click", async function () {
        $btnSaveArea.html("Saving...");
        try {
            const payload = {
                category: "area",
                from: $fromEl.val(),
                to: $toEl.val(),
                value: $valueEl.val(),
                resultValue: $resultEl.text(),
            };

            const data = await $.ajax({
                url: "/lenghtsave",
                method: "POST",
                data: JSON.stringify(payload),
                contentType: "application/json",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            // keep the same UI behavior
            if (data.ok) {
                $btnSaveArea.html("✔ Saved");
                showSuccessMessage("Conversion Saved Successfully.");
                setTimeout(() => $btnSaveArea.html(logo + " Save"), 2000);
                loadAreaHistory();
            } else {
                if (data.status === 401) {
                    $errorAreaConverter.text(data.message);
                    $errorAreaConverter.removeClass(
                        "-translate-y-full opacity-0"
                    );
                    setTimeout(
                        () =>
                            $errorAreaConverter.addClass(
                                "-translate-y-full opacity-0"
                            ),
                        3000
                    );
                }
                throw new Error(data.message || "Something went wrong");
            }
        } catch (e) {
            console.log(e);
            showError(e.responseJSON.message);

            $btnSaveArea.html("Error ✗");
            setTimeout(() => $btnSaveArea.html(logo + " Save"), 2000);
        }
    });

    // ---- HISTORY SHEET ----
    function openSheet() {
        $historySheet.removeClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }
    function closeSheet() {
        $historySheet.addClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }

    $openHistory.on("click", openSheet);
    $closeHistory.on("click", closeSheet);
    $closeHistory2.on("click", closeSheet);

    $openHistory.on("click", function () {
        loadAreaHistory({ urm: "/lenghts" });
    });

    async function loadAreaHistory({ urm }) {
        try {
            console.log(urm);
            const res = await fetchJson(urm, {
                category: "area",
                per_page: 5,
                sort: "created_at",
                order: "desc",
            });

            const items = Array.isArray(res?.data)
                ? res.data
                : Array.isArray(res)
                ? res
                : [];

            pagination(res.links);

            $historyList.empty();

            let conversion_units = {
                mm2: "Square Millimeter",
                cm2: "Square Centimeter",
                m2: "Square Meter",
                km2: "Square Kilometer",
                in2: "Square Inch",
                ft2: "Square Foot",
                yd2: "Square Yard",
                mi2: "Square Mile",
                acre: "Acre",
                hectare: "Hectare",
            };

            $.each(items, function (_, r) {
                const $li = $(`
                <li class="flex items-start gap-3">
                  <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
                  <div>
                    <div class="font-medium text-gray-900 dark:text-gray-200">
                      ${conversion_units[r.from_unit]} → ${
                    conversion_units[r.to_unit]
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

                $historyList.append($li);
                $historyList.append($li.clone(true));
            });

            // (optional) inspect res.meta/res.links for pagination
            // console.log(res.meta, res.links);
        } catch (e) {
            showError(e.message);
        }
    }

    function pagination(links) {
        console.log(links);

        $area_pagination = $("#area_pagination");

        $area_pagination.empty();

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
                    loadAreaHistory({ urm: link.url });
                });
            }

            $area_pagination.append($a);
        });
    }
})(jQuery);
