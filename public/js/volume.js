(function ($) {
    /* ===========================
     * DOM refs (Converter + History)
     * =========================== */
    const $elValue = $("#volume_value");
    const $elFrom = $("#volume_from");
    const $elTo = $("#volume_to");
    const $elResult = $("#volume_result");
    const $elToUnit = $("#volume_toUnit");
    const $elTable = $("#volume_tableBody");
    const $elError = $("#volume_error");
    const $btnSaveVolume = $("#btnSaveVolume");

    const $btnOpenVolumeHistory = $("#btnOpenVolumeHistory");
    const $volumeHistorySheet = $("#volumeHistorySheet");
    const $volumeHistoryList = $("#volumeHistoryList");
    const $closeVolumeHistory = $("#closeVolumeHistory");
    const $closeVolumeHistory2 = $("#closeVolumeHistory2");

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
            headers: { Accept: "application/json" },
        });
    }

    function postJson(url, data) {
        return $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(data || {}),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: { withCredentials: true },
        });
    }

    /* ===========================
     * Converter: update result + table
     * =========================== */
    async function update() {
        clearError();
        const value = parseFloat($elValue.val());
        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const from = $elFrom.val();
        const to = $elTo.val();

        try {
            // main conversion
            const conv = await fetchJson("/convert", {
                category: "volume",
                from,
                to,
                value,
            });
            $elResult.text(conv.result);
            $elToUnit.text(to);

            // conversion table
            const tbl = await fetchJson("/convert/table", {
                category: "volume",
                from,
                value,
            });
            const rows = (tbl.rows || [])
                .map((r) => `<tr><td>${r.unit}</td><td>${r.value}</td></tr>`)
                .join("");
            $elTable.html(rows);
        } catch (e) {
            showError(e.message || "Error");
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

    // Bind inputs
    ["input", "change"].forEach((evt) => {
        if (evt === "input") $elValue.on(evt, debounce(update, 150));
        else $elValue.on(evt, update);
        $elFrom.on(evt, update);
        $elTo.on(evt, update);
    });

    // Init conversion
    update();

    /* ===========================
     * History bottom sheet (open/close)
     * =========================== */
    function showVolHistory() {
        $volumeHistorySheet.removeClass(
            "translate-y-full opacity-0 pointer-events-none"
        );
    }
    function closeVolHistory() {
        $volumeHistorySheet.addClass(
            "translate-y-full opacity-0 pointer-events-none"
        );
    }

    $btnOpenVolumeHistory.on("click", function () {
        showVolHistory();
        loadVolumeHistory("/lenghts");
    });
    $closeVolumeHistory.on("click", closeVolHistory);
    $closeVolumeHistory2.on("click", closeVolHistory);
    $(document).on("keydown", function (e) {
        if (e.key === "Escape") closeVolHistory();
    });

    /* ===========================
     * Save conversion (/lenghtsave) — keep same logic
     * =========================== */
    $btnSaveVolume.on("click", async function saveVolConversion() {
        const value = $elValue.val();
        const from = $elFrom.val();
        const to = $elTo.val();
        const resultValue = $elResult.text();
        const category = "volume";

        $btnSaveVolume.prop("disabled", true);
        const original = $btnSaveVolume.html();
        $btnSaveVolume.html("Saving…");

        try {
            const resp = await postJson("/lenghtsave", {
                from,
                to,
                value,
                category,
                resultValue,
            });
            console.log("Saved:", resp);
            showSuccessMessage(resp.message);
            $btnSaveVolume.html("Saved ✓");
            setTimeout(() => $btnSaveVolume.html(original), 1500);
        } catch (e) {
            // mimic original: parse error body and show its message; then redirect after 1s
            let errObj = null;
            try {
                errObj = e?.responseJSON ?? JSON.parse(e?.responseText || "{}");
            } catch {}
            showError(errObj?.message || e?.message || "Save failed");
            $btnSaveVolume.html("Error ✗");
            setTimeout(() => {
                $btnSaveVolume.html(original);
                // window.location.href = "/login";
            }, 1500);
            if (e.status == 402) {
                window.location.href = "/checkout";
            }
        } finally {
            $btnSaveVolume.prop("disabled", false);
        }
    });

    /* ===========================
     * History: fetch + render (no pager UI added; same logic)
     * =========================== */
    async function loadVolumeHistory(url) {
        try {
            const res = await fetchJson(url, {
                category: "volume",
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
            $volumeHistoryList.empty();

            let Conversion_units = {
                ml: "Milliliter",
                l: "Liter",
                m3: "Cubic Meter",
                tsp_us: "US Teaspoon",
                tbsp_us: "US Tablespoon",
                floz_us: "US Fluid Ounce",
                cup_us: "US Cup",
                pt_us: "US Pint",
                qt_us: "US Quart",
                gal_us: "US Gallon",
                tsp_metric: "Metric Teaspoon",
                tbsp_metric: "Metric Tablespoon",
                cup_metric: "Metric Cup",
                floz_imp: "Imp Fluid Ounce",
                pt_imp: "Imp Pint",
                qt_imp: "Imp Quart",
                gal_imp: "Imp Gallon",
                in3: "Cubic Inch (in³)",
                ft3: "Cubic Foot (ft³)",
                yd3: "Cubic Yard (yd³)",
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
                value: ${Number(r.value).toFixed(2)} • 
                Result: ${Number(r.result).toFixed(2)} • ${
                    r.category
                } • ${new Date(r.created_at).toLocaleString()}
              </div>
            </div>
          </li>
        `);
                $volumeHistoryList.append($li);
            });

            // (optional) you can inspect res.meta / res.links here for pagination if needed
            // console.log(res.meta, res.links);
        } catch (e) {
            showError(e.message || "Failed to load history.");
        }
    }

    function pagination(links) {
        console.log(links);

        $volume_pagination = $("#volume_pagination");

        $volume_pagination.empty();

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
                    loadVolumeHistory(link.url);
                });
            }

            $volume_pagination.append($a);
        });
    }
})(jQuery);
