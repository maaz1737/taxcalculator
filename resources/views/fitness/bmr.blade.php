<x-app
    :title="'BMR Calculator – Basal Metabolic Rate Calculator | QuickCalculatIt'"
    :des="'Calculate your Basal Metabolic Rate (BMR) with QuickCalculatIt. Find out the calories your body needs at rest to maintain your weight.'"
    :key="'BMR calculator, basal metabolic rate, calorie needs, fitness calculator, QuickCalculatIt'" />

<div class="bmr-section px-6 sm:px-8 py-8 scroll-area">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl 
                    bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">
                    🔥
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">BMR Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Find out your Basal Metabolic Rate — the calories you burn at rest each day.</p>
                </div>
            </div>
        </header>

        <!-- Calculator root -->
        <div id="calculatorRoot" class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mt-4">
            <div id="bmr_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">

            </div>
            <!-- BMR Form -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">BMR Calculator</h2>
                    <form id="form-bmr" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Sex</label>
                            <select name="sex" class="w-full rounded-xl border border-gray-200 dark:bg-slate-900 px-3 py-2.5">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Age</label>
                            <input name="age" type="number" placeholder="e.g. 25" class="w-full rounded-xl dark:bg-slate-900 border px-3 py-2.5">
                            <p class="age_error text-sm text-red-500 mt-2"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Weight (kg)</label>
                            <input name="weight_kg" type="number" step="0.1" placeholder="e.g. 70" class="w-full dark:bg-slate-900 rounded-xl border px-3 py-2.5">
                            <p class="weight_error text-sm text-red-500 mt-2"></p>

                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Height (cm)</label>
                            <input name="height_cm" type="number" step="0.1" placeholder="e.g. 175" class="w-full dark:bg-slate-900 rounded-xl border px-3 py-2.5">
                            <p class="height_error text-sm text-red-500 mt-2"></p>

                        </div>
                    </form>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="saveBtnBmr" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">💾 Save</button>
                </div>
            </div>

            <!-- BMR Result -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">BMR Result</h2>
                    <div class="rounded-lg bg-red-100 dark:bg-red-900/40 p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Your BMR (Calories/day)</div>
                        <div id="headlines" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                        <div id="breakdown" class="text-sm text-slate-600 dark:text-slate-400 mt-2"></div>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryBmr" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>

        </div>
        <div class="mt-10 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 
                    text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Your BMR</h2>

            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Basal Metabolic Rate (BMR)</strong> is the number of calories your body needs at rest to maintain vital functions like breathing, circulation, and cell production.
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Formula (Mifflin-St Jeor Equation):</strong><br>
                    <strong>Men:</strong> BMR = 10 × weight(kg) + 6.25 × height(cm) − 5 × age + 5<br>
                    <strong>Women:</strong> BMR = 10 × weight(kg) + 6.25 × height(cm) − 5 × age − 161
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    Knowing your BMR helps determine your daily calorie needs based on activity levels.
                </p>
            </div>
        </div>

        <section>
            <div id="HistorySheetBmr" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">BMR – History</h3>
                        <button id="closeHistorySheetBmr"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListBmr" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="BmrPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetBmr2"
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
    let $root = $('.bmr-section');
    let bmrError = $('#bmr_error');
    let saveBtnBmr = $('#saveBtnBmr')
    const $bmrForm = $root.find("#form-bmr");
    let payload = {};
    let originalText = saveBtnBmr.html();

    function btnChange(status = 1) {
        if (status === 0) {
            saveBtnBmr.disabled = true;
            saveBtnBmr.addClass("opacity-70", "cursor-wait");
            saveBtnBmr.html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `);
        } else if (status === 1) {
            saveBtnBmr.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            saveBtnBmr.html("✔ Saved");
            setTimeout(() => {
                saveBtnBmr.disabled = false;
                saveBtnBmr.html(originalText);
            }, 2000)
        } else if (status === 2) {
            saveBtnBmr.removeClass(
                "opacity-70",
                "cursor-wait"
            );
            saveBtnBmr.html("Error ✗");
            setTimeout(() => {
                saveBtnBmr.disabled = false;
                saveBtnBmr.html(originalText);
            }, 2000)
        }
    }
    const showResult = (headline, breakdown = []) => {
        $("#headlines").empty();
        $("#headlines").html(headline || "—");
        $("#breakdown").html(breakdown.map(b => `<div>• ${b}</div>`).join(""));
    };
    $bmrForm.on("input change", "input, select", function() {
        const formData = $bmrForm.serialize();
        $.ajax({
            url: "/v1/fitness/bmr",
            method: "POST",
            dataType: "json",
            data: formData,
            success: function(d) {
                const i = d.inputs || {};
                showResult(
                    `${d.data.bmr} kcal/day <div class="text-sm">formula : ${d.data.formula}</div>`,
                    [
                        `Sex: ${i.sex}`,
                        `Wt: ${i.weight_kg}kg`,
                        `Ht: ${i.height_cm}cm`,
                        `Age: ${i.age}`
                    ]
                );

                payload = {
                    inputs: d.inputs,
                    outputs: d.data,
                }

                input_error({});

            },
            error: function(xhr) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    input_error(res.errors);

                } catch (e) {
                    console.error("Response Text:", xhr.responseText);
                }
            }

        });
    });

    function input_error(res) {
        $('.age_error').text(res.age || '');
        $('.weight_error').text(res.weight_kg || '');
        $('.height_error').text(res.height_cm || '');
    }

    $('#saveBtnBmr').on('click', function() {
        if (!payload) return;
        btnChange(0);
        payload.calc_type = 'bmr'
        $.post("/v1/fitness/save", payload)
            .done((res) => {
                console.log(res)
                payload = {}
                btnChange(1);

            }).fail((xhr) => {

                btnChange(2);
                if (xhr.status == 401) {
                    showErrors(bmrError, 'Unauthorized user');
                }

            })
    });

    let openHistoryBmr = $('#openHistoryBmr');
    let HistorySheetBmr = $('#HistorySheetBmr');
    let closeHistorySheetBmr = $('#closeHistorySheetBmr');
    let historyListBmr = $('#historyListBmr');
    let closeHistorySheetBmr2 = $('#closeHistorySheetBmr2');
    let BmrPagination = $('#BmrPagination');


    openHistoryBmr.on('click', function() {
        show(HistorySheetBmr);
        loadRecent_bmr('/v1/fitness/recent', 'bmr');
    });
    closeHistorySheetBmr.on('click', function() {
        hide(HistorySheetBmr);
    });
    closeHistorySheetBmr2.on('click', function() {
        hide(HistorySheetBmr);

    });

    function loadRecent_bmr(url, type = "") {
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
                historyListBmr.empty();

                show_data_lists(res.data.data);
                paginations(res.data.links);
            })
            .fail(() =>
                historyListBmr
                .empty()
                .append('<li class="muted">Failed to load recent.</li>')
            );
    };

    function show_data_lists(response) {
        if (!response.length) {
            historyListBmr.append(
                '<li class="muted">No recent calculations.</li>'
            );
            return;
        }

        response.forEach((item) => {
            const li = document.createElement("li");
            li.className =
                "p-5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm space-y-4 transition hover:shadow-md";

            const i = item.inputs || {};
            const o = item.outputs || {};

            li.innerHTML = `
        <div class="flex justify-between items-center">
            <h3 class="font-semibold text-gray-900 dark:text-white text-base">
                #${item.id} — ${item.calc_type.toUpperCase()}
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
                    <p><strong>Age:</strong> ${i.age || "—"}</p>
                    <p><strong>Height:</strong> ${i.height_cm || "—"} cm</p>
                    <p><strong>Weight:</strong> ${i.weight_kg || "—"} kg</p>
                    <p><strong>Sex:</strong> ${i.sex || "—"}</p>
                </div>
            </div>

            <!-- Outputs -->
            <div class="rounded-xl bg-indigo-50 dark:bg-indigo-900/30 p-4">
                <h4 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Results</h4>
                <div class="space-y-1 text-gray-700 dark:text-gray-300">
                    <p>
                        <strong>BMR:</strong>
                        <span class="text-lg font-semibold text-indigo-700 dark:text-indigo-300">${o.bmr || "—"} kcal/day</span>
                    </p>
                    <p><strong>Formula:</strong> ${o.formula || "—"}</p>
                </div>
            </div>
        </div>
    `;

            historyListBmr.append(li);
        });

    }

    function paginations(links) {
        BmrPagination.empty();
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
                    loadRecent_bmr(link.url);
                });
            }

            BmrPagination.append($a);
        });
    }
</script>
<x-appfooter></x-appfooter>