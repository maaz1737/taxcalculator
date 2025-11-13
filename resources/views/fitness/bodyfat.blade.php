<x-app
    :title="'Body Fat Calculator – Calculate Body Fat Percentage, BMI & Fitness Level | QuickCalculatIt'"
    :des="'Use the free Body Fat Calculator by QuickCalculatIt to accurately estimate your body fat percentage using height, weight, age, and gender. Understand your body composition, track fitness progress, and find out if you are in a healthy range. Ideal for men and women to plan weight loss, muscle gain, or fitness goals effectively.'"
    :key="'body fat calculator, body fat percentage calculator, body composition calculator, body fat measurement, body fat chart, calculate body fat online, fitness and health calculator, body fat for men, body fat for women, BMI and body fat calculator, lean body mass calculator, muscle to fat ratio calculator, ideal body fat percentage, weight management calculator, health tracker, fitness progress tracker, QuickCalculatIt body fat calculator, body analysis tool, online fitness calculator, fat loss calculator, fitness goal calculator'"
    :titleTwitter="'Free Body Fat Calculator – Check Your Body Fat Percentage & Fitness Level | QuickCalculatIt'" />


<div class="px-6 sm:px-8 py-8 scroll-area bg-emerald-50 dark:bg-gray-900" id="calculatorRoot">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl 
                    bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">
                    🧘
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Body Fat Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Measure your body fat percentage using height, weight, and body measurements.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>

        <div class="relative body-fat grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            <div id="bodyfat_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- 🧮 Body Fat Form Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-yellow-300 dark:border-slate-700 
                        bg-yellow-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">

                <form id="form-bodyfat" class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold mb-4">Body Fat Calculator</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-1">Sex</label>
                            <select name="sex" class="input w-full rounded-xl dark:bg-slate-900 border border-yellow-300 dark:border-gray-400 px-3 py-2.5">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Height (cm)</label>
                            <input name="height_cm" type="number" placeholder="e.g. 170" class="search input w-full rounded-xl dark:bg-slate-900 border border-yellow-300 dark:border-gray-400 px-3 py-2.5">
                            <p class="height_error text-sm text-red-500 mt-2"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Waist (cm)</label>
                            <input name="waist_cm" type="number" placeholder="e.g. 80" class="search input w-full rounded-xl dark:bg-slate-900 border border-yellow-300 dark:border-gray-400 px-3 py-2.5">
                            <p class="waist_error text-sm text-red-500 mt-2"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Neck (cm)</label>
                            <input name="neck_cm" type="number" placeholder="e.g. 40" class="search input w-full rounded-xl dark:bg-slate-900 border border-yellow-300 dark:border-gray-400 px-3 py-2.5">
                            <p class="neck_error text-sm text-red-500 mt-2"></p>

                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Hip (cm) – Female only</label>
                            <input name="hip_cm" type="number" placeholder="e.g. 95" class="search input w-full rounded-xl dark:bg-slate-900 border border-yellow-300 dark:border-gray-400 px-3 py-2.5">
                            <p class="hip_error text-sm text-red-500 mt-2"></p>
                        </div>
                    </div>
                </form>

                <div class="border-t border-yellow-200 dark:border-slate-700 p-5 flex justify-end bg-yellow-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="saveBtn"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                               text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none 
                               focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300">
                        💾 Save
                    </button>
                    <span id="saveMsg" class="text-sm text-gray-500 ml-3 hidden"></span>
                </div>
            </div>

            <!-- 📊 Body Fat Result Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-red-300 dark:border-slate-700 
                        bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">

                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold mb-4">Body Fat Result</h2>

                    <div class="rounded-lg bg-purple-200 dark:bg-purple-900/40 p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Your Body Fat Percentage</div>
                        <div id="headlines" class="text-2xl font-semibold">—</div>
                        <div id="breakdown" class="mt-2 text-sm text-gray-600 dark:text-gray-300"></div>
                    </div>
                </div>

                <div class="border-t border-red-200 dark:border-slate-700 p-5 flex justify-end bg-red-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryBodyFat"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                               text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none 
                               focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 ">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>

        <!-- 🧠 Understanding Body Fat Section -->
        <div class="mt-10 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 
            text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Body Fat Percentage</h2>
            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Body Fat Percentage (BFP)</strong> is the proportion of fat compared to your total body weight.
                    It’s one of the most important indicators of fitness, health, and overall body composition.
                    Knowing your body fat percentage helps you plan workouts, manage weight, and achieve a healthy physique.
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Common Methods to Calculate Body Fat:</strong>
                <ul class="list-disc list-inside mt-2 text-gray-700 dark:text-gray-300">
                    <li><strong>U.S. Navy Formula:</strong> A popular method using body measurements like waist, neck, and height.</li>
                    <li><strong>Skinfold Caliper Test:</strong> Estimates fat from skinfold thickness at various points.</li>
                    <li><strong>BIA (Bioelectrical Impedance Analysis):</strong> Uses electrical currents to estimate fat and lean mass.</li>
                </ul>
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>U.S. Navy Formula:</strong><br>
                    <em>For Men:</em> 495 / (1.0324 − 0.19077 × log10(waist − neck) + 0.15456 × log10(height)) − 450<br>
                    <em>For Women:</em> 495 / (1.29579 − 0.35004 × log10(waist + hip − neck) + 0.22100 × log10(height)) − 450
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    <strong>Typical Body Fat Ranges:</strong><br>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mt-2">
                    <li>Essential Fat: Men 2–5%, Women 10–13%</li>
                    <li>Athletes: Men 6–13%, Women 14–20%</li>
                    <li>Fitness: Men 14–17%, Women 21–24%</li>
                    <li>Average: Men 18–24%, Women 25–31%</li>
                    <li>Obese: Men ≥ 25%, Women ≥ 32%</li>
                </ul>
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    Maintaining an optimal <strong>body fat percentage</strong> is essential for good health.
                    Too much fat increases the risk of heart disease and diabetes, while too little can cause hormonal imbalance and fatigue.
                    Use our <strong>Body Fat Calculator</strong> to find your current percentage and plan for a balanced, healthy body composition.
                </p>
            </div>
        </div>

        <!-- 💪 How to Improve Body Composition -->
        <div class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 
            text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">How to Improve Your Body Composition</h2>
            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    Improving body fat levels requires a combination of <strong>regular exercise</strong>, <strong>proper nutrition</strong>, and <strong>adequate rest</strong>.
                    To lower your body fat percentage and increase lean muscle mass:
                </p>

                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    <li>Follow a balanced diet rich in protein, complex carbs, and healthy fats.</li>
                    <li>Incorporate both strength training and cardio exercises into your routine.</li>
                    <li>Stay hydrated and get 7–8 hours of sleep each night.</li>
                    <li>Monitor progress using tools like the <strong>Body Fat Calculator</strong> and <strong>BMI Calculator</strong>.</li>
                </ul>

                <p class="text-gray-700 dark:text-gray-300">
                    Remember, healthy body fat levels vary depending on gender, age, and lifestyle.
                    Focus on <strong>long-term fitness goals</strong> rather than rapid fat loss for lasting health benefits.
                </p>
            </div>
        </div>

        <section>
            <div id="HistorySheetBodyFat" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Body Fat – History</h3>
                        <button id="closeHistorySheetBodyFat"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListBodyFat" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="BodyFatPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetBodyFat2"
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
    (function() {
        // 🧩 CSRF setup for AJAX (still needed for Save)
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute("content"),
            },
        });

        let root = $('.body-fat');
        let bodyfatError = $('#bodyfat_error');
        let $headline = root.find('#headlines');
        let $breakdown = root.find('#breakdown');
        let saveBtn = $('#saveBtn')
        let payload = {};
        let originalText = saveBtn.html();

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

        function show_result(res) {
            $headline.html(`
        <div class="text-lg font-semibold text-gray-900 dark:text-white">
            Body Fat: ${res.data.body_fat_pct}% 
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Method: ${res.data.method}
        </div>
    `);

            // Breakdown (details)
            $breakdown.html(`
        <div class="mt-2 space-y-1 text-sm text-gray-700 dark:text-gray-300">
            <div>• Sex: ${res.inputs.sex}</div>
            <div>• Height: ${res.inputs.height_cm} cm</div>
            <div>• Waist: ${res.inputs.waist_cm} cm</div>
            <div>• Neck: ${res.inputs.neck_cm} cm</div>
            ${i.sex === "female" ? `<div>• Hip: ${res.inputs.hip_cm} cm</div>` : ""}
        </div>
    `);
        }


        let form = root.find('#form-bodyfat');

        function bodyFat() {
            let formValue = form.serialize();
            $.ajax({
                url: "/v1/fitness/body-fat",
                method: "POST",
                dataType: "json",
                data: formValue,
                success: function(d) {
                    const i = d.inputs || {};

                    input_error({});

                    console.log(d)

                    payload = {
                        inputs: i,
                        outputs: d.data
                    }
                    show_result(d)
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
        form.on('input change', bodyFat);

        function input_error(res) {
            $('.height_error').text(res.height_cm || '');
            $('.waist_error').text(res.waist_cm || '');
            $('.neck_error').text(res.neck_cm || '');
            $('.hip_error').text(res.hip_cm || '');
        }
        $('#saveBtn').on("click", function(e) {
            e.preventDefault();
            if (!payload) return;
            btnChange(0);
            payload.calc_type = 'body-fat';
            $.post("/v1/fitness/save", payload)
                .done(res => {
                    showSuccessMessage(bodyfatError, res.message)
                    btnChange(1);
                    payload = {};
                })
                .fail((xhr) => {
                    btnChange(2);
                    if (xhr.status == 401) {
                        showErrors(bodyfatError, xhr.responseJSON.message)
                    }
                    if (xhr.status == 402) {
                        window.location.href = '/checkout';
                    }
                });
        });
        let openHistoryBodyFat = $('#openHistoryBodyFat');
        let HistorySheetBodyFat = $('#HistorySheetBodyFat');
        let closeHistorySheetBodyFat = $('#closeHistorySheetBodyFat');
        let closeHistorySheetBodyFat2 = $('#closeHistorySheetBodyFat2');
        let historyListBodyFat = $('#historyListBodyFat');
        let BodyFatPagination = $('#BodyFatPagination');

        openHistoryBodyFat.on('click', function() {
            show(HistorySheetBodyFat);
            load_body_fat_recent('/v1/fitness/recent', 'body-fat')

        })
        closeHistorySheetBodyFat.on('click', function() {
            hide(HistorySheetBodyFat)
        })
        closeHistorySheetBodyFat2.on('click', function() {
            hide(HistorySheetBodyFat)
        })

        function load_body_fat_recent(url, type = "") {
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

                    console.log(res)
                    show_data_body_fat_lists(res.data.data);
                    pagination_body_fat(res.data.links);
                })
                .fail();
        };

        function show_data_body_fat_lists(response) {
            historyListBodyFat.empty();
            if (!response.length) {
                historyListBodyFat.append(
                    '<li class="muted">No recent calculations.</li>'
                );
                return;
            }
            response.forEach((item) => {
                const li = document.createElement("li");
                li.className =
                    "p-5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-gradient-to-br from-white to-slate-50 dark:from-slate-800 dark:to-slate-900 shadow-md hover:shadow-lg transition-shadow duration-300";

                const i = item.inputs || {};
                const o = item.outputs || {};

                li.innerHTML = `
    <div class="flex justify-between items-center mb-3">
      <h3 class="font-semibold text-lg text-slate-900 dark:text-slate-100">
        <span class="text-indigo-600 dark:text-indigo-400">#${item.id}</span>
        <span class="ml-1">${item.calc_type.toUpperCase()}</span>
      </h3>
      <span class="text-xs text-slate-500 dark:text-slate-400">
        ${new Date(item.created_at).toLocaleString()}
      </span>
    </div>

    <div class="text-sm text-slate-700 dark:text-slate-300 space-y-2">
      <div class="bg-slate-100 dark:bg-slate-700/40 rounded-lg p-3">
        <p class="font-medium text-slate-800 dark:text-slate-200 mb-1">Inputs</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-xs">
          <div>👤 <strong>Sex:</strong> ${i.sex || '—'}</div>
          <div>📏 <strong>Height:</strong> ${i.height_cm || '—'} cm</div>
          <div>📉 <strong>Waist:</strong> ${i.waist_cm || '—'} cm</div>
          <div>🧍 <strong>Neck:</strong> ${i.neck_cm || '—'} cm</div>
          ${
              i.sex === "female"
                  ? `<div>🍑 <strong>Hip:</strong> ${i.hip_cm || '—'} cm</div>`
                  : ""
          }
        </div>
      </div>

      <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-lg p-3">
        <p class="font-medium text-indigo-700 dark:text-indigo-300 mb-1">Results</p>
        <div class="text-xs space-y-1">
          <div>💪 <strong>Body Fat:</strong> ${o.body_fat_pct || '—'}%</div>
          <div>📘 <strong>Method:</strong> ${o.method || 'US Navy'}</div>
        </div>
      </div>
    </div>
  `;

                historyListBodyFat.append(li);
            });

        }

        function pagination_body_fat(links) {
            BodyFatPagination.empty();
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
                        load_body_fat_recent(link.url);
                    });
                }

                BodyFatPagination.append($a);
            });
        }

    })();
</script>