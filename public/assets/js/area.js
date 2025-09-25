(function ($) {
    // Run when DOM is ready
    $(function () {
        /* ===========================
         * Modal open/close logic for Area Converter
         * =========================== */
        const $overlayAreaConverter = $("#popupAreaConverterNew");
        const $openAreaConverterBtn = $("#openPopupAreaConverterNew");
        const $closeAreaConverterBtn =
            $overlayAreaConverter.find(".close-popup");

        function openModalAreaConverter() {
            $overlayAreaConverter
                .removeClass("hidden")
                .attr("aria-hidden", "false");
            $("body").css("overflow", "hidden");
        }
        function closeModalAreaConverter() {
            $overlayAreaConverter
                .addClass("hidden")
                .attr("aria-hidden", "true");
            $("body").css("overflow", "");
        }

        $openAreaConverterBtn.on("click", openModalAreaConverter);
        $closeAreaConverterBtn.on("click", closeModalAreaConverter);

        // Close modal if clicking outside of the modal content
        $overlayAreaConverter.on("click", function (e) {
            if (e.target === $overlayAreaConverter[0])
                closeModalAreaConverter();
        });

        // Close modal with 'Escape' key
        $(window).on("keydown", function (e) {
            if (
                e.key === "Escape" &&
                !$overlayAreaConverter.hasClass("hidden")
            ) {
                closeModalAreaConverter();
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
            $elError.text(msg || "Something went wrong.").show();
        }
        function clearError() {
            $elError.hide().text("");
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
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                showError(e.message);
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
                    setTimeout(() => $btnSaveArea.html("Save"), 2000);
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
                $btnSaveArea.html("Error ✗");
                setTimeout(() => $btnSaveArea.html("Save"), 2000);
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

        loadAreaHistory();

        async function loadAreaHistory(page = 1) {
            try {
                const res = await fetchJson("/lenghts", {
                    category: "area",
                    per_page: 100,
                    page,
                    sort: "created_at",
                    order: "desc",
                });

                const items = Array.isArray(res?.data)
                    ? res.data
                    : Array.isArray(res)
                    ? res
                    : [];
                $historyList.empty();

                $.each(items, function (_, r) {
                    const html =
                        `<div class='text-base text-white'>${Number(
                            r.value
                        ).toFixed(2)} ${r.from_unit} = ` +
                        `${Number(r.result).toFixed(2)} ${r.to_unit}</div> ` +
                        `<p class='text-sm'>${new Date(
                            r.created_at
                        ).toLocaleString()}</p>`;

                    const $li = $(`<li class="flex items-center gap-3"></li>`);
                    $li.html(html);

                    // NOTE: your original code appended the same li twice. Preserved below to keep logic identical.
                    $historyList.append($li);
                    $historyList.append($li.clone(true));
                });

                // (optional) inspect res.meta/res.links for pagination
                // console.log(res.meta, res.links);
            } catch (e) {
                showError(e.message);
            }
        }
    });
})(jQuery);
