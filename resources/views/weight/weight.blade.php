<x-header>Weight Converter</x-header>

<body>
    <div class="container">
        <h1>Weight Converter (AJAX / Blade + Modal)</h1>

        <!-- Error -->
        <div id="weight_error" class="error" style="color:red; display:none;"></div>

        <!-- Converter Inputs -->
        <div class="card">
            <div class="row">
                <div style="grid-column: span 2">
                    <label>Value</label>
                    <input id="weight_value" type="number" step="any" value="1">
                </div>
                <div>
                    <label>From</label>
                    <select id="weight_from">
                        <option value="ug">Microgram (µg)</option>
                        <option value="mg">Milligram (mg)</option>
                        <option value="g">Gram (g)</option>
                        <option value="kg" selected>Kilogram (kg)</option>
                        <option value="t">Metric Tonne (t)</option>
                        <option value="ct">Carat (ct)</option>
                        <option value="oz">Ounce (oz)</option>
                        <option value="lb">Pound (lb)</option>
                        <option value="st">Stone (st)</option>
                        <option value="ton_us">US Ton (short)</option>
                        <option value="ton_uk">UK Ton (long)</option>
                        <option value="gr">Grain (gr)</option>
                        <option value="dr">Dram (avdp)</option>
                    </select>
                </div>
                <div>
                    <label>To</label>
                    <select id="weight_to">
                        <option value="ug">Microgram (µg)</option>
                        <option value="mg">Milligram (mg)</option>
                        <option value="g">Gram (g)</option>
                        <option value="kg">Kilogram (kg)</option>
                        <option value="t">Metric Tonne (t)</option>
                        <option value="ct" selected>Carat (ct)</option>
                        <option value="oz">Ounce (oz)</option>
                        <option value="lb">Pound (lb)</option>
                        <option value="st">Stone (st)</option>
                        <option value="ton_us">US Ton (short)</option>
                        <option value="ton_uk">UK Ton (long)</option>
                        <option value="gr">Grain (gr)</option>
                        <option value="dr">Dram (avdp)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Button to Show Modal -->
        <div class="card" style="margin-top:15px;">
            <button id="weight_btnShow" style="padding:10px 20px; font-weight:bold;">Show Conversion Result</button>
        </div>

        <!-- Modal -->
        <div id="weight_modal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
            <div class="modal-content" style="background:#fff; padding:20px; max-width:400px; margin:100px auto; border-radius:8px; position:relative;">
                <span id="weight_close" style="position:absolute; top:10px; right:15px; cursor:pointer; font-weight:bold;">&times;</span>
                <h3>Conversion Result</h3>
                <div>
                    <strong id="weight_modalResult">0</strong> 
                    <span id="weight_modalUnit"></span>
                </div>
            </div>
        </div>

        <!-- Result Display -->
        <div class="card" style="margin-top:10px;">
            <div class="muted">Quick Conversion Table</div>
            <div style="overflow-x:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody id="weight_tableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS API -->
    <script>
        const API_CONVERT = '{{ url("api/convert") }}';
        const API_TABLE   = '{{ url("api/convert/table") }}';
    </script>
    <script >(function () {
  const elValue    = document.getElementById('weight_value');
  const elFrom     = document.getElementById('weight_from');
  const elTo       = document.getElementById('weight_to');
  const elTable    = document.getElementById('weight_tableBody');
  const elError    = document.getElementById('weight_error');

  // Modal elements
  const elBtn      = document.getElementById('weight_btnShow');
  const elModal    = document.getElementById('weight_modal');
  const elClose    = document.getElementById('weight_close');
  const elModalRes = document.getElementById('weight_modalResult');
  const elModalUnit= document.getElementById('weight_modalUnit');

  function showError(msg){ elError.textContent = msg || 'Something went wrong.'; elError.style.display='block'; }
  function clearError(){ elError.style.display='none'; elError.textContent=''; }

  async function fetchJson(url, params){
    const qs = new URLSearchParams(params).toString();
    const res = await fetch(url + '?' + qs, { headers: { 'Accept':'application/json' } });
    if (!res.ok) throw new Error(await res.text() || ('HTTP ' + res.status));
    return res.json();
  }

  async function updateConversion(){
    clearError();
    const value = parseFloat(elValue.value);
    if (Number.isNaN(value)) return showError('Please enter a numeric value.');
    const from = elFrom.value, to = elTo.value;

    try {
      // Conversion API
      const conv = await fetchJson(API_CONVERT, { category:'weight', from, to, value });

      // Table API
      const tbl  = await fetchJson(API_TABLE, { category:'weight', from, value });
      elTable.innerHTML = tbl.rows.map(r => `<tr><td>${r.unit}</td><td>${r.value}</td></tr>`).join('');

      return conv.result; // Return value for modal
    } catch (e) { showError(e.message); return null; }
  }

  // Debounce helper
  const debounce = (fn, ms=150) => { let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a), ms); }; };

  // Event listeners
  ['input','change'].forEach(evt=>{
    elValue.addEventListener(evt, debounce(updateConversion,150));
    elFrom.addEventListener(evt, updateConversion);
    elTo.addEventListener(evt, updateConversion);
  });

  // Show modal on button click
  elBtn.addEventListener('click', async ()=>{
    const result = await updateConversion();
    if(result!==null){
      elModalRes.textContent = result;
      elModalUnit.textContent = elTo.value;
      elModal.style.display = 'block';
    }
  });

  // Close modal
  elClose.addEventListener('click', ()=> elModal.style.display='none');
  window.addEventListener('click', e=>{ if(e.target===elModal) elModal.style.display='none'; });

  // Initial table update
  updateConversion();
})();
</script>
</body>
</html>
