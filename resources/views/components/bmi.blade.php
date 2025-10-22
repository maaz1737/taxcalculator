<template id="fitnessTpl">
    <div class="wrap space-y-6">

        <div class="grid md:grid-cols-3 gap-6">
            <!-- LEFT -->
            <div class="space-y-4 md:col-span-2">
                <!-- Tabs -->
                <div class="flex flex-wrap gap-2" id="tabs">
                    <button class="tab active" data-tab="#tab-bmi">BMI</button>
                    <button class="tab" data-tab="#tab-bmr">BMR</button>
                    <button class="tab" data-tab="#tab-tdee">TDEE</button>
                    <button class="tab" data-tab="#tab-bodyfat">Body Fat</button>
                    <button class="tab" data-tab="#tab-ideal">Ideal Weight</button>
                    <button class="tab" data-tab="#tab-macros">Macros</button>
                </div>

                <!-- Result -->
                <div class="card">
                    <div class="uppercase text-xs text-slate-500">Result</div>
                    <div id="headline" class="text-xl font-bold">—</div>
                    <div id="breakdown" class="text-sm text-slate-600 dark:text-slate-400"></div>
                    <div class="flex items-center gap-3 mt-3">
                        <button id="saveBtn" class="px-4 py-2 rounded-lg bg-brand text-white hover:opacity-90">Save</button>
                        <span id="saveMsg" class="text-green-600 hidden">Saved</span>
                    </div>
                </div>

                <!-- BMI -->
                <div id="tab-bmi" class="card">
                    <form id="form-bmi" class="space-y-3">
                        <div>
                            <input type="hidden" id="bmi" name="bmi" value="bmi">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Unit</label>
                            <select name="unit" class="form-control bmiselect">
                                <option value="metric">Metric (kg, m)</option>
                                <option value="imperial">Imperial (lb, in)</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Weight</label>
                                <input name="weight" type="number" step="0.1" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Height</label>
                                <input name="height" type="number" step="0.01" class="form-control search" />
                            </div>
                        </div>
                    </form>
                </div>

                <!-- BMR -->
                <div id="tab-bmr" class="card hidden">
                    <form id="form-bmr" class="space-y-3">
                        <div>
                            <input type="hidden" id="bmr" name="bmr" value="bmr">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="sex" class="form-control bmiselect">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Age</label>
                                <input name="age" type="number" class="form-control search" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Weight (kg)</label>
                                <input name="weight_kg" type="number" step="0.1" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                        </div>
                    </form>
                </div>

                <!-- TDEE -->
                <div id="tab-tdee" class="card hidden">
                    <form id="form-tdee" class="space-y-3">
                        <div>
                            <input type="hidden" id="tdee" name="tdee" value="tdee">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">BMR</label>
                                <input name="bmr" type="number" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Activity</label>
                                <select name="activity" class="form-control bmiselect">
                                    <option value="sedentary">Sedentary</option>
                                    <option value="light">Light</option>
                                    <option value="moderate">Moderate</option>
                                    <option value="active">Active</option>
                                    <option value="very">Very Active</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Body Fat -->
                <div id="tab-bodyfat" class="card hidden">
                    <form id="form-bodyfat" class="space-y-3">
                        <div>
                            <input type="hidden" id="body-fat" name="body-fat" value="body-fat">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="sex" class="form-control bmiselect">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Waist (cm)</label>
                                <input name="waist_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Neck (cm)</label>
                                <input name="neck_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Hip (cm) <span class="muted">(for female)</span></label>
                                <input name="hip_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Ideal Weight -->
                <div id="tab-ideal" class="card hidden">
                    <form id="form-ideal" class="space-y-3">
                        <div>
                            <input type="hidden" id="ideal" name="ideal" value="ideal">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Sex</label>
                                <select name="sex" class="form-control bmiselect">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="form-control search" />
                            </div>
                        </div>
                    </form>
                </div>




                <!-- Macros -->
                <div id="tab-macros" class="card hidden">
                    <form id="form-macros" class="space-y-3">
                        <div>
                            <input type="hidden" id="macros" name="macros" value="macros">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Calories</label>
                            <input name="calories" type="number" class="form-control search" />
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="block text-sm font-medium">Carbs %</label>
                                <input name="carb_pct" type="number" value="50" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Protein %</label>
                                <input name="protein_pct" type="number" value="20" class="form-control search" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium">Fat %</label>
                                <input name="fat_pct" type="number" value="30" class="form-control search " />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT -->
            <aside class="scroll-skin card">
                <div class=" flex items-center justify-between mb-2">
                    <h3 class="font-semibold">Recent</h3>
                    <select id="recentType" class="form-control bmiselect" style="max-width: 160px;">
                        <option value="">All</option>
                        <option value="bmi">BMI</option>
                        <option value="bmr">BMR</option>
                        <option value="tdee">TDEE</option>
                        <option value="body-fat">Body Fat</option>
                        <option value="ideal">Ideal</option>
                        <option value="macros">Macros</option>
                    </select>
                </div>
                <ul id="recentList" class="scroll-area space-y-2 text-sm mt-1" style="overflow: auto;height:250px;"></ul>
            </aside>
        </div>
    </div>
    <script src="assets/js/filter.js"></script>
</template>