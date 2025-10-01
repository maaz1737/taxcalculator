(function ($) {
    /* ===========================
     * History modal (open/close)
     * =========================== */
    const $timeHistorySheet = $("#timeHistorySheet");
    const $btnOpenTimeHistory = $("#btnOpenTimeHistory");
    const $closeTimeHistory = $("#closeTimeHistory");
    const $closeTimeHistory2 = $("#closeTimeHistory2");
    const $timeHistoryList = $("#timeHistoryList");

    function openTimeHistory() {
        $timeHistorySheet.removeClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }
    function closeTimeHis() {
        $timeHistorySheet.addClass(
            "opacity-0 translate-y-full pointer-events-none"
        );
    }

    /* ===========================
     * Converter modal (open/close)
     * =========================== */
    const $openTimeConverterBtn = $("#openPopupTimeConverter");
    const $closeTimeConverterBtn = $("#closePopupTimeConverter");
    const $overlayTimeConverter = $("#popupTimeConverter");

    function openModal() {
        $overlayTimeConverter
            .removeClass("hidden")
            .attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    }
    function closeModal() {
        $overlayTimeConverter.addClass("hidden").attr("aria-hidden", "true");
        $("body").css("overflow", "");
    }

    $openTimeConverterBtn.on("click", openModal);
    $closeTimeConverterBtn.on("click", closeModal);
    $overlayTimeConverter.on("click", function (e) {
        if (e.target === $overlayTimeConverter[0]) closeModal();
    });
    $(window).on("keydown", function (e) {
        if (e.key === "Escape" && !$overlayTimeConverter.hasClass("hidden"))
            closeModal();
    });

    /* ===========================
     * DOM refs
     * =========================== */
    const $btnSaveTime = $("#btnSaveTime");
    const $timeValue = $("#time_value");
    const $timeFrom = $("#time_from");
    const $timeTo = $("#time_to");
    const $timeResult = $("#time_result");
    const $timeError = $("#time_error");

    const $elToUnit = $("#time_toUnit");
    const $elTable = $("#time_tableBody");

    /* ===========================
     * Error helpers
     * =========================== */
    function showError(msg) {
        $timeError.removeClass("-translate-y-full opacity-0");
        $timeError.text(msg);
        setTimeout(() => {
            $timeError.addClass("-translate-y-full opacity-0");
        }, 2000);
    }
    function clearError() {}

    function showSuccessMessage(msg) {
        $timeError.removeClass(
            "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
        );
        $timeError.addClass(
            "text-green-700 bg-green-100 border-green-200 dark:text-green-300 dark:bg-green-900/30 dark:border-green-800"
        );
        $timeError.text(msg);
        setTimeout(() => {
            $timeError.addClass(
                "-translate-y-full opacity-0 text-red-700 bg-red-100 border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800"
            );
            $timeError.removeClass(
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

    // Mirrors your original helper behavior (including success message inside helper)
    function postJson(url, data, opts = {}) {
        return $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(data || {}),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: { withCredentials: true },
        }).then(
            function (json) {
                // keep original logic: show success via showError box
                showSuccessMessage("conversion saved successfully");
                return json;
            },
            function (xhr) {
                let json = null;
                try {
                    json =
                        xhr.responseJSON ??
                        JSON.parse(xhr.responseText || "null");
                } catch {}
                const err = new Error(
                    (json && json.message) ||
                        xhr.statusText ||
                        "HTTP " + xhr.status
                );
                err.status = xhr.status;
                err.data = json;
                err.responseText = xhr.responseText;
                throw err;
            }
        );
    }

    /* ===========================
     * Converter: update result + table
     * =========================== */
    async function update() {
        clearError();
        const value = parseFloat($timeValue.val());
        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const from = $timeFrom.val();
        const to = $timeTo.val();

        try {
            const conv = await fetchJson("/convert", {
                category: "time",
                from,
                to,
                value,
            });
            $timeResult.text(conv.result);
            $elToUnit.text(to);

            const tbl = await fetchJson("/convert/table", {
                category: "time",
                from,
                value,
            });
            const rows = (tbl.rows || [])
                .map((r) => `<tr><td>${r.unit}</td><td>${r.value}</td></tr>`)
                .join("");
            $elTable.html(rows);
        } catch (e) {
            showError(e.message);
        }
    }

    const debounce = (fn, ms = 150) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    ["input", "change"].forEach((evt) => {
        if (evt === "input") $timeValue.on(evt, debounce(update, 150));
        else $timeValue.on(evt, update);
        $timeFrom.on(evt, update);
        $timeTo.on(evt, update);
    });

    update();

    /* ===========================
     * Save conversion (/lenghtsave)
     * =========================== */
    async function saveTimeConversion() {
        const value = parseFloat($timeValue.val());
        if (Number.isNaN(value)) {
            showError("Please enter a numeric value.");
            return;
        }

        const from = $timeFrom.val();
        const to = $timeTo.val();
        const resultValue = parseFloat($timeResult.text());
        const category = "time";

        $btnSaveTime.prop("disabled", true);
        const original = $btnSaveTime.html();
        $btnSaveTime.html("Saving…");

        try {
            await postJson("/lenghtsave", {
                from,
                to,
                value,
                category,
                resultValue,
            });

            $btnSaveTime.html("Saved ✓");
            setTimeout(() => $btnSaveTime.html(original), 1500);
        } catch (e) {
            showError(e.data?.message);

            $btnSaveTime.html("Error ✗");

            setTimeout(() => {
                $btnSaveTime.html(` <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 7a2 2 0 0 1 2-2h9l5 5v7a2 2 0 0 1-2 2h-2v-6H7v6H5a2 2 0 0 1-2-2V7Z" />
                    <path d="M9 5h4v4H9z" />
                </svg> Save`);
            }, 2000);
        } finally {
            $btnSaveTime.prop("disabled", false);
        }
    }
    $btnSaveTime.on("click", saveTimeConversion);

    /* ===========================
     * History: fetch + render
     * =========================== */
    function loadTimeHistory(url) {
        fetchJson(url, {
            category: "time",
            per_page: 10,
            sort: "created_at",
            order: "desc",
        })
            .done(function (res) {
                const items = Array.isArray(res?.data)
                    ? res.data
                    : Array.isArray(res)
                    ? res
                    : [];
                pagination(res.links);
                $timeHistoryList.empty();

                const timeKeyObj = {
                    yr: "Year",
                    mo: "Month",
                    week: "Week",
                    day: "Day",
                    h: "Hour",
                    min: "Minute",
                    s: "Second",
                    ms: "Milisecond",
                    us: "Microsecond",
                    ns: "Nanosecond",
                };

                $.each(items, function (_, r) {
                    const $li = $(`
          <li class="flex items-start gap-3">
            <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
            <div>
              <div class="font-medium text-gray-900 dark:text-gray-200">
                ${timeKeyObj[r.from_unit] || r.from_unit} → ${
                        timeKeyObj[r.to_unit] || r.to_unit
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
                    $timeHistoryList.append($li);
                });

                // (optional) inspect res.meta/res.links for pagination UI
                // console.log(res.meta, res.links);
            })
            .fail(function (xhr) {
                const msg = xhr.responseText || "Failed to load history.";
                showError(msg);
            });
    }

    // Open/Close history events
    $btnOpenTimeHistory.on("click", function () {
        openTimeHistory();
        loadTimeHistory("/lenghts");
    });
    $closeTimeHistory.on("click", closeTimeHis);
    $closeTimeHistory2.on("click", closeTimeHis);

    function pagination(links) {
        console.log(links);

        $time_pagination = $("#time_pagination");

        $time_pagination.empty();

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
                    loadTimeHistory(link.url);
                });
            }

            $time_pagination.append($a);
        });
    }
})(jQuery);
