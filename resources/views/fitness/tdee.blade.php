<x-app
    :title="'TDEE Calculator – Total Daily Energy Expenditure | QuickCalculatIt'"
    :des="'QuickCalculatIt TDEE Calculator calculates your daily calorie burn based on activity level. Plan your diet and fitness goals effectively.'"
    :key="'TDEE calculator, total daily energy expenditure, calorie calculator, fitness tools, QuickCalculatIt'" />

<div class="px-6 sm:px-8 py-8 scroll-area">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="h-10 w-10 rounded-2xl grid place-items-center text-xl bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                    ⚡
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">TDEE Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Estimate your Total Daily Energy Expenditure based on your activity level and BMR.
                    </p>
                </div>
            </div>
            <span
                class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>

        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mt-4">
            <div id="tdee_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- 🧮 TDEE Form -->
            <form id="form-tdee"
                class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">TDEE Calculator</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">BMR (cal/day)</label>
                            <input name="bmr" id="tdee_bmr" type="number" placeholder="e.g. 1600"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            <p class="input_error text-sm text-red-500 mt-2"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Activity Level</label>
                            <select name="activity" id="tdee_activity"
                                class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                                <option value="sedentary">Sedentary</option>
                                <option value="light">Light</option>
                                <option value="moderate">Moderate</option>
                                <option value="active">Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div
                    class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="saveBtn"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        ⚙️ Save
                    </button>
                    <span id="saveMsg" class="text-green-600 hidden">Saved</span>

                </div>
            </form>

            <!-- 📊 TDEE Result -->
            <div
                class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">TDEE Result</h2>

                    <div class="rounded-lg bg-blue-100 dark:bg-blue-900/40 p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Your Total Daily Energy Expenditure</div>
                        <div id="headlines" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                        <div id="breakdown" class="text-sm text-slate-600 dark:text-slate-400 mt-2"></div>
                    </div>


                </div>

                <div
                    class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryTDEE"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>

        <!-- ℹ️ TDEE Explanation -->
        <div
            class="mt-10 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Your TDEE</h2>
            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Total Daily Energy Expenditure (TDEE)</strong> estimates how many calories you burn per day including all
                    activities.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Formula:</strong> TDEE = BMR × Activity Factor
                    <br>
                    <em>Activity Factors:</em> Sedentary: 1.2, Light: 1.375, Moderate: 1.55, Active: 1.725, Very Active: 1.9
                </p>
            </div>
        </div>
        <section>
            <div id="HistorySheetTDEE" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">TDEE – History</h3>
                        <button id="closeHistorySheetTDEE"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListTDEE" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="TDEEPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetTDEE2"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="{{ asset('js/fitness_function.js') }}"></script>
<script>
    // Elements
    const $form = $("#form-tdee");
    const $bmrInput = $("#tdee_bmr");
    const $activitySelect = $("#tdee_activity");
    const $headline = $("#headlines");
    const $breakdown = $("#breakdown");
    const $saveBtn = $("#saveBtn");
    const $saveMsg = $("#saveMsg");
    const tdeeError = $("#tdee_error");
    let originalText = $saveBtn.html();

    let payload = {};

    function btnChange(status = 1) {
        if (status === 0) {
            $saveBtn.disabled = true;
            $saveBtn.addClass("opacity-70", "cursor-wait");
            $saveBtn.html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `);
        } else if (status === 1) {
            $saveBtn.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            $saveBtn.html("✔ Saved");
            setTimeout(() => {
                $saveBtn.disabled = false;
                $saveBtn.html(originalText);
            }, 2000)
        } else if (status === 2) {
            $saveBtn.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            $saveBtn.html("Error ✗");
            setTimeout(() => {
                $saveBtn.disabled = false;
                $saveBtn.html(originalText);
            }, 2000)
        }
    }

    function showResult(resultText, breakdownText = "") {
        $headline.html(resultText || "—");
        $breakdown.html(breakdownText || "");
    }

    function calculateBMR() {
        const formData = $form.serialize();
        $.ajax({
            url: "/v1/fitness/tdee",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(d) {
                const i = d.inputs || {};
                showResult(
                    `${d.data.tdee} kcal/day`,
                    `<strong>BMR:</strong> ${i.bmr} × ${d.data.factor} (${i.activity})`
                );

                input_error({});

                payload = {
                    inputs: i,
                    outputs: d.data
                }
            },
            error: function(xhr) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    console.log(res);
                    input_error(res.errors);

                } catch (e) {
                    console.error("Response Text:", xhr.responseText);
                }
            }

        });
    }


    $form.on("input change", calculateBMR);


    function input_error(res) {
        $('.input_error').text(res.bmr || '');
    }




    $saveBtn.on("click", function(e) {
        e.preventDefault();
        if (!payload) return;
        btnChange(0);

        payload.calc_type = 'tdee';
        $.post("/v1/fitness/save", payload)
            .done(res => {
                showSuccessMessage(tdeeError, res.message)
                btnChange(1);
                payload = {};
            })
            .fail((xhr) => {
                if (xhr.status == 401) {
                    showErrors(tdeeError, xhr.responseJSON.message)
                }
                btnChange(2);

            });
    });

    const HistorySheetTDEE = $("#HistorySheetTDEE");
    const closeHistorySheetTDEE = $("#closeHistorySheetTDEE");
    const historyListTDEE = $("#historyListTDEE");
    const TDEEPagination = $("#TDEEPagination");
    const closeHistorySheetTDEE2 = $("#closeHistorySheetTDEE2");
    const openHistoryBtn = $("#openHistoryTDEE");

    openHistoryBtn.on("click", function() {
        show(HistorySheetTDEE);
        loadRecent_tdee('/v1/fitness/recent', 'tdee')
    });
    closeHistorySheetTDEE2.on("click", function() {
        hide(HistorySheetTDEE);
    });
    closeHistorySheetTDEE.on("click", function() {
        hide(HistorySheetTDEE);
    });


    function loadRecent_tdee(url, type = "") {
        const params = new URLSearchParams({
            per_page: 5,
        });
        if (type) params.set("type", type);

        $.ajax({
                url,
                method: "get",
                dataType: "json",
                data: {
                    per_pagr: 5,
                    type: type,
                },
                success: function(response) {
                    console.log(response);

                    return response;
                },
            })
            .done((res) => {

                show_data_listss(res.data.data);
                paginations(res.data.links);
            })
            .fail(() => {
                show_data_listss([]);
            });
    };

    function show_data_listss(response) {
        historyListTDEE.empty();
        if (!response.length) {
            historyListTDEE.append(
                '<li class="muted">No recent calculations.</li>'
            );
            return;
        }
        response.forEach((item) => {
            const li = document.createElement("li");
            li.className =
                "p-5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition duration-200 space-y-4";

            const i = item.inputs || {};
            const o = item.outputs || {};

            li.innerHTML = `
    <div class="flex justify-between items-center">
      <h3 class="font-semibold text-gray-900 dark:text-white text-base">
        #${item.id} – ${item.calc_type.toUpperCase()}
      </h3>
      <span class="text-xs text-gray-500 dark:text-gray-400">
        ${new Date(item.created_at).toLocaleString()}
      </span>
    </div>

    <div class="grid sm:grid-cols-2 gap-4 text-sm">
      <!-- Inputs -->
      <div class="rounded-xl bg-slate-50 dark:bg-slate-900/40 p-4">
        <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Inputs</h4>
        <div class="space-y-1 text-gray-700 dark:text-gray-300">
          <p><strong>BMR:</strong> ${i.bmr || "—"} kcal/day</p>
          <p><strong>Activity Level:</strong> ${i.activity || "—"}</p>
        </div>
      </div>

      <!-- Outputs -->
      <div class="rounded-xl bg-emerald-50 dark:bg-emerald-900/30 p-4">
        <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Results</h4>
        <div class="space-y-2 text-gray-700 dark:text-gray-300">
          <p class="text-sm">Your Total Daily Energy Expenditure:</p>
          <p class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">
            ${o.tdee || "—"} kcal/day
          </p>
        </div>
      </div>
    </div>
  `;

            historyListTDEE.append(li);
        });

    }

    function paginations(links) {
        TDEEPagination.empty();
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
                "page-btn py-2 mx-1 px-4 text-sm rounded-md border border-slate-300 dark:border-slate-700 "
            );

            if (link.active) {
                $a.addClass("bg-black text-white dark:bg-white dark:text-black");
            }

            if (!link.url) {
                $a.removeAttr("href")
                    .addClass(
                        "opacity-50 cursor-not-allowed bg-white text-black dark:bg-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800"
                    )
                    .attr("aria-disabled", "true");
            } else {
                $a.on("click", (e) => {
                    e.preventDefault();
                    loadRecent_tdee(link.url);
                });
            }

            TDEEPagination.append($a);
        });
    }
</script>

<x-appfooter></x-appfooter>