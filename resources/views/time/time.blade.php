<x-header>Time Converter</x-header>

<body>
    <div class="container">
        <h1>Time Converter</h1>

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
                        <option value="ns">Nanosecond (ns)</option>
                        <option value="us">Microsecond (µs)</option>
                        <option value="ms">Millisecond (ms)</option>
                        <option value="s" selected>Second (s)</option>
                        <option value="min">Minute (min)</option>
                        <option value="h">Hour (h)</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="mo">Month (avg)</option>
                        <option value="yr">Year (avg)</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="to">
                        <option value="ns">Nanosecond (ns)</option>
                        <option value="us">Microsecond (µs)</option>
                        <option value="ms">Millisecond (ms)</option>
                        <option value="s">Second (s)</option>
                        <option value="min" selected>Minute (min)</option>
                        <option value="h">Hour (h)</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="mo">Month (avg)</option>
                        <option value="yr">Year (avg)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="muted">Result</div>
            <div class="result">
                <span id="result">—</span>
                <span class="unit" id="toUnit">min</span>
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
                <strong>Note:</strong> “mo” and “yr” use average Gregorian lengths (not calendar-specific).
            </div>
        </div>
    </div>

    <x-footer></x-footer>