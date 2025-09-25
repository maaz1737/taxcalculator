<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mortgage Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, Arial;
            margin: 0;
            padding: 24px;
            background: #f7f7f8;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 12px;
            color: #555;
            margin-bottom: 4px;
        }

        input {
            width: 95%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        h1 {
            font-size: 22px;
            margin: 0 0 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th,
        td {
            padding: 8px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        th:first-child,
        td:first-child {
            text-align: left;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            border: 1px solid #fecaca;
            padding: 8px 10px;
            border-radius: 8px;
            display: none;
        }

        .result-number {
            font-size: 28px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mortgage Calculator</h1>

        <div id="error" class="error"></div>

        <div class="grid">
            <div class="card">
                <label>Home Price</label><input id="price" type="number" step="any" value="350000">
                <label>Down Payment (amount)</label><input id="down_amount" type="number" step="any" value="70000">
                <label>OR Down Payment (%)</label><input id="down_percent" type="number" step="any" value="">
                <label>Term (years)</label><input id="years" type="number" value="30">
                <label>APR (%)</label><input id="apr_percent" type="number" step="any" value="7">
                <label>Annual Property Tax ($/yr)</label><input id="annual_property_tax" type="number" step="any" value="4200">
                <label>Annual Home Insurance ($/yr)</label><input id="annual_home_insurance" type="number" step="any" value="1200">
                <label>PMI (% of loan / yr, optional)</label><input id="pmi_percent" type="number" step="any" value="">
                <label>HOA ($/mo, optional)</label><input id="hoa_monthly" type="number" step="any" value="">
                <label>Start Date (YYYY-MM-DD, optional)</label><input id="start_date" type="date" value="">
            </div>

            <div class="card">
                <div>Monthly Total</div>
                <div class="result-number" id="monthly_total">—</div>
                <div style="margin-top:8px;">
                    <div>P&I: <span id="monthly_PI">—</span></div>
                    <div>Tax: <span id="monthly_tax">—</span> · Ins: <span id="monthly_ins">—</span></div>
                    <div>PMI: <span id="monthly_pmi">—</span> · HOA: <span id="monthly_hoa">—</span></div>
                    <div>Loan: <span id="loan_amount">—</span> · Total Interest: <span id="total_interest">—</span></div>
                    <div>Payoff: <span id="payoff_date">—</span></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div style="font-weight:600;margin-bottom:8px;">Amortization (first 360 rows for 30y)</div>
            <div style="overflow:auto;max-height:420px;border:1px solid #eee;border-radius:8px;">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Payment</th>
                            <th>Interest</th>
                            <th>Principal</th>
                            <th>Balance</th>
                            <th>PMI</th>
                            <th>Tax</th>
                            <th>Ins</th>
                            <th>HOA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const API_MORTGAGE = 'api/v1/finance/mortgage';
    </script>
    <script src="assets/js/mortgage.js"></script>
</body>

</html>