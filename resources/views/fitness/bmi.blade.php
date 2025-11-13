<x-app
    :title="'BMR Calculator – Calculate Your Basal Metabolic Rate, Daily Calorie Needs & Metabolism | QuickCalculatIt'"
    :des="'Use the free BMR Calculator by QuickCalculatIt to calculate your Basal Metabolic Rate instantly. Discover how many calories your body burns at rest and estimate your daily energy expenditure. Get accurate BMR results based on your age, gender, height, and weight to plan your diet, weight loss, or fitness goals effectively.'"
    :key="'BMR calculator, basal metabolic rate calculator, daily calorie needs, calorie calculator, TDEE calculator, metabolism calculator, energy expenditure calculator, body calorie burn rate, calorie maintenance calculator, fitness and nutrition calculator, weight management tool, health calculator, diet planning calculator, BMR for men, BMR for women, calculate BMR online, QuickCalculatIt BMR calculator, metabolic health, body energy calculator, resting calorie burn calculator, online BMR chart'"
    :titleTwitter="'Free BMR Calculator – Find Your Basal Metabolic Rate & Daily Calorie Burn | QuickCalculatIt'" />



<div class="px-6 sm:px-8 py-8 scroll-area bg-emerald-50 dark:bg-gray-900">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl 
                    bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                    ⚖️
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">BMI Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Calculate your Body Mass Index to determine your weight category and health status.</p>
                </div>
            </div>
        </header>

        <!-- BMI Calculator Root -->
        <div id="calculatorRoot" class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mt-4">
            <div id="bmi_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- BMI Form -->
            <div class="flex flex-col justify-between rounded-2xl border border-yellow-300 dark:border-slate-700 
                        bg-yellow-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">BMI Calculator</h2>
                    <form id="form-bmi" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Height</label>
                            <input name="height" value="0" type="number" placeholder="e.g. 170" class="search w-full rounded-xl border-yellow-300 dark:border-gray-400 dark:bg-slate-900 border px-3 py-2.5">
                            <p class="height_error text-sm text-red-500 mt-2"></p>

                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Weight</label>
                            <input name="weight" value="0" type="number" placeholder="e.g. 65" class="search w-full rounded-xl border-yellow-300 dark:border-gray-400 dark:bg-slate-900 border px-3 py-2.5">
                            <p class="weight_error text-sm text-red-500 mt-2"></p>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Unit System</label>
                            <select name="unit" class="w-full rounded-xl border-yellow-300 dark:border-gray-400 dark:bg-slate-900 border px-3 py-2.5">
                                <option value="metric">Metric (kg, cm)</option>
                                <option value="imperial">Imperial (lbs, in)</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="border-t border-yellow-300 dark:border-slate-700 p-5 flex justify-end bg-yellow-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="saveBtn" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-emerald-800 hover:bg-emerald-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">💾 Save</button>
                    <span id="saveMsg" class="text-green-600 hidden">Saved</span>
                </div>
            </div>

            <!-- BMI Result -->
            <div class="flex flex-col justify-between rounded-2xl border border-red-300 dark:border-slate-700 
                        bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">BMI Result</h2>
                    <div class="rounded-lg bg-indigo-200 dark:bg-indigo-900/40 p-4">
                        <div class="text-sm text-gray-700 dark:text-gray-200">Your BMI</div>
                        <div id="headlines" class="text-2xl font-semibold text-gray-900 dark:text-white">—</div>
                    </div>

                    <div class="rounded-lg bg-teal-200 dark:bg-teal-900/40 p-4 flex justify-between items-center">
                        <span class="text-sm font-medium">BMI input</span>
                        <span id="breakdown" class="font-semibold text-gray-900 text-sm dark:text-white">—</span>
                    </div>
                </div>
                <div class="border-t border-red-300 dark:border-slate-700 p-5 flex justify-end bg-red-100 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryBmi" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                            text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                            dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                            dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>

        </div>
        <!-- Section 1: Understanding BMI -->
        <div
            class="mt-10 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Your Body Mass Index (BMI)</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Body Mass Index (BMI)</strong> is a simple yet powerful measurement that estimates if your weight is healthy for your height.
                It helps determine your <strong>weight category</strong>—underweight, normal, overweight, or obese—based on your height and weight.
            </p>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Metric Formula:</strong> BMI = weight (kg) ÷ [height (m)]² <br>
                <strong>Imperial Formula:</strong> BMI = 703 × weight (lbs) ÷ [height (in)]²
            </p>

            <div>
                <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">BMI Categories:</h3>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    <li>Underweight: &lt; 18.5</li>
                    <li>Normal (Healthy Weight): 18.5 – 24.9</li>
                    <li>Overweight: 25 – 29.9</li>
                    <li>Obese: ≥ 30</li>
                </ul>
            </div>
        </div>

        <!-- Section 2: Why BMI Matters -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Why Your BMI Matters</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Knowing your <strong>BMI (Body Mass Index)</strong> helps you understand your overall health and fitness level.
                A healthy BMI reduces the risk of chronic diseases like heart disease, high blood pressure, type 2 diabetes, and obesity.
                Tracking your BMI regularly can guide you toward maintaining a balanced lifestyle and reaching your <strong>fitness goals</strong>.
            </p>

            <p class="text-gray-700 dark:text-gray-300">
                Your BMI doesn’t directly measure body fat, but it’s an effective screening tool to assess whether your weight could affect your health.
                For a more complete analysis, use related tools like the
                <a href="/fitness/body-fat-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Body Fat Calculator</a> or
                <a href="/fitness/ideal-weight-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Ideal Weight Calculator</a>.
            </p>
        </div>

        <!-- Section 3: Limitations of BMI -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Limitations of BMI</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                While <strong>BMI</strong> is useful for most people, it has limitations. It doesn’t distinguish between fat and muscle mass,
                so muscular individuals or athletes may have a high BMI even though their body fat percentage is low.
                Similarly, older adults might have a normal BMI but higher body fat levels.
            </p>

            <p class="text-gray-700 dark:text-gray-300">
                That’s why it’s important to pair your BMI with other health metrics such as:
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                <li><a href="/fitness/body-fat-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Body Fat Percentage</a></li>
                <li><a href="/fitness/bmr-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Basal Metabolic Rate (BMR)</a></li>
                <li><a href="/fitness/tdee-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Total Daily Energy Expenditure (TDEE)</a></li>
            </ul>
        </div>

        <!-- Section 4: How to Maintain a Healthy BMI -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">How to Maintain a Healthy BMI</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-3">
                Achieving and maintaining a <strong>healthy BMI</strong> involves a combination of balanced nutrition, regular physical activity, and healthy habits.
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                <li>Eat a balanced diet with lean proteins, fruits, vegetables, and whole grains.</li>
                <li>Exercise regularly—aim for at least 150 minutes of moderate activity per week.</li>
                <li>Track your calorie needs using the <a href="/fitness/tdee-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">TDEE Calculator</a>.</li>
                <li>Stay hydrated and get enough sleep to support recovery and metabolism.</li>
                <li>Recalculate your BMI regularly to track progress over time.</li>
            </ul>

            <p class="text-gray-700 dark:text-gray-300 mt-3">
                Maintaining a stable, healthy weight not only improves appearance but also enhances energy levels, reduces stress, and promotes long-term wellness.
            </p>
        </div>

        <!-- Section 5: Related Fitness Calculators -->
        <div
            class="mt-6 rounded-2xl border border-red-300 dark:border-slate-700 bg-red-100/30 dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Try Other Fitness Calculators</h2>

            <p class="text-gray-700 dark:text-gray-300 mb-3">
                Explore more free tools by QuickCalculatIt to better understand your health, fitness, and nutrition needs:
            </p>

            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
                <li><a href="/fitness/bmr-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">BMR Calculator</a> – Estimate your resting calorie burn.</li>
                <li><a href="/fitness/tdee-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">TDEE Calculator</a> – Find your total daily calorie needs.</li>
                <li><a href="/fitness/body-fat-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Body Fat Calculator</a> – Measure your body fat percentage.</li>
                <li><a href="/fitness/ideal-weight-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Ideal Weight Calculator</a> – Discover your healthy weight range.</li>
                <li><a href="/fitness/macros-calculator" class="text-yellow-600 dark:text-yellow-400 hover:underline">Macros Calculator</a> – Calculate daily protein, carb, and fat intake.</li>
            </ul>
        </div>

        <section>
            <div id="HistorySheetBmi" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">BMI – History</h3>
                        <button id="closeHistorySheetBmi"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListBmi" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="BmiPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySheetBmi2"
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
    $(document).ready(function() {
        const $form = $("#form-bmi");
        const $headline = $("#headlines");
        const $breakdown = $("#breakdown");
        const bmi_error = $("#bmi_error");
        let bmiSave = $("#saveBtn");
        const original = bmiSave.html();

        let payload = {};
        const showResult = (headline, breakdown = []) => {
            $("#headlines").empty();
            $("#headlines").html(headline || "—");
            $("#breakdown").html(breakdown.map(b => `<div>• ${b}</div>`).join(""));
        };


        function btnChange(status = 1) {
            if (status === 0) {
                bmiSave.disabled = true;
                bmiSave.addClass("opacity-70", "cursor-wait");
                bmiSave.html(`
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2z"/></svg>
        Saving...
      `);
            } else if (status === 1) {
                bmiSave.removeClass(
                    "opacity-70",
                    "cursor-wait"
                );
                bmiSave.html("✔ Saved");
                setTimeout(() => {
                    bmiSave.disabled = false;
                    bmiSave.html(original);
                }, 2000)
            } else if (status === 2) {
                bmiSave.removeClass(
                    "opacity-70",
                    "cursor-wait"
                );
                bmiSave.html("Error ✗");
                setTimeout(() => {
                    bmiSave.disabled = false;
                    bmiSave.html(original);
                }, 2000)
            }
        }


        function calculateBMI() {
            const formData = $form.serialize();
            $.ajax({
                url: "/v1/fitness/bmi",
                method: "POST",
                dataType: "json",
                data: formData,
                success: function(d) {
                    const i = d.inputs || {};
                    const result = d.data || {};

                    payload = {
                        inputs: i,
                        outputs: d.data,
                    }

                    // dynamically change display units based on selected category
                    let weightLabel = "kg";
                    let heightLabel = "cm";

                    if (i.unit && i.unit.toLowerCase() === "imperial") {
                        weightLabel = "lb";
                        heightLabel = "ft/in";
                    }

                    showResult(
                        `
                <div class="text-xl font-bold text-blue-600">
                    BMI : ${result.bmi}
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <div><strong>Unit:</strong> ${result.unit}</div>
                    <div><strong>Category:</strong> ${result.category}</div>
                    <div><strong>Advice:</strong> ${result.advice}</div>
                </div>
                `,
                        [
                            `Unit system: ${i.unit}`,
                            `Height: ${i.height} ${heightLabel}`,
                            `Weight: ${i.weight} ${weightLabel}`
                        ]
                    );
                    input_error({})
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


        $form.on("input change", calculateBMI);
        calculateBMI()

        function input_error(res) {
            $('.height_error').text(res.height || '');
            $('.weight_error').text(res.weight || '');
        }




        $("#saveBtn").on("click", function() {
            if (!payload) return;
            btnChange(0);
            payload.calc_type = 'bmi';
            $.post("/v1/fitness/save", payload)
                .done(res => {
                    showSuccessMessage(bmi_error, res.message)
                    btnChange(1);
                    payload = {};
                })
                .fail((xhr) => {
                    if (xhr.status == 401) {
                        showErrors(bmi_error, xhr.responseJSON.message)
                    }
                    btnChange(2);

                    if (xhr.status == 402) {
                        window.location.href = '/checkout';
                    }
                });
        });
    });

    let openHistoryBmi = $("#openHistoryBmi");
    let HistorySheetBmi = $("#HistorySheetBmi");
    let closeHistorySheetBmi = $("#closeHistorySheetBmi");
    let historyListBmi = $("#historyListBmi");
    let BmiPagination = $("#BmiPagination");
    let closeHistorySheetBmi2 = $("#closeHistorySheetBmi2");

    openHistoryBmi.on("click", function() {
        show(HistorySheetBmi);
        loadRecents('/v1/fitness/recent', 'bmi');
    });
    closeHistorySheetBmi2.on("click", function() {
        hide(HistorySheetBmi);
    });
    closeHistorySheetBmi.on("click", function() {
        hide(HistorySheetBmi);
    });



    function loadRecents(url, type = "") {
        const params = new URLSearchParams({
            per_page: 5,
        });
        if (type) params.set("type", type);
        const new_url = url.replace(/^\/?fitness\/?/i, "");
        $.ajax({
                url: new_url,
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
                console.log(res);
                historyListBmi.empty();

                show_data_lists(res.data.data);
                paginations(res.data.links);
            })
            .fail(() =>
                historyListBmi
                .empty()
                .append('<li class="muted">Failed to load recent.</li>')
            );
    };

    function show_data_lists(response) {
        if (!response.length) {
            historyListBmi.append(
                '<li class="muted">No recent calculations.</li>'
            );
            return;
        }
        response.forEach((item) => {
            const li = document.createElement("li");
            li.className =
                "p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm";

            const i = item.inputs || {};
            const o = item.outputs || {};

            // Convert height and weight display based on unit
            let heightDisplay = "";
            let weightDisplay = "";

            if (i.unit === "metric") {
                heightDisplay = `${i.height} cm`;
                weightDisplay = `${i.weight} kg`;
            } else if (i.unit === "imperial") {
                // You can adjust these conversions as you like
                const heightFeet = (i.height / 12).toFixed(1); // assuming inches to feet
                const weightLbs = i.weight; // usually already in lbs
                heightDisplay = `${heightFeet} ft/in`;
                weightDisplay = `${weightLbs} lbs`;
            } else {
                heightDisplay = i.height || "-";
                weightDisplay = i.weight || "-";
            }

            li.innerHTML = `
        <div class="flex justify-between items-center mb-3">
            <h3 class="font-semibold text-gray-900 dark:text-white">
                #${item.id} – ${item.calc_type.toUpperCase()}
            </h3>
            <span class="text-xs text-gray-500 dark:text-gray-400">
                ${new Date(item.created_at).toLocaleString()}
            </span>
        </div>

        <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
            <p><strong>Height:</strong> ${heightDisplay}</p>
            <p><strong>Weight:</strong> ${weightDisplay}</p>
            <p><strong>Unit:</strong> ${o.unit}</p>
            <div class="mt-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 p-3">
                <p><strong>BMI:</strong> <span class="font-semibold">${o.bmi}</span></p>
                <p><strong>Category:</strong> 
                    <span class="font-medium ${
                        o.category === "Obese"
                            ? "text-red-600 dark:text-red-400"
                            : o.category === "Overweight"
                            ? "text-yellow-600 dark:text-yellow-400"
                            : "text-green-600 dark:text-green-400"
                    }">${o.category}</span>
                </p>
                <p><strong>Advice:</strong> ${o.advice}</p>
            </div>
        </div>
    `;

            historyListBmi.append(li);
        });

    }

    function paginations(links) {
        BmiPagination.empty();
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

            BmiPagination.append($a);
        });
    }
</script>
<x-appfooter></x-appfooter>