<x-app
    :title="'Macros Calculator – Calculate Protein, Carbs & Fat Intake | QuickCalculatIt'"
    :des="'QuickCalculatIt Macros Calculator helps you calculate the optimal daily intake of protein, carbs, and fats based on your goals and TDEE.'"
    :key="'macros calculator, protein calculator, carbs calculator, fat calculator, nutrition tools, fitness calculator, QuickCalculatIt'" />

<div class="px-6 sm:px-8 py-8 scroll-area">
    <div class="container mx-auto max-w-6xl">
        <header class="mb-10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-2xl grid place-items-center text-xl 
                    bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                    🥗
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Macros Calculator</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Calculate your daily macronutrient needs — protein, carbs, and fats — for your fitness goal.</p>
                </div>
            </div>
            <span class="text-xs px-2 py-1 rounded-lg border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-gray-300">
                Dark mode ready
            </span>
        </header>
        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mt-4">
            <div id="macros_error"
                class=" absolute top-0 left-0 w-[45%] mb-4 text-sm text-red-700 bg-red-100 border border-red-200 dark:text-red-300 dark:bg-red-900/30 dark:border-red-800 rounded-lg px-3 py-2
                transform -translate-y-full opacity-0 transition-all duration-500 ease-in-out">
            </div>
            <!-- 🧮 Macros Form Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <form action="" id="macros-form">
                    <div class="p-6 space-y-5">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Macros Calculator</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Calories (kcal)</label>
                                <input id="macros_calories" type="number" placeholder="e.g. 2000"
                                    class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 
                                       bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Carbs %</label>
                                <input id="macros_carb_pct" type="number" value="50"
                                    class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 
                                       bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Protein %</label>
                                <input id="macros_protein_pct" type="number" value="20"
                                    class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 
                                       bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1 text-gray-800 dark:text-gray-200">Fat %</label>
                                <input id="macros_fat_pct" type="number" value="30"
                                    class="w-full rounded-xl border border-gray-200 dark:border-slate-700 px-3 py-2.5 
                                       bg-white dark:bg-slate-900 focus:ring-2 focus:ring-indigo-400/40">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="btnSaveMacros" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                                                     text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                                                     focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                                                     dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                                                     dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        💾 Save
                    </button>
                </div>
            </div>

            <!-- 📊 Macros Result Section -->
            <div class="flex flex-col justify-between rounded-2xl border border-slate-300 dark:border-slate-700 
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm">
                <div class="p-6 space-y-5">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Macros Result</h2>

                    <!-- Carbs -->
                    <div class="rounded-lg bg-blue-100 dark:bg-blue-900/40 p-4 flex justify-between items-center">
                        <span class="text-sm font-medium">Carbs (g)</span>
                        <span id="macros_carb_result" class="font-semibold text-gray-900 dark:text-white">—</span>
                    </div>

                    <!-- Protein -->
                    <div class="rounded-lg bg-red-100 dark:bg-red-900/40 p-4 flex justify-between items-center">
                        <span class="text-sm font-medium">Protein (g)</span>
                        <span id="macros_protein_result" class="font-semibold text-gray-900 dark:text-white">—</span>
                    </div>

                    <!-- Fat -->
                    <div class="rounded-lg bg-yellow-100 dark:bg-yellow-900/40 p-4 flex justify-between items-center">
                        <span class="text-sm font-medium">Fat (g)</span>
                        <span id="macros_fat_result" class="font-semibold text-gray-900 dark:text-white">—</span>
                    </div>
                </div>

                <div class="border-t border-slate-200 dark:border-slate-700 p-5 flex justify-end bg-gray-50 dark:bg-gray-900/50 rounded-b-2xl">
                    <button id="openHistoryMacros" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium 
                                                           text-white bg-gray-900 hover:bg-gray-800 focus:outline-none 
                                                           focus:ring-2 focus:ring-offset-2 focus:ring-slate-300 
                                                           dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 
                                                           dark:focus:ring-slate-600 dark:focus:ring-offset-gray-900">
                        🕓 History
                    </button>
                </div>
            </div>
        </div>

        <!-- ℹ️ Macros Explanation Section -->
        <div class="mt-10 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-gray-800 
                    text-gray-900 dark:text-white shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Understanding Macros</h2>

            <div class="space-y-4 text-sm leading-relaxed">
                <p class="text-gray-700 dark:text-gray-300">
                    Macronutrients are nutrients your body needs in large amounts: <strong>Carbohydrates, Protein, and Fat</strong>.
                    They provide energy and building blocks for your body.
                </p>

                <p class="text-gray-700 dark:text-gray-300">
                    Based on your daily calorie intake, you can calculate grams of each macronutrient using percentages:
                </p>

                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    <li>Carbs (g) = (Calories × Carbs %) ÷ 4</li>
                    <li>Protein (g) = (Calories × Protein %) ÷ 4</li>
                    <li>Fat (g) = (Calories × Fat %) ÷ 9</li>
                </ul>

                <p class="text-gray-700 dark:text-gray-300">
                    Adjust these ratios according to your fitness goals: weight loss, maintenance, or muscle gain.
                </p>
            </div>
        </div>
        <section>
            <div id="HistorySheetMacros" class="fixed inset-x-0 bottom-0 z-[70] max-h-[85vh] translate-y-full opacity-0 pointer-events-none transition ease-out duration-300">
                <div class="mx-auto w-[min(900px,95vw)] rounded-t-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-slate-700 bg-white dark:bg-gray-900">
                    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Macros – History</h3>
                        <button id="closeHistorySalary"
                            class="inline-flex items-center justify-center h-9 w-9 rounded-full text-gray-500 dark:text-gray-300 hover:bg-gray-200/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-slate-300 dark:focus:ring-slate-600"
                            aria-label="Close history">✕</button>
                    </div>
                    <div class="p-5 overflow-y-auto max-h-[70vh] scroll-area">
                        <ol id="historyListMacros" class="space-y-3 text-sm text-gray-700 dark:text-gray-300"></ol>
                        <div class="mt-4" id="MacrosPagination"></div>
                    </div>
                    <div class="px-5 py-3 border-t border-gray-200 dark:border-slate-700 flex justify-end">
                        <button id="closeHistorySalary2"
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
    let saveBtn = $("#btnSaveMacros");
    let originalText = saveBtn.html();
    const API = {
        macros: "/v1/fitness/macros",
        save: "/v1/fitness/save",
        recent: "/v1/fitness/recent",
    };
    (function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        });

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
        const debounce = (fn, wait = 500) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), wait);
            };
        };

        const showError = ($input, msg) => {
            $input.next(".error-text").remove();
            if (msg) {
                $input.after(
                    `<p class="error-text text-xs text-red-500 mt-1">${msg}</p>`
                );
            }
        };

        const validateForm = ($form) => {
            let valid = true;

            const calories = parseFloat($form.find("#macros_calories").val());
            const carbPct = parseFloat($form.find("#macros_carb_pct").val());
            const proteinPct = parseFloat($form.find("#macros_protein_pct").val());
            const fatPct = parseFloat($form.find("#macros_fat_pct").val());
            const totalPct = carbPct + proteinPct + fatPct;

            // Clear old errors
            $form.find(".error-text").remove();

            if (isNaN(calories) || calories <= 0) {
                showError($form.find("#macros_calories"), "Calories must be greater than 0.");
                valid = false;
            }

            if (isNaN(carbPct) || carbPct < 0 || carbPct > 100) {
                showError($form.find("#macros_carb_pct"), "Carbs % must be between 0 and 100.");
                valid = false;
            }

            if (isNaN(proteinPct) || proteinPct < 0 || proteinPct > 100) {
                showError($form.find("#macros_protein_pct"), "Protein % must be between 0 and 100.");
                valid = false;
            }

            if (isNaN(fatPct) || fatPct < 0 || fatPct > 100) {
                showError($form.find("#macros_fat_pct"), "Fat % must be between 0 and 100.");
                valid = false;
            }

            if (valid && totalPct !== 100) {
                const msg = `Total must equal 100% (current: ${totalPct}%)`;
                showError($form.find("#macros_carb_pct"), msg);
                showError($form.find("#macros_protein_pct"), msg);
                showError($form.find("#macros_fat_pct"), msg);
                valid = false;
            }

            return valid;
        };

        const calculateMacros = (calories, carbsPct, proteinPct, fatPct) => {
            const carbs = ((calories * carbsPct) / 100) / 4;
            const protein = ((calories * proteinPct) / 100) / 4;
            const fat = ((calories * fatPct) / 100) / 9;

            return {
                carbs: carbs.toFixed(1),
                protein: protein.toFixed(1),
                fat: fat.toFixed(1),
            };
        };

        const showResults = (macros) => {
            $("#macros_carb_result").text(macros.carbs);
            $("#macros_protein_result").text(macros.protein);
            $("#macros_fat_result").text(macros.fat);
        };

        const bindMacrosCalculator = () => {
            const $form = $("body").find("#macros_calories").closest("form").length ?
                $("body").find("#macros_calories").closest("form") :
                $("body"); // fallback

            const run = debounce(() => {
                if (!validateForm($form)) {
                    showResults({
                        carbs: "—",
                        protein: "—",
                        fat: "—"
                    });
                    return;
                }

                const calories = parseFloat($("#macros_calories").val());
                const carbsPct = parseFloat($("#macros_carb_pct").val());
                const proteinPct = parseFloat($("#macros_protein_pct").val());
                const fatPct = parseFloat($("#macros_fat_pct").val());

                const result = calculateMacros(calories, carbsPct, proteinPct, fatPct);
                showResults(result);

                window.currentCalcPayload = {
                    calc_type: "macros",
                    inputs: {
                        calories,
                        carbsPct,
                        proteinPct,
                        fatPct
                    },
                    outputs: result,
                };
            }, 400);

            $("#macros_calories, #macros_carb_pct, #macros_protein_pct, #macros_fat_pct").on(
                "input change",
                run
            );
        };

        $(document).ready(() => {
            bindMacrosCalculator();

            // Save button
            $("#btnSaveMacros").on("click", () => {
                const $form = $("body");
                if (!validateForm($form)) return;

                const payload = window.currentCalcPayload;
                if (!payload) return;
                btnChange(0)
                $.post(API.save, payload)
                    .done((res) => {
                        showSuccessMessage($('#macros_error'), res.message);
                        btnChange(1)
                        $('#macros-form')[0].reset();
                    })
                    .fail((xhr) => {
                        console.log(xhr)
                        showErrors($('#macros_error'), xhr.responseJSON.message);
                        btnChange(2)
                    });
            });
        });
    })();



    var $openBtn = $("#openHistoryMacros");
    var $sheet = $("#HistorySheetMacros");
    var $MacrosPagination = $("#MacrosPagination");
    var $historyListMacros = $("#historyListMacros");
    var $closeBtns = $sheet.find(
        '[id^="close"], [data-close], .js-close-sheet'
    );


    $openBtn.on('click', () => {
        show($sheet);
    })
    $closeBtns.on('click', () => {
        hide($sheet);
    })
    $openBtn.on('click', function() {
        loadRecent('/v1/fitness/recent', 'macros')
    })
</script>