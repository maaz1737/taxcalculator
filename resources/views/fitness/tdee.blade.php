<x-app
    :title="'TDEE Calculator – Calculate Total Daily Energy Expenditure & Calorie Burn | QuickCalculatIt'"
    :des="'Use the free TDEE Calculator by QuickCalculatIt to find out how many calories you burn per day based on your activity level, age, height, weight, and gender. Instantly calculate your Total Daily Energy Expenditure (TDEE) to plan your diet, maintain, lose, or gain weight effectively. Perfect for fitness tracking, nutrition planning, and calorie management.'"
    :key="'TDEE calculator, total daily energy expenditure calculator, daily calorie burn calculator, calorie maintenance calculator, calorie needs calculator, TDEE for men, TDEE for women, fitness and nutrition calculator, calorie intake calculator, energy expenditure calculator, calorie tracking, health and fitness tool, weight management calculator, calorie deficit calculator, BMR and TDEE calculator, diet planning tool, QuickCalculatIt TDEE calculator, metabolic rate calculator, online calorie calculator, daily energy calculator, calorie goal calculator'"
    :titleTwitter="'Free TDEE Calculator – Find Your Daily Calorie Burn & Energy Expenditure | QuickCalculatIt'" />


<div class="px-6 sm:px-8 py-8 scroll-area bg-emerald-50 dark:bg-gray-900">
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
                class="flex flex-col justify-between rounded-2xl border border-yellow-300 dark:border-slate-700 bg-yellow-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">TDEE Calculator</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">BMR (cal/day)</label>
                            <input name="bmr" id="tdee_bmr" type="number" placeholder="e.g. 1600"
                                class="search w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            <p class="input_error text-sm text-red-500 mt-2"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Activity Level</label>
                            <select name="activity" id="tdee_activity"
                                class="w-full rounded-xl border border-yellow-200 dark:border-slate-700 px-3 py-2.5 bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                                <option value="sedentary">Sedentary</option>
                                <option value="light">Light</option>
                                <option value="moderate">Moderate</option>
                                <option value="active">Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div
                    class="border-t border-yellow-200 dark:border-slate-700 p-5 flex justify-end bg-yellow-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="saveBtn"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-emerald-700 hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-300">
                        ⚙️ Save
                    </button>
                    <span id="saveMsg" class="text-green-600 hidden">Saved</span>

                </div>
            </form>

            <!-- 📊 TDEE Result -->
            <div
                class="flex flex-col justify-between rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">TDEE Result</h2>

                    <div class="rounded-lg bg-blue-200 dark:bg-blue-900/40 p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Your Total Daily Energy Expenditure</div>
                        <div id="headlines" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                        <div id="breakdown" class="text-sm text-slate-600 dark:text-slate-400 mt-2"></div>
                    </div>


                </div>

                <div
                    class="border-t border-red-200 dark:border-slate-700 p-5 flex justify-end bg-red-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryTDEE"
                        class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300 ">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>
        <!-- Section 1: Understanding Your TDEE -->
        <div
            class="mt-10 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Your Total Daily Energy Expenditure (TDEE)</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Total Daily Energy Expenditure (TDEE)</strong> is the total number of calories your body burns in a day,
                accounting for all activities such as resting, working, exercising, and even digesting food.
                It provides a complete picture of how much energy your body needs daily to maintain your current weight.
            </p>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Formula:</strong> TDEE = BMR × Activity Factor
                <br>
                <em>Activity Factors:</em><br>
                Sedentary: 1.2 | Lightly Active: 1.375 | Moderately Active: 1.55 | Active: 1.725 | Very Active: 1.9
            </p>

            <p class="text-gray-700 dark:text-gray-300">
                Knowing your <strong>TDEE</strong> helps you set accurate calorie targets for <strong>weight loss</strong>,
                <strong>muscle gain</strong>, or <strong>maintenance</strong>. It’s one of the most reliable methods to understand your
                <strong>daily calorie burn</strong> and manage your diet effectively.
            </p>
        </div>

        <!-- Section 2: Why TDEE is Important -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Why TDEE is Important for Fitness and Nutrition</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Your <strong>Total Daily Energy Expenditure</strong> is crucial for achieving your health and fitness goals.
                By understanding your TDEE, you can design a personalized meal and workout plan that aligns with your energy needs.
                It helps you avoid under-eating or over-eating, which can slow down progress or lead to weight gain.
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-1">
                <li><strong>Weight Loss:</strong> Consume fewer calories than your TDEE (calorie deficit).</li>
                <li><strong>Weight Gain:</strong> Eat more calories than your TDEE (calorie surplus).</li>
                <li><strong>Weight Maintenance:</strong> Match your calorie intake to your TDEE.</li>
            </ul>

            <p class="text-gray-700 dark:text-gray-300">
                Pair your <strong>TDEE calculation</strong> with your <a href="/fitness/bmr-calculator" class="text-red-600 dark:text-red-400 hover:underline">BMR (Basal Metabolic Rate)</a>
                and <a href="/fitness/macros-calculator" class="text-red-600 dark:text-red-400 hover:underline">Macros Calculator</a>
                to create a complete fitness strategy for long-term success.
            </p>
        </div>

        <!-- Section 3: Factors That Influence Your TDEE -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">What Factors Affect Your TDEE?</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-3">
                Your <strong>Total Daily Energy Expenditure</strong> isn’t fixed — it varies based on several lifestyle and biological factors:
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                <li><strong>BMR (Basal Metabolic Rate):</strong> The calories your body burns at rest.</li>
                <li><strong>Physical Activity:</strong> Exercise and movement increase daily calorie burn.</li>
                <li><strong>Thermic Effect of Food (TEF):</strong> The energy used during digestion and nutrient absorption.</li>
                <li><strong>Age:</strong> Metabolism slows as you get older, reducing TDEE.</li>
                <li><strong>Gender:</strong> Men generally have higher TDEE than women due to muscle mass.</li>
                <li><strong>Body Composition:</strong> More muscle means higher energy expenditure, even at rest.</li>
            </ul>
        </div>

        <!-- Section 4: How to Calculate and Use Your TDEE -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">How to Calculate and Use Your TDEE Effectively</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                To calculate your <strong>TDEE</strong>, first find your <strong>BMR</strong> using the
                <a href="/fitness/bmr-calculator" class="text-red-600 dark:text-red-400 hover:underline">BMR Calculator</a>.
                Then multiply your BMR by your activity factor (based on your lifestyle).
                This gives you the total calories you burn each day.
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1 mb-4">
                <li><strong>Sedentary (little or no exercise):</strong> BMR × 1.2</li>
                <li><strong>Lightly Active (light exercise 1–3 days/week):</strong> BMR × 1.375</li>
                <li><strong>Moderately Active (moderate exercise 3–5 days/week):</strong> BMR × 1.55</li>
                <li><strong>Active (hard exercise 6–7 days/week):</strong> BMR × 1.725</li>
                <li><strong>Very Active (physical job or intense training):</strong> BMR × 1.9</li>
            </ul>

            <p class="text-gray-700 dark:text-gray-300">
                Once you have your <strong>TDEE results</strong>, you can use them to adjust your diet, track calories, and
                optimize your nutrition using the <a href="/fitness/macros-calculator" class="text-red-600 dark:text-red-400 hover:underline">Macros Calculator</a>
                for protein, carbs, and fat balance.
            </p>
        </div>

        <!-- Section 5: Related Calculators -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Explore Related Fitness Calculators</h2>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                <li><a href="/fitness/bmr-calculator" class="text-red-600 dark:text-red-400 hover:underline">BMR Calculator</a> – Find your resting metabolic rate.</li>
                <li><a href="/fitness/macros-calculator" class="text-red-600 dark:text-red-400 hover:underline">Macros Calculator</a> – Get your daily nutrient ratios.</li>
                <li><a href="/fitness/bmi-calculator" class="text-red-600 dark:text-red-400 hover:underline">BMI Calculator</a> – Check your healthy weight range.</li>
                <li><a href="/fitness/body-fat-calculator" class="text-red-600 dark:text-red-400 hover:underline">Body Fat Calculator</a> – Estimate body fat percentage.</li>
                <li><a href="/fitness/ideal-weight-calculator" class="text-red-600 dark:text-red-400 hover:underline">Ideal Weight Calculator</a> – Find your target body weight.</li>
            </ul>
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
                if (xhr.status == 402) {
                    window.location.href = '/checkout';
                }
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