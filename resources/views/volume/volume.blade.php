<x-header>Volume Converter</x-header>

<body>
    <div class="container">
        <h1>Volume Converter</h1>

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
                        <option value="ml">Milliliter (mL)</option>
                        <option value="l">Liter (L)</option>
                        <option value="m3" selected>Cubic Meter (m³)</option>
                        <option value="tsp_us">US Teaspoon</option>
                        <option value="tbsp_us">US Tablespoon</option>
                        <option value="floz_us">US Fluid Ounce</option>
                        <option value="cup_us">US Cup</option>
                        <option value="pt_us">US Pint</option>
                        <option value="qt_us">US Quart</option>
                        <option value="gal_us">US Gallon</option>
                        <option value="tsp_metric">Metric Teaspoon (5 mL)</option>
                        <option value="tbsp_metric">Metric Tablespoon (15 mL)</option>
                        <option value="cup_metric">Metric Cup (250 mL)</option>
                        <option value="floz_imp">Imp Fluid Ounce</option>
                        <option value="pt_imp">Imp Pint</option>
                        <option value="qt_imp">Imp Quart</option>
                        <option value="gal_imp">Imp Gallon</option>
                        <option value="in3">Cubic Inch (in³)</option>
                        <option value="ft3">Cubic Foot (ft³)</option>
                        <option value="yd3">Cubic Yard (yd³)</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="to">
                        <option value="ml">Milliliter (mL)</option>
                        <option value="l">Liter (L)</option>
                        <option value="m3">Cubic Meter (m³)</option>
                        <option value="tsp_us" selected>US Teaspoon</option>
                        <option value="tbsp_us">US Tablespoon</option>
                        <option value="floz_us">US Fluid Ounce</option>
                        <option value="cup_us">US Cup</option>
                        <option value="pt_us">US Pint</option>
                        <option value="qt_us">US Quart</option>
                        <option value="gal_us">US Gallon</option>
                        <option value="tsp_metric">Metric Teaspoon (5 mL)</option>
                        <option value="tbsp_metric">Metric Tablespoon (15 mL)</option>
                        <option value="cup_metric">Metric Cup (250 mL)</option>
                        <option value="floz_imp">Imp Fluid Ounce</option>
                        <option value="pt_imp">Imp Pint</option>
                        <option value="qt_imp">Imp Quart</option>
                        <option value="gal_imp">Imp Gallon</option>
                        <option value="in3">Cubic Inch (in³)</option>
                        <option value="ft3">Cubic Foot (ft³)</option>
                        <option value="yd3">Cubic Yard (yd³)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="muted">Result</div>
            <div class="result">
                <span id="result">—</span>
                <span class="unit" id="toUnit">tsp</span>
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
                <strong>Note:</strong> US vs Imperial volumes differ (e.g., US gallon 3.785 L vs Imperial gallon 4.546 L).
            </div>
        </div>
    </div>

    <script>
        const API_CONVERT = 'api/convert';
        const API_TABLE = 'api/convert/table';
    </script>
    <script src='assets/js/volume.js'></script>
</body>

</html>