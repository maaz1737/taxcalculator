<!-- Modal: Rent Affordability Calculator -->
<div id="popupRentCalculator" class="scroll-skin fixed inset-0 z-[60] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="popup-content bg-white dark:bg-gray-900 rounded-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 w-[min(960px,95vw)] max-h-[85vh] overflow-hidden p-0">

        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-5 py-3 rounded-t-2xl bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Rent Affordability Calculator</h2>
            <button id="closePopupRentCalculator"
                class="close-popup inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                aria-label="Close">✕</button>
        </div>


        <div class="relative z-[99999999999]">
            <div id="rent-message"
                class="absolute top-2 left-12 w-[40%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
                ddd
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 sm:px-8 py-6 overflow-y-auto max-h-[calc(85vh-48px-56px)] scroll-area"><!-- reserve 56px for sticky bar -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Left Column: Inputs -->
                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <form id="rent-form" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Income</label>
                            <input type="number" step="0.01" name="monthly_income" id="monthly_income"
                                value="6000"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" required>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="income_is_gross" class="dark:bg-gray-700" class='search'>
                            <label for="income_is_gross" class="text-sm text-gray-800 dark:text-gray-200">Income is Gross (before tax)</label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Monthly Debts</label>
                            <input type="number" step="0.01" id="monthly_debts" value="500"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Rule</label>
                            <select id="rule"
                                class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                                <option value="dti_36" selected>DTI ≤ 36%</option>
                                <option value="30_percent">30% of Income</option>
                                <option value="custom_percent">Custom % of Income</option>
                            </select>
                        </div>

                        <div id="custom_percent_wrap" class="hidden">
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Custom Percent (%)</label>
                            <input type="number" step="0.01" id="custom_percent" placeholder="e.g., 33"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Utilities (Monthly)</label>
                            <input type="number" step="0.01" id="utilities_monthly" value="300"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Renter’s Insurance (Monthly)</label>
                            <input type="number" step="0.01" id="insurance_monthly" value="0"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Target Savings (%)</label>
                            <input type="number" step="0.1" id="target_savings_percent" value="10"
                                class="search w-full p-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600">
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="show_ranges" checked class="dark:bg-gray-700">
                            <label for="show_ranges" class="text-sm text-gray-800 dark:text-gray-200">Show Conservative/Moderate/Aggressive ranges</label>
                        </div>

                        <button type="submit"
                            id="save-rent"
                            class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                            Save
                        </button>
                        <span id="saving" class="text-sm ml-3 hidden">Saving...</span>

                    </form>
                </div>

                <div class="rounded-xl border border-slate-200/70 dark:border-slate-700/60 bg-white/70 dark:bg-gray-900/60 backdrop-blur p-5">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900 dark:text-white">Your Result</h2>
                    <div id="headline" class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">—</div>

                    <div id="breakdown" class="space-y-2 text-sm text-gray-800 dark:text-gray-300">
                        <div><strong>Rent-to-Income:</strong> <span id="rti">—</span></div>
                        <div><strong>Total DTI:</strong> <span id="tdti">—</span></div>

                        <div class="mt-3">
                            <strong>Housing Costs:</strong>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div>Rent: <span id="cost_rent">—</span></div>
                                <div>Utilities: <span id="cost_util">—</span></div>
                                <div>Insurance: <span id="cost_ins">—</span></div>
                                <div>Total Housing: <span id="cost_total">—</span></div>
                            </div>
                        </div>

                        <div id="ranges_wrap" class="mt-3 hidden">
                            <strong>Ranges (by % of income after savings):</strong>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div>Conservative (25%): <span id="rng_cons_amt">—</span></div>
                                <div>Moderate (30%): <span id="rng_mod_amt">—</span></div>
                                <div>Aggressive (35%): <span id="rng_agg_amt">—</span></div>
                            </div>
                        </div>

                        <ul id="notes" class="list-disc pl-5 mt-3 text-gray-700 dark:text-gray-400"></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky action bar (History button) -->
        <div class="sticky bottom-0 left-0 w-full bg-gray-100/80 dark:bg-gray-800/80 backdrop-blur border-t border-slate-200 dark:border-slate-700 px-5 py-3 rounded-b-2xl flex items-center justify-end">

            @auth
            <button id="openHistoryRent"
                class="inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:focus:ring-slate-600">
                History
            </button>
            @endauth


        </div>
    </div>

    <!-- Bottom Sheet (History) -->
    <div id="historySheetRent" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
        <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-slate-200/60 dark:ring-slate-700/60 bg-white dark:bg-gray-900">
            <div class="flex items-center justify-between px-5 py-3 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rent – History</h3>
                <button id="closeHistoryRent" class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600" aria-label="Close history">✕</button>
            </div>
            <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                <ol id="historyListRent" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                <div id="button_container" class="my-4"></div>
            </div>
            <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                <button id="closeHistoryRent2" class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function($) {
        function historyInit(openBtnId, sheetId) {
            const $open = $('#' + openBtnId);
            const $sheet = $('#' + sheetId);
            if (!$open.length || !$sheet.length) return;

            if ($sheet.data('bound') === '1') return;
            $sheet.data('bound', '1');

            const $closeBtns = $sheet.find('[id^="close"], [data-close], .js-close-sheet');

            const hide = () => {
                $sheet.addClass('pointer-events-none opacity-0 translate-y-full');
                $(document).off('keydown.historySheet');
            };

            const show = () => {
                $sheet.removeClass('pointer-events-none opacity-0 translate-y-full');
                $(document).one('keydown.historySheet', function(e) {
                    if (e.key === 'Escape') hide();
                });
                // TODO: load history items here if needed
                // fillHistory();
            };

            $open.on('click', function(e) {
                e.preventDefault();
                show();
            });

            $closeBtns.on('click', hide);

            // expose helpers if you need to call later
            $sheet.data('showSheet', show);
            $sheet.data('hideSheet', hide);
        }

        $(function() {
            historyInit('openHistoryRent', 'historySheetRent');
        });
    })(jQuery);


    let historyListRent = $('#historyListRent');

    $('#openHistoryRent').on('click', function() {

        rent_history('v1/finance/rentHistory')

    });

    function rent_history(url) {

        $.ajax({
            url: url,
            method: "get",
            contentType: "application/json",
            dataType: "json",
            success: function(res) {
                render(res.data.data);

                pagination(res.data);
            },
            error: function(e) {
                console.log(e)
            }

        });
    }

    function pagination(data) {

        if (data.from == data.last_page) return;

        let links = data.links;

        $('#button_container').empty();



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

            $('#button_container').append($a);
        });



    }


    // helpers
    function fmtMoney(n) {
        const num = Number(n ?? 0);
        if (Number.isNaN(num)) return String(n ?? '');
        return new Intl.NumberFormat(undefined, {
            style: 'currency',
            currency: 'USD',
            maximumFractionDigits: 2
        }).format(num);
    }

    function fmtDate(d) {
        if (!d) return '';
        const dt = new Date(d);
        return isNaN(dt) ? String(d) : dt.toLocaleString();
    }

    function escapeHtml(s) {
        return String(s ?? '')
            .replace(/&/g, '&amp;').replace(/</g, '&lt;')
            .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    // assumes: const historyListRent = $('#historyListRent'); // UL/OL
    function render(data) {
        const frag = $(document.createDocumentFragment());

        historyListRent.empty();

        (data || []).forEach(el => {
            const income = fmtMoney(el.monthly_income);
            const debts = fmtMoney(el.monthly_debts);
            const savings = fmtMoney(el.target_savings);
            const ins = fmtMoney(el.insurance_monthly);
            const created = fmtDate(el.created_at);
            const rule = escapeHtml(el.rule);

            const $li = $('<li/>', {
                class: 'group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-3 sm:p-4 mb-2 shadow-sm hover:shadow transition'
            });

            const html = `
      <div class="flex items-start justify-between gap-3">
        <div>
          <div class="text-[11px] uppercase tracking-wide text-slate-500 dark:text-slate-400">Monthly Income</div>
          <div class="text-lg font-semibold text-slate-900 dark:text-slate-100">${income}</div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
          <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">${rule =='dti_36' ? 'dti_36' : rule =='30_percent' ? '30%':`${rule}%`}</span>
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


    $(document).on('click', '[data-remove]', function() {
        $(this).closest('li').remove();
    });
</script>