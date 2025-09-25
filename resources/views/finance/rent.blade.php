<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Affordability Calculator</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <div class="container mx-auto max-w-4xl px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Rent Affordability Calculator</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Form -->
            <div class="p-4 border rounded-lg bg-white">
                <form id="rent-form">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Monthly Income</label>
                        <input type="number" step="0.01" name="monthly_income" id="monthly_income" class="w-full border rounded p-2" value="6000" required>
                    </div>

                    <div class="mb-3 flex items-center gap-2">
                        <input type="checkbox" name="income_is_gross" id="income_is_gross" checked>
                        <label for="income_is_gross" class="text-sm">Income is Gross (before tax)</label>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Monthly Debts</label>
                        <input type="number" step="0.01" name="monthly_debts" id="monthly_debts" class="w-full border rounded p-2" value="500">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Rule</label>
                        <select name="rule" id="rule" class="w-full border rounded p-2">
                            <option value="dti_36" selected>DTI ≤ 36%</option>
                            <option value="30_percent">30% of Income</option>
                            <option value="custom_percent">Custom % of Income</option>
                        </select>
                    </div>

                    <div class="mb-3" id="custom_percent_wrap" style="display:none;">
                        <label class="block text-sm font-medium mb-1">Custom Percent (%)</label>
                        <input type="number" step="0.01" name="custom_percent" id="custom_percent" class="w-full border rounded p-2" placeholder="e.g., 33">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Utilities (Monthly)</label>
                        <input type="number" step="0.01" name="utilities_monthly" id="utilities_monthly" class="w-full border rounded p-2" value="300">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Renter’s Insurance (Monthly)</label>
                        <input type="number" step="0.01" name="insurance_monthly" id="insurance_monthly" class="w-full border rounded p-2" value="0">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Target Savings (%)</label>
                        <input type="number" step="0.1" name="target_savings_percent" id="target_savings_percent" class="w-full border rounded p-2" value="10">
                    </div>

                    <div class="mb-4 flex items-center gap-2">
                        <input type="checkbox" name="show_ranges" id="show_ranges" checked>
                        <label for="show_ranges" class="text-sm">Show Conservative/Moderate/Aggressive ranges</label>
                    </div>

                    <button type="submit" class="px-4 py-2 rounded bg-black text-white">Calculate</button>
                    <span id="saving" class="text-sm ml-3" style="display:none;">Calculating…</span>
                    <div id="error" class="text-sm text-red-600 mt-2" style="display:none;"></div>
                </form>
            </div>

            <!-- Result -->
            <div class="p-4 border rounded-lg bg-white">
                <h2 class="text-xl font-semibold mb-3">Your Result</h2>
                <div id="headline" class="text-3xl font-bold mb-4">—</div>

                <div id="breakdown" class="space-y-2 text-sm">
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

                    <div class="mt-3" id="ranges_wrap" style="display:none;">
                        <strong>Ranges (by % of income after savings):</strong>
                        <div class="grid grid-cols-2 gap-2 mt-1">
                            <div>Conservative (25%): <span id="rng_cons_amt">—</span></div>
                            <div>Moderate (30%): <span id="rng_mod_amt">—</span></div>
                            <div>Aggressive (35%): <span id="rng_agg_amt">—</span></div>
                        </div>
                    </div>

                    <ul id="notes" class="list-disc pl-5 mt-3 text-gray-700"></ul>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/rent.js"></script>
</body>

</html>