(function ($) {
    //=============================
    // ELEMENTS
    //=============================
    const $btnOpenHistory = $("#btnOpenTemperatureHistory");
    const $sheet = $("#temperatureHistorySheet");
    const $list = $("#temperatureHistoryList");
    const $close1 = $("#closeTemperatureHistory");
    const $close2 = $("#closeTemperatureHistory2");

    const $err = $("#temperature_error");
    const $val = $("#temperature_value");
    const $from = $("#temperature_from");
    const $to = $("#temperature_to");
    const $result = $("#temperature_result");
    const $btnSave = $("#btnSaveTemperature");

    // Pager controls (ensure these exist in your HTML)
    const $prev = $("#temPrev"); // « button
    const $next = $("#temNext"); // » button
    const $goto = $("#temGoto"); // number input
    const $goBtn = $("#temGo"); // Go button
    let $pages = $("#temPages"); // container for 1..N buttons

    // If #temPages is missing, create it between prev/next
    if (!$pages.length) {
        const $pagerBar = $("#temPager");
        $pages = $(
            '<div id="temPages" class="inline-flex flex-wrap items-center gap-1"></div>'
        );
        if ($pagerBar.length) {
            $prev.after($pages);
        }
    }

    // Converter modal
    const $openConv = $("#openPopupTemperatureConverter");
    const $closeConv = $("#closePopupTemperatureConverter");
    const $overlay = $("#popupTemperatureConverter");

    const $toUnit = $("#temperature_toUnit");
    const $table = $("#temperature_tableBody");

    //=============================
    // HELPERS
    //=============================
    const csrf = () => $('meta[name="csrf-token"]').attr("content");

    function showError(msg) {
        $err.text(msg || "Something went wrong.").show();
    }
    function clearError() {
        $err.hide().text("");
    }

    // Ajax GET
    function fetchJson(url, params) {
        return $.ajax({
            url,
            method: "GET",
            data: params || {},
            headers: { Accept: "application/json", "X-CSRF-TOKEN": csrf() },
        });
    }

    // Ajax POST
    function postJson(url, data) {
        return $.ajax({
            url,
            method: "POST",
            data: JSON.stringify(data || {}),
            contentType: "application/json",
            dataType: "json",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrf(),
            },
        });
    }

    // Debounce
    const debounce = (fn, ms = 150) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    //=============================
    // HISTORY SHEET (open/close)
    //=============================
    const showTemHistory = () =>
        $sheet.removeClass("translate-y-full opacity-0 pointer-events-none");
    const closeTemHistory = () =>
        $sheet.addClass("translate-y-full opacity-0 pointer-events-none");

    $btnOpenHistory.on("click", showTemHistory);
    $close1.on("click", closeTemHistory);
    $close2.on("click", closeTemHistory);

    //=============================
    // SAVE TEMPERATURE
    //=============================
    function saveTemperature() {
        const from = $from.val();
        const to = $to.val();
        const resultValue = ($.trim($result.text()) || "").toString();
        const value = parseFloat($val.val());

        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const category = "temperature";
        $btnSave.prop("disabled", true);
        const original = $btnSave.html();
        $btnSave.html("Saving…");

        postJson("/lenghtsave", { from, to, value, category, resultValue })
            .done(() => {
                $btnSave.html("Saved ✓");
                setTimeout(() => $btnSave.html(original), 1200);
            })
            .fail((xhr) => {
                console.log(xhr);
                $btnSave.html("Error ✗");
                setTimeout(() => $btnSave.html(original), 1000);
            })
            .always(() => {
                $btnSave.prop("disabled", false);
            });
    }
    $btnSave.on("click", saveTemperature);

    //=============================
    // HISTORY + PAGINATION (1..N)
    //=============================
    let temPage = 1;
    let temLast = 1;

    // Build 1..N numbered buttons
    function renderNumberedPager() {
        $pages.empty();
        const $frag = $(document.createDocumentFragment());

        for (let i = 1; i <= temLast; i++) {
            const isActive = i === temPage;
            const $btn = $("<button>", {
                class:
                    "page-btn min-w-8 h-8 px-2 text-sm rounded-md border border-slate-300 dark:border-slate-700 " +
                    (isActive
                        ? "bg-black text-white dark:bg-white dark:text-black"
                        : "bg-white text-black dark:bg-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800"),
                "data-page": i,
                "aria-current": isActive ? "page" : null,
                text: i,
            });
            $frag.append($btn);
        }
        $pages.append($frag);
    }

    // Prev/Next + GoTo state
    function setPagerUI() {
        $prev.prop("disabled", temPage <= 1);
        $next.prop("disabled", temPage >= temLast);

        $goto.attr({ min: 1, max: temLast });
        const v = parseInt($goto.val(), 10);
        if (Number.isNaN(v) || v < 1) $goto.val(1);
        if (v > temLast) $goto.val(temLast);

        renderNumberedPager();
    }

    // Delegated click for page buttons
    $pages.on("click", ".page-btn", function () {
        const page = Number($(this).data("page")) || 1;
        if (page !== temPage) loadTemHistory(page);
    });

    // Prev / Next / Go
    $prev.on("click", () => {
        if (temPage > 1) loadTemHistory(temPage - 1);
    });
    $next.on("click", () => {
        if (temPage < temLast) loadTemHistory(temPage + 1);
    });
    $goBtn.on("click", () => {
        const v = Math.max(
            1,
            Math.min(temLast, parseInt($goto.val(), 10) || 1)
        );
        loadTemHistory(v);
    });
    $goto.on("keydown", (e) => {
        if (e.key === "Enter") {
            const v = Math.max(
                1,
                Math.min(temLast, parseInt($goto.val(), 10) || 1)
            );
            loadTemHistory(v);
        }
    });
    $(document).on("keydown", (e) => {
        if (e.key === "ArrowLeft" && temPage > 1) loadTemHistory(temPage - 1);
        if (e.key === "ArrowRight" && temPage < temLast)
            loadTemHistory(temPage + 1);
    });

    function loadTemHistory(page) {
        page = page || 1;

        fetchJson("/lenghts", {
            category: "temperature",
            per_page: 4,
            page,
            sort: "created_at",
            order: "desc",
        })
            .done((res) => {
                const items = Array.isArray(res?.data)
                    ? res.data
                    : Array.isArray(res)
                    ? res
                    : [];
                temPage =
                    res?.meta?.current_page ?? res?.current_page ?? page ?? 1;
                temLast =
                    res?.meta?.last_page ?? res?.last_page ?? temPage ?? 1;

                const units = { C: "Celsius", F: "Fahrenheit", K: "Kelvin" };
                $list.empty();
                $.each(items, function (_, r) {
                    $list.append(`
          <li class="flex items-start gap-3">
            <span class="mt-1 h-2 w-2 rounded-full bg-slate-400 dark:bg-slate-600"></span>
            <div>
              <div class="font-medium text-gray-900 dark:text-gray-200">
                ${
                    units[r.from_unit] || r.from_unit
                } → ${units[r.to_unit] || r.to_unit}
              </div>
              <div class="text-xs text-gray-500 dark:text-gray-400">
                value: ${Number(r.value).toFixed(
                    2
                )} ${units[r.from_unit] || r.from_unit} •
                Result: ${Number(r.result).toFixed(
                    2
                )} ${units[r.to_unit] || r.to_unit} •
                ${r.category} • ${new Date(r.created_at).toLocaleString()}
              </div>
            </div>
          </li>
        `);
                });

                setPagerUI();
            })
            .fail((xhr) => {
                console.log(xhr);
                // showError(xhr.responseJSON?.message || 'Failed to load history');
            });
    }

    // Load page 1 when opening the sheet
    $btnOpenHistory.on("click", () => loadTemHistory(1));

    //=============================
    // CONVERTER MODAL (open/close)
    //=============================
    function openModal() {
        $overlay.removeClass("hidden").attr("aria-hidden", "false");
        $("body").css("overflow", "hidden");
    }
    function closeModal() {
        $overlay.addClass("hidden").attr("aria-hidden", "true");
        $("body").css("overflow", "");
    }
    $openConv.on("click", openModal);
    $closeConv.on("click", closeModal);
    $overlay.on("click", function (e) {
        if (e.target === $overlay[0]) closeModal();
    });
    $(window).on("keydown", function (e) {
        if (e.key === "Escape" && !$overlay.hasClass("hidden")) closeModal();
    });

    //=============================
    // CONVERSION (update table/result)
    //=============================
    function updateConversion() {
        clearError();
        const value = parseFloat($val.val());
        if (Number.isNaN(value))
            return showError("Please enter a numeric value.");

        const from = $from.val();
        const to = $to.val();

        // /convert
        fetchJson("/convert", { category: "temperature", from, to, value })
            .done((conv) => {
                $result.text(conv.result);
                $toUnit.text(to === "C" ? "°C" : to === "F" ? "°F" : "K");
            })
            .fail((xhr) => showError(xhr.responseText || "Conversion failed"));

        // /convert/table
        fetchJson("/convert/table", { category: "temperature", from, value })
            .done((tbl) => {
                const rows = (tbl.rows || [])
                    .map((r) => {
                        const label =
                            r.unit === "C" ? "°C" : r.unit === "F" ? "°F" : "K";
                        return `<tr><td>${label}</td><td>${r.value}</td></tr>`;
                    })
                    .join("");
                $table.html(rows);
            })
            .fail((xhr) => showError(xhr.responseText || "Table fetch failed"));
    }

    // Bind with debounce
    $.each(["input", "change"], function (_, evt) {
        if (evt === "input") $val.on(evt, debounce(updateConversion, 150));
        else $val.on(evt, updateConversion);

        $from.on(evt, updateConversion);
        $to.on(evt, updateConversion);
    });

    // Init
    updateConversion();
})(jQuery);
