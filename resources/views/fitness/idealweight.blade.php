<x-app
    :title="'Ideal Weight Calculator – Find Your Healthy Weight | QuickCalculatIt'"
    :des="'QuickCalculatIt Ideal Weight Calculator helps you find your healthy weight range based on height, age, and gender. Achieve your fitness goals safely.'"
    :key="'ideal weight calculator, healthy weight, BMI tools, fitness calculator, QuickCalculatIt'" />

<div class="px-6 sm:px-8 py-8 scroll-area" id="calculatorRoot">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl 
                    bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                    📏
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Ideal Weight Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Estimate your ideal body weight based on height, gender, and frame size.
                    </p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>

        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mt-4">
            <div id="ideal_weight_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- 🧮 Ideal Weight Form Section -->
            <form id="form-ideal" class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6 space-y-5">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ideal Weight Calculator</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Sex</label>
                        <select name="sex" class="w-full rounded-xl border border-gray-200 dark:border-slate-700 
                                                        px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Height (cm)</label>
                        <input name="height_cm" type="number" placeholder="e.g. 170"
                            class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 
                                bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                        <p class="input_errors text-sm text-red-500 mt-2"></p>
                    </div>


                </div>

                <div class="flex justify-end border-t border-slate-200 dark:border-slate-700 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button type="button" id="saveBtn"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        💾 Save
                    </button>
                    <span id="saveMsg" class="ml-3 text-green-600 hidden">Saved</span>
                </div>
            </form>

            <!-- 📊 Ideal Weight Result Section -->
            <div class="card flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ideal Weight Result</h2>

                <div class="rounded-lg bg-green-100 dark:bg-green-900/40 p-4 mb-4">
                    <div class="text-sm text-gray-700 dark:text-gray-200">Your Ideal Weight</div>
                    <div id="headlines" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                    <div id="breakdown" class="text-sm text-slate-600 dark:text-slate-400 mt-2"></div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-3 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryIdealWeight" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>

        <!-- ℹ️ Ideal Weight Explanation Section -->
        <div class="mt-10 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 
                    text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Ideal Weight</h2>
            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    Ideal Weight is an estimate of the weight that is considered healthy based on your height, sex, and frame size.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Common Formulas:</strong><br>
                    <strong>Devine Formula:</strong><br>
                    Male: 50 kg + 2.3 kg per inch over 5 feet<br>
                    Female: 45.5 kg + 2.3 kg per inch over 5 feet
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Notes:</strong> Frame size adjusts the ideal range: small, medium, or large frame influences the final value.
                </p>
            </div>
        </div>
        <section>
            <div id="HistorySheetIdealWeight" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ideal Weight – History</h3>
                        <button id="closeHistorySheetIdealWeight"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListIdealWeight" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="IdealWeightPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetIdealWeight2"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:focus:ring-slate-600">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<x-appfooter></x-appfooter>
<script src="{{ asset('js/fitness_function.js')  }}"></script>

<script>
    const $form = $("#form-ideal");
    const $headline = $("#headlines");
    const $breakdown = $("#breakdown");
    const saveBtn = $("#saveBtn");
    const bmi_error = $("#ideal_weight_error");
    let originalText = saveBtn.html();
    let payload = {};

    function btnChange(status = 1) {
        if (status === 0) {
            saveBtn.disabled = true;
            saveBtn.addClass("opacity-70", "cursor-wait");
            saveBtn.html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `);
        } else if (status === 1) {
            saveBtn.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            saveBtn.html("✔ Saved");
            setTimeout(() => {
                saveBtn.disabled = false;
                saveBtn.html(originalText);
            }, 2000)
        } else if (status === 2) {
            saveBtn.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            saveBtn.html("Error ✗");
            setTimeout(() => {
                saveBtn.disabled = false;
                saveBtn.html(originalText);
            }, 2000)
        }
    }
    const showResult = (headline, breakdown = []) => {
        $headline.text(headline || "—");
        $breakdown
            .html(breakdown.map((l) => `<div>• ${l}</div>`).join(""));
    };

    function calculateIdealWeight() {
        const formData = $form.serialize();
        $.ajax({
            url: "/v1/fitness/ideal",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(d) {
                const i = d.inputs || {};
                const result = d.data || {};
                console.log(i)

                showResult(`${d.data.ideal_weight_kg} kg ${d.data.formula}`, [
                    `Formula: Devine`,
                    `Sex: ${i.sex}`,
                    `Height: ${i.height_cm} cm`,
                ]);

                payload = {
                    inputs: i,
                    outputs: d.data
                }
                console.log(payload)
                input_error({});

            },
            error: function(xhr) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    console.log(res);
                    input_error(res.errors)

                } catch (e) {
                    console.error("Response Text:", xhr.responseText);
                }
            }

        });
    }


    $form.on("input change", calculateIdealWeight);


    function input_error(res) {
        $('.input_errors').text(res.height_cm || '');
    }




    $("#saveBtn").on("click", function() {
        if (!payload) return;
        btnChange(0)
        payload.calc_type = 'ideal';
        $.post("/v1/fitness/save", payload)
            .done(res => {
                showSuccessMessage(bmi_error, res.message)
                btnChange(1);

                $('#form-ideal')[0].reset();

                payload = {};
            })
            .fail((xhr) => {
                if (xhr.status == 401) {
                    showErrors(bmi_error, xhr.responseJSON.message)
                }
                btnChange(2);
            });
    });




    let openHistoryIdealWeight = $('#openHistoryIdealWeight');
    let HistorySheetIdealWeight = $('#HistorySheetIdealWeight');
    let closeHistorySheetIdealWeight = $('#closeHistorySheetIdealWeight');
    let closeHistorySheetIdealWeight2 = $('#closeHistorySheetIdealWeight2');
    let historyListIdealWeight = $('#historyListIdealWeight');
    let IdealWeightPagination = $('#IdealWeightPagination');

    openHistoryIdealWeight.on('click', () => {
        show(HistorySheetIdealWeight);
        loadRecents('/v1/fitness/recent', 'ideal')
    });
    closeHistorySheetIdealWeight.on('click', () => {
        hide(HistorySheetIdealWeight);
    });
    closeHistorySheetIdealWeight2.on('click', () => {
        hide(HistorySheetIdealWeight);
    });

    function loadRecents(url, type = "") {
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

                    return response;
                },
            })
            .done((res) => {

                show_data_lists(res.data.data);
                paginations(res.data.links);
            })
            .fail();
    };

    function show_data_lists(response) {
        historyListIdealWeight.empty();
        if (!response.length) {
            historyListIdealWeight.append(
                '<li class="muted">No recent calculations.</li>'
            );
            return;
        }
        response.forEach((item) => {
            const li = document.createElement("li");
            li.className =
                "p-5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-gradient-to-br from-white to-slate-50 dark:from-slate-800 dark:to-slate-900 shadow-md hover:shadow-lg transition-all duration-300";

            const i = item.inputs || {};
            const o = item.outputs || {};

            li.innerHTML = `
    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold text-lg text-slate-900 dark:text-slate-100">
        <span class="text-emerald-600 dark:text-emerald-400">#${item.id}</span>
        <span class="ml-1">${item.calc_type.toUpperCase()}</span>
      </h3>
      <span class="text-xs text-slate-500 dark:text-slate-400">
        ${new Date(item.created_at).toLocaleString()}
      </span>
    </div>

    <div class="space-y-3 text-sm text-slate-700 dark:text-slate-300">

      <!-- Inputs -->
      <div class="bg-slate-100 dark:bg-slate-700/40 rounded-xl p-3">
        <p class="font-medium text-slate-800 dark:text-slate-200 mb-2">
          ⚙️ <span class="underline decoration-emerald-500/50">Inputs</span>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-xs leading-relaxed">
          <div>👤 <strong>Sex:</strong> ${i.sex || "—"}</div>
          <div>📏 <strong>Height:</strong> ${i.height_cm || "—"} cm</div>
          <div>📘 <strong>Formula:</strong> ${o.formula || "—"}</div>
        </div>
      </div>

      <!-- Results -->
      <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-xl p-3 border border-emerald-200 dark:border-emerald-700">
        <p class="font-medium text-emerald-700 dark:text-emerald-300 mb-2">
          🧮 <span class="underline decoration-emerald-400/40">Results</span>
        </p>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between">
          <div class="text-xs sm:text-sm mb-2 sm:mb-0">
            <p>💪 <strong>Ideal Weight:</strong> ${o.ideal_weight_kg || "—"} kg</p>
          </div>
          <div class="relative w-full sm:w-40 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden mt-2 sm:mt-0">
            <div class="absolute top-0 left-0 h-full bg-emerald-500"
                 style="width: ${Math.min(o.ideal_weight_kg || 0, 100)}%;"></div>
          </div>
        </div>
      </div>

    </div>
  `;

            historyListIdealWeight.append(li);
        });

    }

    function paginations(links) {
        IdealWeightPagination.empty();
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
                    loadRecents(link.url);
                });
            }

            IdealWeightPagination.append($a);
        });
    }
</script>