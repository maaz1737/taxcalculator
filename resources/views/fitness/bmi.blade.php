<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Fitness Calculator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Minimal styles (no Tailwind required) -->
    <style>
        :root {
            --border: #e5e7eb;
            --muted: #6b7280;
            --fg: #111827;
            --bg: #ffffff;
            --blue: #2563eb;
            --green: #059669;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            color: var(--fg);
            background: var(--bg);
        }

        .wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 16px;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        @media (min-width: 900px) {
            .cols-3 {
                grid-template-columns: 2fr 1fr;
            }
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
            background: #fff;
        }

        .row {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .between {
            justify-content: space-between;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            background: var(--blue);
            color: #fff;
            cursor: pointer;
        }

        .btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .muted {
            color: var(--muted);
        }

        .headline {
            font-size: 32px;
            font-weight: 800;
            margin: 8px 0;
        }

        .hidden {
            display: none;
        }

        .input,
        .select {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border);
            border-radius: 6px;
        }

        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .tab {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .tab.active {
            background: #eef2ff;
            border-color: #c7d2fe;
        }

        .list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 8px;
        }

        .list li {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
        }

        .list li:hover {
            background: #f9fafb;
        }

        .g-2 {
            display: grid;
            gap: 8px;
            grid-template-columns: 1fr 1fr;
        }

        .g-3 {
            display: grid;
            gap: 8px;
            grid-template-columns: 1fr 1fr 1fr;
        }

        label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .success {
            color: var(--green);
            font-size: 14px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="wrap">
        <h1 style="font-size:28px; font-weight:800; margin:0 0 12px;">Fitness Calculator</h1>

        <div class="grid cols-3">
            <!-- LEFT: calculators -->
            <div class="grid" style="gap:16px">
                <!-- tabs -->
                <div class="tabs" id="tabs">
                    <button class="tab active" data-tab="#tab-bmi">BMI</button>
                    <button class="tab" data-tab="#tab-bmr">BMR</button>
                    <button class="tab" data-tab="#tab-tdee">TDEE</button>
                    <button class="tab" data-tab="#tab-bodyfat">Body Fat</button>
                    <button class="tab" data-tab="#tab-ideal">Ideal Weight</button>
                    <button class="tab" data-tab="#tab-macros">Macros</button>
                </div>

                <!-- result card -->
                <div class="card">
                    <div class="muted" style="font-size:12px; text-transform:uppercase;">Result</div>
                    <div id="headline" class="headline">—</div>
                    <div id="breakdown" style="font-size:14px;"></div>
                    <div class="row" style="margin-top:8px; gap:12px;">
                        <button id="saveBtn" class="btn">Save</button>
                        <span id="saveMsg" class="success hidden">Saved</span>
                    </div>
                </div>

                <!-- tab contents -->
                <div id="tab-bmi" class="card">
                    <form id="form-bmi" class="grid" style="gap:8px">
                        <div>
                            <label>Unit</label>
                            <select name="unit" class="select">
                                <option value="metric">Metric (kg, m)</option>
                                <option value="imperial">Imperial (lb, in)</option>
                            </select>
                        </div>
                        <div class="g-2">
                            <div>
                                <label>Weight</label>
                                <input name="weight" type="number" step="0.1" class="input" />
                            </div>
                            <div>
                                <label>Height</label>
                                <input name="height" type="number" step="0.01" class="input" />
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-bmr" class="card hidden">
                    <form id="form-bmr" class="grid" style="gap:8px">
                        <div class="g-2">
                            <div>
                                <label>Sex</label>
                                <select name="sex" class="select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label>Age</label>
                                <input name="age" type="number" class="input" />
                            </div>
                        </div>
                        <div class="g-2">
                            <div>
                                <label>Weight (kg)</label>
                                <input name="weight_kg" type="number" step="0.1" class="input" />
                            </div>
                            <div>
                                <label>Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="input" />
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-tdee" class="card hidden">
                    <form id="form-tdee" class="grid" style="gap:8px">
                        <div class="g-2">
                            <div>
                                <label>BMR</label>
                                <input name="bmr" type="number" class="input" />
                            </div>
                            <div>
                                <label>Activity</label>
                                <select name="activity" class="select">
                                    <option value="sedentary">Sedentary</option>
                                    <option value="light">Light</option>
                                    <option value="moderate">Moderate</option>
                                    <option value="active">Active</option>
                                    <option value="very">Very Active</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-bodyfat" class="card hidden">
                    <form id="form-bodyfat" class="grid" style="gap:8px">
                        <div class="g-2">
                            <div>
                                <label>Sex</label>
                                <select name="sex" class="select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label>Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="input" />
                            </div>
                        </div>
                        <div class="g-3">
                            <div>
                                <label>Waist (cm)</label>
                                <input name="waist_cm" type="number" step="0.1" class="input" />
                            </div>
                            <div>
                                <label>Neck (cm)</label>
                                <input name="neck_cm" type="number" step="0.1" class="input" />
                            </div>
                            <div>
                                <label>Hip (cm) <span class="muted">(for female)</span></label>
                                <input name="hip_cm" type="number" step="0.1" class="input" />
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-ideal" class="card hidden">
                    <form id="form-ideal" class="grid" style="gap:8px">
                        <div class="g-2">
                            <div>
                                <label>Sex</label>
                                <select name="sex" class="select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label>Height (cm)</label>
                                <input name="height_cm" type="number" step="0.1" class="input" />
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tab-macros" class="card hidden">
                    <form id="form-macros" class="grid" style="gap:8px">
                        <div>
                            <label>Calories</label>
                            <input name="calories" type="number" class="input" />
                        </div>
                        <div class="g-3">
                            <div>
                                <label>Carbs %</label>
                                <input name="carb_pct" type="number" value="50" class="input" />
                            </div>
                            <div>
                                <label>Protein %</label>
                                <input name="protein_pct" type="number" value="20" class="input" />
                            </div>
                            <div>
                                <label>Fat %</label>
                                <input name="fat_pct" type="number" value="30" class="input" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT: recent -->
            <aside class="card">
                <div class="row between" style="margin-bottom:8px;">
                    <h3 style="margin:0;">Recent</h3>
                    <select id="recentType" class="select" style="max-width:160px;">
                        <option value="">All</option>
                        <option value="bmi">BMI</option>
                        <option value="bmr">BMR</option>
                        <option value="tdee">TDEE</option>
                        <option value="body-fat">Body Fat</option>
                        <option value="ideal">Ideal</option>
                        <option value="macros">Macros</option>
                    </select>
                </div>
                <ul id="recentList" class="list"></ul>
            </aside>
        </div>
    </div>

    <script>
        // ------------------------------
        // jQuery CSRF for Laravel (POST/PUT/DELETE)
        // ------------------------------
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        // ------------------------------
        // Small helpers
        // ------------------------------
        const API = {
            bmi: '/api/v1/fitness/bmi',
            bmr: '/api/v1/fitness/bmr',
            tdee: '/api/v1/fitness/tdee',
            bodyfat: '/api/v1/fitness/body-fat',
            ideal: '/api/v1/fitness/ideal',
            macros: '/api/v1/fitness/macros',
            save: '/api/v1/fitness/save',
            recent: '/api/v1/fitness/recent',
        };

        function debounce(fn, wait = 600) {
            let t;
            return (...a) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...a), wait);
            };
        }

        function setSaveEnabled(on) {
            $('#saveBtn').prop('disabled', !on);
        }

        function clearErrors($form) {
            $form.find('.err').remove();
            $form.find('.input, .select').removeClass('input-error');
        }

        function renderErrors($form, errors = {}) {

            clearErrors($form);
            Object.entries(errors).forEach(([name, msgs]) => {
                // Field name may be 'hip_cm' etc. Try exact match
                const $field = $form.find(`[name="${name}"]`);
                if ($field.length) {
                    $field.addClass('input-error')
                        .after(`<div class="err" style="color:#b91c1c;font-size:12px;margin-top:4px;">${msgs[0]}</div>`);
                }
            });
        }

        const show = (headline, lines = []) => {
            $('#headline').text(headline || '—');
            $('#breakdown').html((lines || []).map(l => `<div>• ${l}</div>`).join(''));
        };

        function tabIdFor(type) {
            switch (type) {
                case 'bmi':
                    return '#tab-bmi';
                case 'bmr':
                    return '#tab-bmr';
                case 'tdee':
                    return '#tab-tdee';
                case 'body-fat':
                    return '#tab-bodyfat';
                case 'ideal':
                    return '#tab-ideal';
                case 'macros':
                    return '#tab-macros';
                default:
                    return '#tab-bmi';
            }
        }

        function activateTabById(id) {
            // buttons
            $('.tab').removeClass('active');
            $(`.tab[data-tab="${id}"]`).addClass('active');

            // panes
            ['#tab-bmi', '#tab-bmr', '#tab-tdee', '#tab-bodyfat', '#tab-ideal', '#tab-macros']
            .forEach(pid => $(pid).addClass('hidden'));
            $(id).removeClass('hidden');

            // reset result
            show('—', []);
            setSaveEnabled(false);
        }

        // ------------------------------
        // Tab click (no reload)
        // ------------------------------
        $(document).on('click', '.tab', function() {
            activateTabById($(this).data('tab'));
        });

        // ------------------------------
        // Generic AJAX binder for forms
        // ------------------------------
        const bind = (formId, url, render) => {
            const $f = $(formId);
            const run = debounce(() => {
                clearErrors($f);
                const data = Object.fromEntries(new FormData($f[0]).entries());

                // Visual: disable form during request
                $f.find('input, select, button').prop('disabled', true);

                $.post(url, data)
                    .done(res => {
                        if (!res || !res.ok) return;

                        // enable Save
                        window.currentCalcPayload = {
                            calc_type: url.split('/').pop(), // e.g. 'bmi','bmr','tdee','body-fat','ideal','macros'
                            inputs: res.inputs || data,
                            outputs: res.data
                        };
                        setSaveEnabled(true);

                        // Custom render for that calculator
                        render(res.data, res.inputs || data);
                    })
                    .fail(xhr => {
                        // 422 validation
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            renderErrors($f, xhr.responseJSON.errors);
                            show('—', ['Fix the highlighted fields.']);
                            setSaveEnabled(false);
                        } else {
                            show('—', ['Something went wrong. Please try again.']);
                            setSaveEnabled(false);
                        }
                    })
                    .always(() => {
                        $f.find('input, select, button').prop('disabled', false);
                    });
            }, 600);

            // Bind inputs
            $f.on('input change', run);
        };

        // ------------------------------
        // Calculator-specific renderers
        // ------------------------------
        bind('#form-bmi', API.bmi, (d, i) => {
            show(`${d.bmi}`, [`Category: ${d.category}`, `Unit: ${i.unit}`]);
        });

        bind('#form-bmr', API.bmr, (d, i) => {
            show(`${d.bmr} kcal/day`, [
                `Sex: ${i.sex}`,
                `Wt: ${i.weight_kg}kg`,
                `Ht: ${i.height_cm}cm`,
                `Age: ${i.age}`
            ]);
            // convenience: push BMR into TDEE form
            $('#form-tdee [name="bmr"]').val(d.bmr).trigger('input');
        });

        bind('#form-tdee', API.tdee, (d, i) => {
            show(`${d.tdee} kcal/day`, [`Activity: ${i.activity}`]);
        });

        bind('#form-bodyfat', API.bodyfat, (d, i) => {
            show(`${d.body_fat_pct}%`, [`Method: US Navy`]);
        });

        bind('#form-ideal', API.ideal, (d, i) => {
            show(`${d.ideal_weight_kg} kg`, [`Devine formula`]);
        });

        bind('#form-macros', API.macros, (d, i) => {

            console.log('macros', d, i);
            show(`${i.calories} kcal`, [
                `Carbs: ${d.carbs_g} g`,
                `Protein: ${d.protein_g} g`,
                `Fat: ${d.fat_g} g`
            ]);
        });

        (function() {
            const $form = $('#form-macros');
            const $c = $form.find('[name="carb_pct"]');
            const $p = $form.find('[name="protein_pct"]');
            const $f = $form.find('[name="fat_pct"]');
            let lock = false;
            const clamp = n => Math.max(0, Math.min(100, Math.round(parseFloat(n || 0))));

            function rebalance() {
                if (lock) return;
                lock = true;
                const c = clamp($c.val()),
                    p = clamp($p.val());
                const f = clamp(100 - c - p);
                $c.val(c);
                $p.val(p);
                $f.val(f).trigger('input'); // kicks your AJAX
                lock = false;
            }

            function guardFat() {
                if (lock) return;
                lock = true;
                const c = clamp($c.val()),
                    p = clamp($p.val());
                const maxF = clamp(100 - c - p);
                let f = clamp($f.val());
                if (f > maxF) {
                    $f.val(maxF).trigger('input');
                }
                lock = false;
            }

            $c.on('input', rebalance);
            $p.on('input', rebalance);
            $f.on('input', guardFat);
        })();

        // ------------------------------
        // Save snapshot (AJAX)
        // ------------------------------
        $('#saveBtn').on('click', function() {
            const p = window.currentCalcPayload;
            if (!p) return;

            const validTypes = ['bmi', 'bmr', 'tdee', 'body-fat', 'ideal', 'macros'];
            if (!validTypes.includes(p.calc_type)) {
                if (p.calc_type === 'bodyfat') p.calc_type = 'body-fat';
            }

            $.ajax({
                    url: '/api/v1/fitness/save',
                    method: 'POST',
                    data: p,
                    dataType: 'json'
                })
                .done(res => {
                    $('#saveMsg').text(res.message || 'Saved').removeClass('hidden');
                    setTimeout(() => $('#saveMsg').addClass('hidden'), 1500);
                    loadRecent($('#recentType').val());
                })
                .fail(xhr => {
                    console.error('SAVE FAILED', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        response: xhr.responseText
                    });
                    let msg = 'Failed';
                    try {
                        const j = xhr.responseJSON || JSON.parse(xhr.responseText || '{}');
                        if (j.message) msg = j.message;
                        if (j.errors) msg += ' • ' + Object.values(j.errors).flat().join(' ');
                    } catch (e) {}
                    $('#saveMsg').text(msg).removeClass('hidden');
                    setTimeout(() => $('#saveMsg').addClass('hidden'), 2500);
                });
        });


        // ------------------------------
        // Recent (AJAX list + prefill on click)
        // ------------------------------
        function loadRecent(type = '') {
            const params = new URLSearchParams({
                limit: 10
            });
            if (type) params.set('type', type);

            $.getJSON(`${API.recent}?${params.toString()}`, function(res) {
                const $list = $('#recentList').empty();
                if (!res || !res.ok || !res.data.length) {
                    $list.append('<li class="muted">No recent calculations.</li>');
                    return;
                }
                res.data.forEach(it => {
                    const dt = new Date(it.created_at).toLocaleString();
                    const title = (it.calc_type || '').toUpperCase();
                    const prev = $('<div/>').text(JSON.stringify(it.outputs)).html(); // escape
                    const vari = renderRecentItem(it);

                    const $li = $(`
          <li>
            <div class="row between" style="gap:8px;">
              <span style="font-weight:600">${title}</span>
              <span class="muted" style="font-size:12px;">${dt}</span>
            </div>
            <div class="truncate" title="${prev}">${vari}</div>
          </li>
        `);
                    // Prefill when clicked
                    $li.on('click', () => {
                        const paneId = tabIdFor(it.calc_type);
                        activateTabById(paneId);

                        const $form = $(`${paneId} form`);
                        // Fill inputs generically
                        Object.entries(it.inputs || {}).forEach(([k, v]) => {
                            const $field = $form.find(`[name="${k}"]`);
                            if ($field.is('select')) $field.val(v);
                            else $field.val(v);
                        });
                        // Trigger an input event to recompute
                        $form.find('input, select').first().trigger('input');
                    });
                    $list.append($li);
                });
            }).fail(() => {
                const $list = $('#recentList').empty();
                $list.append('<li class="muted">Failed to load recent.</li>');
            });
        }

        $('#recentType').on('change', function() {
            loadRecent(this.value);
        });

        // ------------------------------
        // Init
        // ------------------------------
        $(function() {
            // default tab visible; ensure others hidden (in case SSR classes changed)
            ['#tab-bmr', '#tab-tdee', '#tab-bodyfat', '#tab-ideal', '#tab-macros'].forEach(id => $(id).addClass('hidden'));
            setSaveEnabled(false);
            loadRecent();
        });


        function renderRecentItem(it) {
            const type = it.outputs || {};
            switch (it.calc_type) {
                case 'bmi':
                    return type.bmi ?? '';
                case 'bmr':
                    return (type.bmr ?? '') + ' kcal/day';
                case 'tdee':
                    return (type.tdee ?? '') + ' kcal/day';
                case 'body-fat':
                    return (type.body_fat_pct ?? '') + '%';
                case 'ideal':
                    return (type.ideal_weight_kg ?? '') + ' kg';
                case 'macros':
                    return (type.calories ?? '') + ' kcal';
                default:
                    return '';
            }
        }
    </script>

</body>

</html>