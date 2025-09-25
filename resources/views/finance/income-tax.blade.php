<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AU Tax Calculator</title>

    <!-- Tailwind (browser build) + jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-gray-50 text-gray-900">

    <main class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Australia – Income Tax (2024–25)</h1>

        <!-- CARD: Form -->
        <form id="taxCalcForm" class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
            <div class="mb-4">
                <label for="annualIncome" class="block text-sm font-medium text-gray-700">Annual taxable income (AUD)</label>
                <input
                    id="annualIncome"
                    name="income"
                    type="number"
                    min="0"
                    step="1"
                    placeholder="e.g. 45000"
                    class="mt-1 change w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300"
                    required />
                <p class="mt-1 text-xs text-gray-500">Enter income after deductions.</p>
            </div>

            <div class="mb-4">
                <label for="levyPercent" class="block text-sm font-medium text-gray-700">Medicare levy</label>
                <select
                    id="levyPercent"
                    name="levy"
                    class="mt-1 change w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    <option value="" selected>No levy</option>
                    <option value="1.5">1.5%</option>
                    <option value="2">2%</option>
                    <option value="3">3%</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Standard Medicare levy is 2% (residents).</p>
            </div>

            <div class="mb-4">
                <label for="taxpaid" class="block text-sm font-medium text-gray-700">Tax Paid</label>
                <input
                    id="taxpaid"
                    name="taxpaid"
                    type="number"
                    min="0"
                    step="1"
                    placeholder="e.g. 45000"
                    class="mt-1 change w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-300"
                    required />
                <p class="mt-1 text-xs text-gray-500">paid tax.</p>
            </div>

            <div class="flex items-center gap-3">
                <button id="btnCalculate" class="rounded-lg bg-gray-900 text-white px-4 py-2 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    Calculate
                </button>
                <button id="btnClear" type="button" class="rounded-lg bg-gray-100 text-gray-900 px-4 py-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-slate-300">
                    Clear
                </button>
            </div>

            <p id="errorMessage" class="mt-3 hidden text-sm text-red-700 bg-red-100 border border-red-200 rounded-md px-3 py-2"></p>
        </form>

        <!-- CARD: Results -->
        <section class="mt-6 bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
            <h2 class="text-lg font-semibold mb-2">Result</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Income tax</div>
                    <div id="outIncomeTax" class="font-semibold">—</div>
                </div>
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Medicare levy</div>
                    <div id="outLevy" class="font-semibold">—</div>
                </div>
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Total payable</div>
                    <div id="outTotal" class="font-semibold">—</div>
                </div>
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Remaining (take-home)</div>
                    <div id="outRemaining" class="font-semibold">—</div>
                </div>
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Tax paid</div>
                    <div id="paidtax" class="font-semibold">—</div>
                </div>
                <div class="rounded-lg border border-slate-200 p-3">
                    <div class="text-gray-500">Remaining Tax</div>
                    <div id="remainingTax" class="font-semibold">—</div>
                </div>
            </div>

            <p class="mt-3 text-xs text-gray-500">
                Brackets used (resident 2024–25): 0–18,200: 0%; 18,201–45,000: 16% over 18,200; 45,001–135,000: 4,288 + 30% over 45,000;
                135,001–190,000: 31,288 + 37% over 135,000; 190,001+: 51,638 + 45% over 190,000.
            </p>
        </section>
    </main>

    <script>
        // ---------- Elements (meaningful names) ----------
        const incomeInputEl = $('#annualIncome');
        const levySelectEl = $('#levyPercent');
        const btnCalculateEl = $('#btnCalculate');
        const btnClearEl = $('#btnClear');
        const errorMessageEl = $('#errorMessage');

        const outputIncomeTaxEl = $('#outIncomeTax');
        const outputLevyEl = $('#outLevy');
        const outputTotalEl = $('#outTotal');
        const outputRemainingEl = $('#outRemaining');
        const taxpaid = $('#taxpaid');
        const remainingTax = $('#remainingTax');
        const paidtax = $('#paidtax');












        // ---------- Helpers ----------
        const aud = new Intl.NumberFormat('en-AU', {
            style: 'currency',
            currency: 'AUD',
            maximumFractionDigits: 0
        });

        function showError(msg) {
            errorMessageEl.text(msg).removeClass('hidden');
        }

        function clearError() {
            errorMessageEl.addClass('hidden').text('');
        }

        function setOutputs({
            incomeTax = 0,
            levy = 0,
            total = 0,
            remaining = 0,
            paid = 0,
            remain = 0
        } = {}) {
            console.log(remain)
            outputIncomeTaxEl.text(incomeTax ? aud.format(incomeTax) : '—');
            outputLevyEl.text(levy ? aud.format(levy) : '—');
            outputTotalEl.text(total ? aud.format(total) : '—');
            outputRemainingEl.text(remaining ? aud.format(remaining) : '—');
            remainingTax.html(remain ?  aud.format(remain) : '—');
            paidtax.html(paid ? aud.format(paid) : '—');
        }

        // ---------- Core tax logic (Resident 2024–25) ----------
        function calculateIncomeTaxResident(income) {
            let tax = 0;

            if (income <= 18200) {
                tax = 0;
            } else if (income <= 45000) {
                tax = (income - 18200) * 0.16;
            } else if (income <= 135000) {
                tax = 4288 + (income - 45000) * 0.30;
            } else if (income <= 190000) {
                tax = 31288 + (income - 135000) * 0.37;
            } else {
                tax = 51638 + (income - 190000) * 0.45;
            }

            return tax;
        }

        function calculateMedicareLevy(income, levyPercent) {
            if (!levyPercent) return 0;
            return income * (levyPercent / 100);
        }

        // ---------- Events ----------
        $('.change').on('input', function(e) {
            e.preventDefault();
            clearError();

            const rawIncome = Number(incomeInputEl.val());
            const levyPercent = Number(levySelectEl.val());

            if (!Number.isFinite(rawIncome) || rawIncome < 0) {
                showError('Please enter a valid non-negative income amount.');
                setOutputs({});
                return;
            }

            const incomeTax = calculateIncomeTaxResident(rawIncome);
            const levy = Number.isFinite(levyPercent) ? calculateMedicareLevy(rawIncome, levyPercent) : 0;
            const total = incomeTax + levy;
            const remaining = rawIncome - total;
            const paid = taxpaid.val();
            const remain = total - paid;


            setOutputs({
                incomeTax,
                levy,
                total,
                remaining,
                paid,
                remain
            });
        });

        btnClearEl.on('click', function() {
            incomeInputEl.val('');
            levySelectEl.val('2'); // default to 2%
            clearError();
            setOutputs({});
            incomeInputEl.trigger('focus');
        });

        // Optional: sensible defaults for quick demo
        levySelectEl.val('2');
        setOutputs({});


        $(document).ready(function() {
            btnCalculateEl.on('click', function(e) {
                e.preventDefault();

                // one-time setup: send CSRF + accept JSON
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'Application/Json'
                    }
                });
                const payload = {
                    income: incomeInputEl.val(),
                    levy: levySelectEl.val(),
                    taxpaid: taxpaid.val()
                    // income: Number($('#annualIncome').val()), levy: Number($('#levyPercent').val()) // if needed
                };

                $.ajax({
                    url: '/v1/finance/income-tax',
                    method: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify(payload),
                    dataType: 'json',
                    success: function(res) {
                        alert('this is hello');
                        console.log('Response:', res.data);

                        remainingTax.html(res.data.taxLevy - res.data.taxpaid);
                        paidtax.html(res.data.taxpaid);
                    },
                    error: function(xhr) {
                        console.error('Status:', xhr.status);
                        console.error('Body:', xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>