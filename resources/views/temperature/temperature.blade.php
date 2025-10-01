<x-header>Temperature Converter</x-header>

<body>
    <div class="container">
        <h1>Temperature Converter</h1>

        <div id="error" class="error"></div>

        <div class="card">
            <div class="row">
                <div style="grid-column: span 2">
                    <label>Value</label>
                    <input id="value" type="number" step="any" value="0" class="search">
                </div>
                <div>
                    <label>From</label>
                    <select id="from">
                        <option value="C" selected>Celsius (°C)</option>
                        <option value="K">Kelvin (K)</option>
                        <option value="F">Fahrenheit (°F)</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="to">
                        <option value="C">Celsius (°C)</option>
                        <option value="K">Kelvin (K)</option>
                        <option value="F" selected>Fahrenheit (°F)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="muted">Result</div>
            <div class="result">
                <span id="result">—</span>
                <span class="unit" id="toUnit">°F</span>
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
                <strong>Formulas:</strong> K = °C + 273.15; °F = (°C × 9/5) + 32.
            </div>
        </div>
    </div>
</body>

</html>