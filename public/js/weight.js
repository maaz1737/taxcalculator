(function ($) {
    // open model logic here

    const $elValue = $("#weight_value");
    const $elFrom = $("#weight_from");
    const $elTo = $("#weight_to");
    const $elResult = $("#weight_result");
    const $elToUnit = $("#weight_toUnit");
    const $elTable = $("#weight_tableBody");
    const $elError = $("#weight_error");
    const $SaveWeight = $("#btnSaveWeight");

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

    // Simple GET with query (used for /convert and /convert/table)
    function fetchJson(url, params) {
        return $.ajax({
            url: url,
            method: "GET",
            data: params || {},
            headers: { Accept: "application/json" },
        });
    }

    // GET that tolerates empty bodies and normalizes Laravel error shape
    function getJson(url, params = {}) {
        return $.ajax({
            url: $.param(params) ? `${url}?${$.param(params)}` : url,
            method: "GET",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            xhrFields: { withCredentials: true },
        }).then(
            (data) => data,
            (xhr) => {
                let json = null;
                try {
                    json =
                        xhr.responseJSON ??
                        JSON.parse(xhr.responseText || "null");
                } catch {}
                const err = new Error(
                    (json && json.message) || `HTTP ${xhr.status}`
                );
                err.status = xhr.status;
                err.data = json;
                throw err;
            }
        );
    }

    // ✅ POST JSON (used by saveWeight → /lenghtsave)
    function postJson(url, data = {}) {
        return $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            xhrFields: { withCredentials: true },
        }).then(
            (data) => data,
            (xhr) => {
                let json = null;
                try {
                    json =
                        xhr.responseJSON ??
                        JSON.parse(xhr.responseText || "null");
                } catch {}
                const message =
                    (json && json.message) ||
                    (json && json.errors
                        ? Object.values(json.errors).flat().join(" , ")
                        : null) ||
                    `HTTP ${xhr.status}`;
                const err = new Error(message);
                err.status = xhr.status;
                err.data = json;
                throw err;
            }
        );
    }

    /* ===========================
     * Conversion + table update
     * =========================== */
    async function update() {
        clearError();
        const value = parseFloat($elValue.val());
        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const from = $elFrom.val();
        const to = $elTo.val();

        try {
            // Main conversion
            const conv = await fetchJson("/convert", {
                category: "weight",
                from,
                to,
                value,
            });
            $elResult.text(conv.result);
            $elToUnit.text(to);

            // Table
            const tbl = await fetchJson("/convert/table", {
                category: "weight",
                from,
                value,
            });
            const rowsHtml = (tbl.rows || [])
                .map((r) => `<tr><td>${r.unit}</td><td>${r.value}</td></tr>`)
                .join("");
            $elTable.html(rowsHtml);
        } catch (e) {
            showError(e.message);
        }
    }

    // Debounce helper
    const debounce = (fn, ms = 150) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    // Listeners for inputs
    $.each(["input", "change"], function (_, evt) {
        if ($elValue.length) {
            if (evt === "input") $elValue.on(evt, debounce(update, 150));
            else $elValue.on(evt, update);
        }
        $elFrom.on(evt, update);
        $elTo.on(evt, update);
    });

    // First run
    update();

    /* ===========================
     * Save action (/lenghtsave)
     * =========================== */
    async function saveWeight() {
        const value = $elValue.val();
        const from = $elFrom.val();
        const to = $elTo.val();
        const resultValue = $elResult.text();
        const category = "weight";

        $SaveWeight.prop("disabled", true);
        const original = $SaveWeight.html();
        $SaveWeight.html("Saving…");

        try {
            await postJson("/lenghtsave", {
                from,
                to,
                value,
                category,
                resultValue,
            });
            $SaveWeight.html("Saved ✓");
            showSuccessMessage("Conversion Saved Successfully.");
            setTimeout(() => $SaveWeight.html(original), 1500);
        } catch (e) {
            console.log(e);
            showError(e.message);
            $SaveWeight.html("Error ✗");
            setTimeout(() => {
                $SaveWeight.html(original);
            }, 3000);
            if (e.status == 402) {
                window.location.href = "/checkout";
            }
        } finally {
            $SaveWeight.prop("disabled", false);
        }
    }
    if ($SaveWeight.length) $SaveWeight.on("click", saveWeight);

    /* ===========================
     * History bottom sheet
     * =========================== */
    const $weightHistorySheet = $("#weightHistorySheet");
    const $openWeightHistory = $("#btnOpenWeightHistory");
    const $closeWeightHistory = $("#closeWeightHistory");
    const $closeWeightHistory2 = $("#closeWeightHistory2");

    function showWeightSheet() {
        $weightHistorySheet.removeClass(
            "translate-y-full opacity-0 pointer-events-none"
        );
    }
    function hideWeightSheet() {
        $weightHistorySheet.addClass(
            "translate-y-full opacity-0 pointer-events-none"
        );
    }

    if ($openWeightHistory.length) {
        $openWeightHistory.on("click", function (e) {
            e.preventDefault();
            showWeightSheet();
            LoadWeightHistory();
        });
    }
    $closeWeightHistory.on("click", hideWeightSheet);
    $closeWeightHistory2.on("click", hideWeightSheet);
    $(document).on("keydown", function (e) {
        if (e.key === "Escape") hideWeightSheet();
    });

    /* ===========================
     * History: fetch + render + pager
     * =========================== */
    function normalizePaginator(res) {
        const items = Array.isArray(res)
            ? res
            : Array.isArray(res.data)
            ? res.data
            : [];
        const current = res.meta?.current_page ?? res.current_page ?? 1;
        const last = res.meta?.last_page ?? res.last_page ?? 1;
        const links = Array.isArray(res.links) ? res.links : null;
        return { items, current, last, links };
    }

    async function LoadWeightHistory(page = 1) {
        try {
            const res = await getJson("/lenghts", {
                category: "weight",
                per_page: 10,
                page,
                sort: "created_at",
                order: "desc",
            });

            const { items, current, last, links } = normalizePaginator(res);
            renderWeightHistory(items);
            renderWeightPager({ current, last, links });
        } catch (e) {
            showError(e.message || "Failed to load history.");
        }
    }

    function renderWeightHistory(items) {
        const $list = $("#weightHistoryList");
        $list.empty();

        if (!items || !items.length) {
            $list.html(
                `<li class="text-sm text-gray-500 dark:text-gray-400">No history yet.</li>`
            );
            $("#weightPagination").html("");
            return;
        }
        let change_units = {
            ug: "Microgrom",
            mg: "Miligram",
            g: "Gram",
            kg: "Kilogram",
            t: "Metric Tonne",
            ct: "Carat",
            oz: "Ounce",
            lb: "Pounds",
            st: "Stone",
            ton_us: "US ton",
            ton_uk: "Uk Ton",
            gr: "Grain",
            dr: "Dram",
        };

        $.each(items, function (_, r) {
            const $li = $(`
        <li class="flex items-start gap-3">
          <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
          <div>
            <div class="font-medium text-gray-900 dark:text-gray-200">
              ${change_units[r.from_unit]} → ${change_units[r.to_unit]}
            </div>
            <div class="text-xs text-gray-500 dark:text-gray-400">
              value: ${Number(r.value).toFixed(2)} • 
              result: ${Number(r.result).toFixed(2)} • 
              ${r.category} • ${new Date(r.created_at).toLocaleString()}
            </div>
          </div>
        </li>
      `);
            $list.append($li);
        });
    }

    function renderWeightPager({ current, last, links }) {
        const $pager = $("#weightPagination");

        let viewLinks = [];
        if (Array.isArray(links) && links.length) {
            viewLinks = links.map((l) => ({
                label: (l.label || "")
                    .replace("&laquo;", "«")
                    .replace("&raquo;", "»")
                    .replace("Previous", "«")
                    .replace("Next", "»"),
                page: getPageFromUrl(l.url),
                active: !!l.active,
                disabled: !l.url && !l.active,
            }));
        } else {
            viewLinks = buildLinksFromMeta(current, last);
        }

        if (last <= 1 || !viewLinks.length) {
            $pager.html("");
            return;
        }

        const base =
            "inline-flex items-center justify-center min-w-8 h-8 rounded-md px-2 text-sm";
        const active =
            "bg-gray-900 text-white dark:bg-white dark:text-gray-900";
        const idle =
            "text-gray-700 dark:text-gray-200 hover:bg-gray-200/70 dark:hover:bg-gray-700/70";
        const disabled = "text-gray-400 dark:text-gray-500 cursor-not-allowed";

        const html = viewLinks
            .map((l) => {
                if (l.ellipsis)
                    return `<span class="${base} ${disabled}">…</span>`;
                const cls = l.active ? active : l.disabled ? disabled : idle;
                const attrs = l.disabled
                    ? "disabled"
                    : Number.isFinite(l.page)
                    ? `data-page="${l.page}"`
                    : "";
                return `<button class="${base} ${cls}" ${attrs} aria-current="${
                    l.active ? "page" : "false"
                }">${l.label}</button>`;
            })
            .join("");

        $pager.html(html);
    }

    function getPageFromUrl(url) {
        if (!url) return null;
        const m = /[?&]page=(\d+)/.exec(url);
        return m ? parseInt(m[1], 10) : null;
    }

    function buildLinksFromMeta(current, last) {
        const windowSize = 2;
        const first = 1,
            lastPage = last;
        const start = Math.max(first, current - windowSize);
        const end = Math.min(lastPage, current + windowSize);
        const out = [];

        // Prev
        out.push({
            label: "«",
            page: current > 1 ? current - 1 : null,
            active: false,
            disabled: current <= 1,
        });

        // Pages + ellipses
        if (start > first) {
            out.push({
                label: "1",
                page: 1,
                active: current === 1,
                disabled: false,
            });
            if (start > first + 1) out.push({ ellipsis: true });
        }
        for (let p = start; p <= end; p++) {
            out.push({
                label: String(p),
                page: p,
                active: p === current,
                disabled: false,
            });
        }
        if (end < lastPage) {
            if (end < lastPage - 1) out.push({ ellipsis: true });
            out.push({
                label: String(lastPage),
                page: lastPage,
                active: current === lastPage,
                disabled: false,
            });
        }

        // Next
        out.push({
            label: "»",
            page: current < last ? current + 1 : null,
            active: false,
            disabled: current >= last,
        });

        return out;
    }

    // Pager click (jQuery delegated)
    $(document).on("click", "#weightPagination [data-page]", function () {
        const page = parseInt($(this).data("page"), 10);
        if (Number.isFinite(page)) LoadWeightHistory(page);
    });
})(jQuery);
