(function () {
    // CSRF for AJAX
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    });

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

    // Utilities
    const debounce = (fn, wait = 500) => {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), wait);
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

    const showResult = ($root, headline, breakdown = []) => {
        $root.find("#headline").text(headline || "—");
        $root
            .find("#breakdown")
            .html(breakdown.map((l) => `<div>• ${l}</div>`).join(""));
    };

    const clearErrors = ($root) => {
        $root.find(".err").remove();
        $root.find(".input, .select, input, select").removeClass("input-error");
    };

    const renderErrors = ($root, $form, errors = {}) => {
        clearErrors($root);
        Object.entries(errors).forEach(([name, msgs]) => {
            const $field = $form.find(`[name="${name}"]`);
            if ($field.length) {
                $field
                    .addClass("input-error")
                    .after(
                        `<div class="err" style="color:#b91c1c;font-size:12px;margin-top:4px;">${msgs[0]}</div>`
                    );
            }
        });
    };

    const setSaveEnabled = ($root, on) => {
        $root.find("#saveBtn").prop("disabled", !on);
    };

    // Generic form binder
    function bindCalculator($form, url, render, $root) {
        if (!$form.length) return;

        const run = debounce(() => {
            clearErrors($root);
            const data = Object.fromEntries(new FormData($form[0]).entries());


            $.post(url, data)
                .done((res) => {
                    if (!isOk(res)) {
                        showResult($root, "—", ["No result returned."]);
                        setSaveEnabled($root, false);
                        return;
                    }

                    window.currentCalcPayload = {
                        calc_type: url.split("/").pop(),
                        inputs: res.inputs || data,
                        outputs: res.data,
                    };
                    console.log(window.currentCalcPayload);
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
                        showResult($root, "—", ["Fix the highlighted fields."]);
                    } else {
                        showResult($root, "—", [
                            payload.message || "Something went wrong.",
                        ]);
                    }
                    setSaveEnabled($root, false);
                });
        }, 500);

        $form.on("input change", run);
    }

    // Load recent calculations
    const loadRecent = ($root, type = "") => {
        const $list = $root.find("#recentList");
        if (!$list.length) return;

        const params = new URLSearchParams({ limit: 10 });
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
                          <div class="truncate" title="${JSON.stringify(
                              it.outputs || {}
                          )}">${vari}</div>
                        </li>
                    `);

                    $li.on("click", () => {
                        const $form = $root.find(`#form-${it.calc_type}`);
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
            .fail(() =>
                $list
                    .empty()
                    .append('<li class="muted">Failed to load recent.</li>')
            );
    };

    // Mount all calculators
    function mountCalculators(rootSelector) {
        const $root = $(rootSelector);

        bindCalculator(
            $root.find("#form-bmi"),
            API.bmi,
            (d, i) => {
                showResult($root, `${d.bmi}`, [
                    `Category: ${d.category}`,
                    `Unit: ${i.unit}`,
                ]);
            },
            $root
        );

        bindCalculator(
            $root.find("#form-bmr"),
            API.bmr,
            (d, i) => {
                showResult($root, `${d.bmr} kcal/day`, [
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

        bindCalculator(
            $root.find("#form-tdee"),
            API.tdee,
            (d, i) => {
                showResult($root, `${d.tdee} kcal/day`, [
                    `Activity: ${i.activity}`,
                ]);
            },
            $root
        );

        bindCalculator(
            $root.find("#form-bodyfat"),
            API.bodyfat,
            (d, i) => {
                showResult($root, `${d.body_fat_pct}%`, ["Method: US Navy"]);
            },
            $root
        );

        bindCalculator(
            $root.find("#form-ideal"),
            API.ideal,
            (d, i) => {
                showResult($root, `${d.ideal_weight_kg} kg`, [
                    "Devine formula",
                ]);
            },
            $root
        );

        bindCalculator(
            $root.find("#form-macros"),
            API.macros,
            (d, i) => {
                showResult($root, `${i.calories} kcal`, [
                    `Carbs: ${d.carbs_g} g`,
                    `Protein: ${d.protein_g} g`,
                    `Fat: ${d.fat_g} g`,
                ]);
            },
            $root
        );

        // Save button
        $root.find("#saveBtn").on("click", () => {
            const payload = window.currentCalcPayload;
            if (!payload) return;
            if (payload.calc_type === "bodyfat") payload.calc_type = "body-fat";

            $.post(API.save, payload)
                .done((res) => {
                    $root
                        .find("#saveMsg")
                        .text(res.message || "Saved")
                        .removeClass("hidden");
                    console.log(payload);

                    setTimeout(
                        () => $root.find("#saveMsg").addClass("hidden"),
                        1500
                    );
                    loadRecent($root, payload.calc_type);
                })
                .fail(() => {
                    $root.find("#saveMsg").text("Failed").removeClass("hidden");
                    setTimeout(
                        () => $root.find("#saveMsg").addClass("hidden"),
                        1500
                    );
                });
        });

        // Load recent
        const $recentType = $root.find("#recentType");
        if ($recentType.length) {
            $recentType.on("change", function () {
                loadRecent($root, this.value);
            });
            loadRecent($root);
        }
    }

    // Initialize
    $(document).ready(() => {
        mountCalculators("#calculatorRoot");
    });
})();
