(function () {
    // CSRF

    // Elements
    const modal = document.getElementById("calcModal");
    const backdrop = document.getElementById("calcBackdrop");
    const panel = document.getElementById("calcPanel");
    const titleEl = document.getElementById("calcTitle");
    const contentEl = document.getElementById("calcContent");
    const closeBtn = document.getElementById("calcCloseBtn");
    const openBtn = document.getElementById("openFitnessBtn");
    const tpl = document.getElementById("fitnessTpl");

    // API endpoints
    const API = {
        bmi: "/v1/fitness/bmi",
        bmr: "/v1/fitness/bmr",
        tdee: "/v1/fitness/tdee",
        bodyfat: "/v1/fitness/body-fat",
        ideal: "/v1/fitness/ideal",
        macros: "/v1/fitness/macros",
        save: "/v1/fitness/save",
        recent: "/v1/fitness/recent",
    };

    // Helpers
    const debounce = (fn, wait = 3000) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), wait);
        };
    };
    const isOk = (res) =>
        !!(
            res &&
            (res.ok === true ||
                res.success === true ||
                res.status === "success" ||
                res.data !== undefined)
        );

    function setSaveEnabled($root, on) {
        $root.find("#saveBtn").prop("disabled", !on);
    }

    function show($root, headline, lines = []) {
        $root.find("#headline").text(headline || "—");
        $root
            .find("#breakdown")
            .html(lines.map((l) => `<div>• ${l}</div>`).join(""));
    }

    function clearErrors($root) {
        $root.find(".err").remove();
        $root.find(".input, .select, input, select").removeClass("input-error");
    }

    function renderErrors($root, $form, errors = {}) {
        clearErrors($root);
        Object.entries(errors).forEach(([name, msgs]) => {
            const $f = $form.find(`[name="${name}"]`);
            if ($f.length) {
                $f.addClass("input-error").after(
                    `<div class="err" style="color:#b91c1c;font-size:12px;margin-top:4px;">${msgs[0]}</div>`
                );
            }
        });
    }

    // Generic binder
    function bind($form, url, render, $root) {
        if (!$form.length) return;
        const run = debounce(() => {
            clearErrors($root);
            const data = Object.fromEntries(new FormData($form[0]).entries());
            // $form.find("input, select, button").prop("disabled", true);

            $.post(url, data)
                .done((res) => {
                    if (!isOk(res)) {
                        show($root, "—", ["No result returned."]);
                        setSaveEnabled($root, false);
                        return;
                    }
                    window.currentCalcPayload = {
                        calc_type: url.split("/").pop(),
                        inputs: res.inputs || data,
                        outputs: res.data,
                    };
                    setSaveEnabled($root, true);
                    render(res.data, res.inputs || data);
                })
                .fail((xhr) => {
                    let payload = {};
                    try {
                        payload =
                            xhr.responseJSON ||
                            JSON.parse(xhr.responseText || "{}");
                    } catch (e) {}
                    if (xhr.status === 422 && payload.errors) {
                        renderErrors($root, $form, payload.errors);
                        show($root, "—", ["Fix the highlighted fields."]);
                    } else {
                        show($root, "—", [
                            payload.message || "Something went wrong.",
                        ]);
                    }
                    setSaveEnabled($root, false);
                })
                .always(() => {
                    $form.find("input, select, button").prop("disabled", false);
                });
        }, 500);

        $form.on("input change", run);
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    });
    function loadRecent($root, type = "") {
        const $list = $root.find("#recentList");
        if (!$list.length) return;
        const params = new URLSearchParams({
            limit: 10,
        });
        if (type) params.set("type", type);

        $.getJSON(`${API.recent}?${params.toString()}`)
            .done((res) => {
                $list.empty();
                if (!isOk(res) || !res.data?.length) {
                    $list.append(
                        '<li class="muted">No recent calculations.</li>'
                    );
                    return;
                }
                res.data.forEach((it) => {
                    const dt = new Date(it.created_at).toLocaleString();
                    const head = (it.calc_type || "").toUpperCase();
                    const prev = $("<div/>")
                        .text(JSON.stringify(it.outputs || {}))
                        .html();
                    const vari = (function (o) {
                        o = o || {};
                        switch (it.calc_type) {
                            case "bmi":
                                return o.bmi ?? "";
                            case "bmr":
                                return (o.bmr ?? "") + " kcal/day";
                            case "tdee":
                                return (o.tdee ?? "") + " kcal/day";
                            case "body-fat":
                                return (o.body_fat_pct ?? "") + "%";
                            case "ideal":
                                return (o.ideal_weight_kg ?? "") + " kg";
                            case "macros":
                                return (o.calories ?? "") + " kcal";
                            default:
                                return "";
                        }
                    })(it.outputs);

                    const $li = $(`
            <li>
              <div class="row between" style="gap:10px;">
                <span style="font-weight:600">${head}</span>
                <span class="muted" style="font-size:12px;">${dt}</span>
              </div>
              <div class="truncate" title="${prev}">${vari}</div>
            </li>
          `);
                    $li.on("click", () => {
                        const paneId =
                            {
                                bmi: "#tab-bmi",
                                bmr: "#tab-bmr",
                                tdee: "#tab-tdee",
                                "body-fat": "#tab-bodyfat",
                                ideal: "#tab-ideal",
                                macros: "#tab-macros",
                            }[it.calc_type] || "#tab-bmi";

                        activateTabById($root, paneId);

                        const $form = $root.find(`${paneId} form`);
                        Object.entries(it.inputs || {}).forEach(([k, v]) => {
                            const $field = $form.find(`[name="${k}"]`);
                            if ($field.is("select")) $field.val(v);
                            else $field.val(v);
                        });
                        $form.find("input,select").first().trigger("input");
                    });
                    $list.append($li);
                });
            })
            .fail(() => {
                $list
                    .empty()
                    .append('<li class="muted">Failed to load recent.</li>');
            });
    }

    function activateTabById($root, id) {
        $root.find(".tab").removeClass("active");
        $root.find(`.tab[data-tab="${id}"]`).addClass("active");
        [
            "#tab-bmi",
            "#tab-bmr",
            "#tab-tdee",
            "#tab-bodyfat",
            "#tab-ideal",
            "#tab-macros",
        ].forEach((pid) => $root.find(pid).addClass("hidden"));
        $root.find(id).removeClass("hidden");
        show($root, "—", []);
        setSaveEnabled($root, false);
        const $form = $root.find(`${id} form`);
        if ($form.length) {
            $form.find("input,select").first().trigger("input");
        }
    }

    // Mount everything inside modal
    function mountFitnessCalculator(rootSelector) {
        const $root = $(rootSelector);

        // Tabs (delegated)
        $root.on("click", ".tab", function () {
            activateTabById($root, $(this).data("tab"));
        });

        // Bind each form
        bind(
            $root.find("#form-bmi"),
            API.bmi,
            (d, i) => {
                show($root, `${d.bmi}`, [
                    `Category: ${d.category}`,
                    `Unit: ${i.unit}`,
                ]);
            },
            $root
        );
        bind(
            $root.find("#form-bmr"),
            API.bmr,
            (d, i) => {
                show($root, `${d.bmr} kcal/day`, [
                    `Sex: ${i.sex}`,
                    `Wt: ${i.weight_kg}kg`,
                    `Ht: ${i.height_cm}cm`,
                    `Age: ${i.age}`,
                ]);
                $root
                    .find('#form-tdee [name="bmr"]')
                    .val(d.bmr)
                    .trigger("input");
            },
            $root
        );
        bind(
            $root.find("#form-tdee"),
            API.tdee,
            (d, i) => {
                show($root, `${d.tdee} kcal/day`, [`Activity: ${i.activity}`]);
            },
            $root
        );
        bind(
            $root.find("#form-bodyfat"),
            API.bodyfat,
            (d, i) => {
                show($root, `${d.body_fat_pct}%`, [`Method: US Navy`]);
            },
            $root
        );
        bind(
            $root.find("#form-ideal"),
            API.ideal,
            (d, i) => {
                show($root, `${d.ideal_weight_kg} kg`, [`Devine formula`]);
            },
            $root
        );
        bind(
            $root.find("#form-macros"),
            API.macros,
            (d, i) => {
                show($root, `${i.calories} kcal`, [
                    `Carbs: ${d.carbs_g} g`,
                    `Protein: ${d.protein_g} g`,
                    `Fat: ${d.fat_g} g`,
                ]);
            },
            $root
        );

        // Macros % logic
        (function () {
            const $f = $root.find("#form-macros");
            if (!$f.length) return;
            const $c = $f.find('[name="carb_pct"]'),
                $p = $f.find('[name="protein_pct"]'),
                $ft = $f.find('[name="fat_pct"]');
            let lock = false;
            const clamp = (n) =>
                Math.max(0, Math.min(100, Math.round(parseFloat(n || 0))));

            function rebalance() {
                if (lock) return;
                lock = true;
                const c = clamp($c.val()),
                    p = clamp($p.val());
                const f = clamp(100 - c - p);
                $c.val(c);
                $p.val(p);
                $ft.val(f).trigger("input");
                lock = false;
            }

            function guardFat() {
                if (lock) return;
                lock = true;
                const c = clamp($c.val()),
                    p = clamp($p.val());
                const maxF = clamp(100 - c - p);
                let f = clamp($ft.val());
                if (f > maxF) {
                    $ft.val(maxF).trigger("input");
                }
                lock = false;
            }
            $c.on("input", rebalance);
            $p.on("input", rebalance);
            $ft.on("input", guardFat);
        })();

        // Save
        $root.find("#saveBtn").on("click", function () {
            const p = window.currentCalcPayload;
            if (!p) return;
            if (p.calc_type === "bodyfat") p.calc_type = "body-fat";
            $.post(API.save, p)
                .done((res) => {
                    $root
                        .find("#saveMsg")
                        .text(res.message || "Saved")
                        .removeClass("hidden");
                    setTimeout(
                        () => $root.find("#saveMsg").addClass("hidden"),
                        1500
                    );
                    const typeSel = $root.find("#recentType");
                    if (typeSel.length) loadRecent($root, typeSel.val());
                })
                .fail(() => {
                    $root.find("#saveMsg").text("Failed").removeClass("hidden");
                    setTimeout(
                        () => $root.find("#saveMsg").addClass("hidden"),
                        2500
                    );
                });
        });

        // Recent
        const $recentType = $root.find("#recentType");
        if ($recentType.length) {
            $recentType.on("change", function () {
                loadRecent($root, this.value);
            });
            loadRecent($root);
        }

        // Default: only BMI visible, others hidden; trigger first compute
        [
            "#tab-bmr",
            "#tab-tdee",
            "#tab-bodyfat",
            "#tab-ideal",
            "#tab-macros",
        ].forEach((id) => $root.find(id).addClass("hidden"));
        setSaveEnabled($root, false);
        $root
            .find("#tab-bmi form")
            .find("input,select")
            .first()
            .trigger("input");
    }

    // Modal open/close
    function openModalWithTemplate() {
        if (!tpl) return;
        titleEl.textContent = "Fitness Calculator";
        contentEl.innerHTML = "";
        contentEl.appendChild(tpl.content.cloneNode(true));
        modal.classList.remove("hidden");
        requestAnimationFrame(() => {
            backdrop.classList.remove("opacity-0");
            panel.classList.remove("opacity-0", "scale-95", "translate-y-3");
        });
        mountFitnessCalculator("#calcContent");
        setTimeout(() => {
            const first = contentEl.querySelector(
                "input,select,textarea,button"
            );
            if (first)
                first.focus({
                    preventScroll: true,
                });
        }, 320);
        document.addEventListener("keydown", escHandler);
        document.addEventListener("focus", trapFocus, true);
    }

    function closeModal() {
        backdrop.classList.add("opacity-0");
        panel.classList.add("opacity-0", "scale-95", "translate-y-3");
        setTimeout(() => {
            modal.classList.add("hidden");
            contentEl.innerHTML = "";
            document.removeEventListener("keydown", escHandler);
            document.removeEventListener("focus", trapFocus, true);
        }, 300);
    }

    function escHandler(e) {
        if (e.key === "Escape") closeModal();
    }

    function trapFocus(e) {
        if (!modal.contains(e.target)) {
            e.stopPropagation();
            const f = modal.querySelectorAll(
                'button,[href],input,select,textarea,[tabindex]:not([tabindex="-1"])'
            );
            if (f.length) f[0].focus();
        }
    }

    // Wire
    if (openBtn) openBtn.addEventListener("click", openModalWithTemplate);
    if (closeBtn) closeBtn.addEventListener("click", closeModal);
    if (backdrop) backdrop.addEventListener("click", closeModal);
})();
