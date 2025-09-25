<x-header>Length Converter</x-header>

<body>
    <div class="container">
        <h1>Length Converter</h1>

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
                        <option value="mm">Millimeter (mm)</option>
                        <option value="cm">Centimeter (cm)</option>
                        <option value="m" selected>Meter (m)</option>
                        <option value="km">Kilometer (km)</option>
                        <option value="in">Inch (in)</option>
                        <option value="ft">Foot (ft)</option>
                        <option value="yd">Yard (yd)</option>
                        <option value="mi">Mile (mi)</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="to">
                        <option value="mm">Millimeter (mm)</option>
                        <option value="cm">Centimeter (cm)</option>
                        <option value="m">Meter (m)</option>
                        <option value="km">Kilometer (km)</option>
                        <option value="in" selected>Inch (in)</option>
                        <option value="ft">Foot (ft)</option>
                        <option value="yd">Yard (yd)</option>
                        <option value="mi">Mile (mi)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="muted">Result</div>
            <div class="result">
                <span id="result">—</span>
                <span class="unit" id="toUnit">in</span>
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
                <strong>History (short):</strong> The meter is the SI base unit of length,
                defined by the distance light travels in vacuum in 1/299,792,458 of a second.
                <a href="#" style="text-decoration:underline;">Read full history →</a>
            </div>
        </div>
    </div>
    <script>
        const API_CONVERT = 'api/convert';
        const API_TABLE = 'api/convert/table';
    </script>
    <script src="assets/js/length.js"></script>
</body>

</html>