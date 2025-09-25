<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Salary Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto max-w-4xl px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Salary (Gross ↔ Net) Calculator</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 border rounded bg-white">
                <form id="salary-form">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Mode</label>
                        <select id="mode" class="w-full border rounded p-2">
                            <option value="gross_to_net" selected>Gross → Net</option>
                            <option value="net_to_gross">Net → Gross</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Pay Frequency</label>
                        <select id="pay_frequency" class="w-full border rounded p-2">
                            <option value="hourly">Hourly</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Bi-Weekly</option>
                            <option value="semimonthly">Semi-Monthly</option>
                            <option value="monthly" selected>Monthly</option>
                            <option value="annual">Annual</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Amount</label>
                        <input type="number" step="0.01" id="amount" class="w-full border rounded p-2" value="6000" required>
                        <p class="text-xs text-gray-500 mt-1">Gross if Gross→Net; Target Net if Net→Gross.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Hours / Week</label>
                            <input type="number" step="0.1" id="hours_per_week" class="w-full border rounded p-2" value="40">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Weeks / Year</label>
                            <input type="number" step="0.1" id="weeks_per_year" class="w-full border rounded p-2" value="52">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Country</label>
                            <input type="text" id="country_code" class="w-full border rounded p-2" value="US">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Region</label>
                            <input type="text" id="region_code" class="w-full border rounded p-2" placeholder="CA / ON / PK-ISB">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tax Year</label>
                            <input type="number" id="tax_year" class="w-full border rounded p-2" value="2024">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Pre-tax Deductions</label>
                            <input type="number" step="0.01" id="pretax_deductions" class="w-full border rounded p-2" value="300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Post-tax Deductions</label>
                            <input type="number" step="0.01" id="posttax_deductions" class="w-full border rounded p-2" value="50">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Employee Insurance</label>
                            <input type="number" step="0.01" id="employee_insurance" class="w-full border rounded p-2" value="120">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Bonuses (annual)</label>
                            <input type="number" step="0.01" id="bonuses" class="w-full border rounded p-2" value="0">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Other Allowances (annual)</label>
                            <input type="number" step="0.01" id="other_allowances" class="w-full border rounded p-2" value="0">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="px-4 py-2 rounded bg-black text-white" type="submit">Calculate</button>
                        <span id="saving" class="text-sm ml-3 hidden">Calculating…</span>
                        <div id="error" class="text-sm text-red-600 mt-2 hidden"></div>
                    </div>
                </form>
            </div>

            <div class="p-4 border rounded bg-white">
                <h2 class="text-xl font-semibold mb-3">Result</h2>
                <div class="text-sm space-y-2">
                    <div><strong>Headline:</strong> <span id="headline">—</span></div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div>Hourly: <span id="p_hourly">—</span></div>
                        <div>Weekly: <span id="p_weekly">—</span></div>
                        <div>Bi-Weekly: <span id="p_biweekly">—</span></div>
                        <div>Semi-Monthly: <span id="p_semimonthly">—</span></div>
                        <div>Monthly: <span id="p_monthly">—</span></div>
                        <div>Annual: <span id="p_annual">—</span></div>
                    </div>

                    <div class="mt-3">
                        <h3 class="font-semibold">Taxes</h3>
                        <div>Total: <span id="tax_total">—</span></div>
                    </div>

                    <div class="mt-3">
                        <h3 class="font-semibold">Deductions</h3>
                        <div>Pre-tax: <span id="d_pre">—</span></div>
                        <div>Post-tax: <span id="d_post">—</span></div>
                        <div>Insurance: <span id="d_ins">—</span></div>
                        <div>Total: <span id="d_total">—</span></div>
                    </div>

                    <div class="mt-3">
                        <div>Gross: <span id="gross">—</span></div>
                        <div>Net: <span id="net">—</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/salary.js"></script>
</body>

</html>