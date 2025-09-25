<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Area Converter (AJAX)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, Arial;
            margin: 0;
            padding: 24px;
            background: #f7f7f8;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 12px;
        }

        label {
            display: block;
            font-size: 12px;
            color: #555;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
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
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
            border-top: 1px solid #eee;
            text-align: left;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .result {
            font-size: 28px;
            font-weight: 700;
        }

        .unit {
            font-size: 14px;
            color: #6b7280;
            margin-left: 6px;
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
        <h1>Area Converter</h1>

        <div id="error" class="error"></div>

        <div class="card">
            <div class="row">
                <div style="grid-column: span 2">
                    <label>Value</label>
                    <input id="value" type="number" step="any" value="1">
                </div>
                <div>
                    <label>From</label>
                    <select id="from">
                        <option value="mm2">Square Millimeter (mm²)</option>
                        <option value="cm2">Square Centimeter (cm²)</option>
                        <option value="m2" selected>Square Meter (m²)</option>
                        <option value="km2">Square Kilometer (km²)</option>
                        <option value="in2">Square Inch (in²)</option>
                        <option value="ft2">Square Foot (ft²)</option>
                        <option value="yd2">Square Yard (yd²)</option>
                        <option value="mi2">Square Mile (mi²)</option>
                        <option value="acre">Acre</option>
                        <option value="hectare">Hectare</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="to">
                        <option value="mm2">Square Millimeter (mm²)</option>
                        <option value="cm2">Square Centimeter (cm²)</option>
                        <option value="m2">Square Meter (m²)</option>
                        <option value="km2">Square Kilometer (km²)</option>
                        <option value="in2" selected>Square Inch (in²)</option>
                        <option value="ft2">Square Foot (ft²)</option>
                        <option value="yd2">Square Yard (yd²)</option>
                        <option value="mi2">Square Mile (mi²)</option>
                        <option value="acre">Acre</option>
                        <option value="hectare">Hectare</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="muted">Result</div>
            <div class="result">
                <span id="result">—</span>
                <span class="unit" id="toUnit">in²</span>
            </div>
        </div>

        <div class="card">
            <div style="font-weight:600; margin-bottom:8px;">Quick Conversion Table</div>
            <div class="muted" style="margin-bottom:8px;">Based on current input.</div>
            <div style="overflow-x:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="muted">
                <strong>History (short):</strong> The square meter (m²) is the SI derived unit for area.
                Land area commonly uses hectares (10,000 m²) and acres (~4,046.86 m²).
            </div>
        </div>
    </div>

    <!-- Absolute API URLs (works with XAMPP subfolders) -->
    <script>
        const API_CONVERT = 'api/convert';
        const API_TABLE = 'api/convert/table';
    </script>

    <script src="assets/js/area.js"></script>

</body>

</html>