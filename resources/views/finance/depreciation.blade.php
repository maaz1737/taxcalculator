<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Depreciation Calculator (AJAX)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, Arial;
            margin: 0;
            padding: 24px;
            background: #f7f7f8;
        }

        .container {
            max-width: 980px;
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

        input,
        select {
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

        .big {
            font-size: 28px;
            font-weight: 700;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            border: 1px solid #fecaca;
            padding: 8px 10px;
            border-radius: 8px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Depreciation Calculator</h1>

        <div id="error" class="error"></div>

        <div class="grid">
            <div class="card">
                <label>Cost</label><input id="cost" type="number" step="any" value="10000">
                <label>Salvage Value</label><input id="salvage_value" type="number" step="any" value="1000">
                <label>Life (years)</label><input id="life_years" type="number" value="5" min="1">

                <label>Method</label>
                <select id="method">
                    <option value="straight_line">Straight-Line</option>
                    <option value="double_declining" selected>Double-Declining (DDB)</option>
                    <option value="sum_of_years_digits">Sum-of-Years-Digits (SYD)</option>
                </select>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:10px;">
                    <div>
                        <label>DDB: Switch to SL when higher?</label>
                        <select id="ddb_switch_to_sl">
                            <option value="true" selected>Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                    <div>
                        <label>Rounding (decimals)</label>
                        <input id="round" type="number" min="0" max="4" value="2">
                    </div>
                </div>
            </div>

            <div class="card">
                <div>Total Depreciation</div>
                <div class="big" id="depr_sum">—</div>
                <div style="margin-top:8px;">
                    <div>End Book Value: <span id="end_book_value">—</span></div>
                    <div class="muted">Book value should equal salvage at the end (within rounding).</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div style="font-weight:600;margin-bottom:8px;">Schedule (yearly)</div>
            <div style="overflow:auto;max-height:420px;border:1px solid #eee;border-radius:8px;">
                <table>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Depreciation</th>
                            <th>Accumulated</th>
                            <th>Book Value</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const API_DEPR = 'api/v1/finance/depreciation';
    </script>
    <script src="assets/js/depreciation.js"></script>
</body>

</html>