(function () {
    const $ = (id) => document.getElementById(id);
    const els = {
        err: $("errorDepreciation"),
        cost: $("costDepreciation"),
        salvage: $("salvageValueDepreciation"),
        life: $("lifeYearsDepreciation"),
        method: $("methodDepreciation"),
        ddbSwitch: $("ddbSwitchToSlDepreciation"),
        round: $("roundDepreciation"),
        depr_sum: $("deprSumDepreciation"),
        end_book_value: $("endBookValueDepreciation"),
        tableBody: $("tableBodyDepreciation"),
    };

    const money = (n) =>
        Number(n).toLocaleString(undefined, {
            style: "currency",
            currency: "USD",
        });

    function showError(msg) {
        els.err.textContent = msg || "Something went wrong.";
        els.err.style.display = "block";
    }

    function clearError() {
        els.err.style.display = "none";
        els.err.textContent = "";
    }

    // Modal open/close logic
    const openModal = () => {
        const overlayDepreciationCalculator = document.getElementById(
            "popupDepreciationCalculator"
        );
        overlayDepreciationCalculator.classList.remove("hidden");
        overlayDepreciationCalculator.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    };

    const closeModal = () => {
        const overlayDepreciationCalculator = document.getElementById(
            "popupDepreciationCalculator"
        );
        overlayDepreciationCalculator.classList.add("hidden");
        overlayDepreciationCalculator.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };

    // Open the modal when the button is clicked
    document
        .getElementById("openPopupDepreciationCalculator")
        .addEventListener("click", openModal);

    // Close the modal when the close button is clicked
    document
        .getElementById("closePopupDepreciationCalculator")
        .addEventListener("click", closeModal);

    // Close modal with 'Escape' key
    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeModal();
        }
    });

    async function calc() {
        clearError();

        const payload = {
            cost: +els.cost.value,
            salvage_value: els.salvage.value === "" ? 0 : +els.salvage.value,
            life_years: +els.life.value,
            method: els.method.value,
            ddb_switch_to_sl: els.ddbSwitch.value === "true",
            round: +els.round.value,
        };

        try {
            const res = await fetch("v1/finance/depreciation", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(payload),
            });
            if (!res.ok) throw new Error(await res.text());
            const data = await res.json();

            els.depr_sum.textContent = money(data.totals.depr_sum);
            els.end_book_value.textContent = money(data.totals.end_book_value);

            els.tableBody.innerHTML = (data.schedule || [])
                .map(
                    (r) => `
                        <tr>
                            <td style="text-align:left">${r.year}</td>
                            <td>${money(r.depreciation)}</td>
                            <td>${money(r.accumulated)}</td>
                            <td>${money(r.book_value)}</td>
                            <td style="text-align:left">${r.note ?? ""}</td>
                        </tr>
                    `
                )
                .join("");
        } catch (e) {
            showError(e.message);
        }
    }

    const deb = (fn, ms = 200) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    // Add event listeners for the input fields
    ["input", "change"].forEach((evt) => {
        Object.values(els).forEach((el) => {
            if (el && (el.tagName === "INPUT" || el.tagName === "SELECT"))
                el.addEventListener(evt, deb(calc, 150));
        });
    });

    calc();
})();

// (function () {
//     const $ = (id) => document.getElementById(id);
//     const els = {
//         err: $("error"),
//         cost: $("cost"),
//         salvage: $("salvage_value"),
//         life: $("life_years"),
//         method: $("method"),
//         ddbSwitch: $("ddb_switch_to_sl"),
//         round: $("round"),
//         depr_sum: $("depr_sum"),
//         end_book_value: $("end_book_value"),
//         tableBody: $("tableBody"),
//     };
//     const money = (n) =>
//         Number(n).toLocaleString(undefined, {
//             style: "currency",
//             currency: "USD",
//         });
//     function showError(msg) {
//         els.err.textContent = msg || "Something went wrong.";
//         els.err.style.display = "block";
//     }
//     function clearError() {
//         els.err.style.display = "none";
//         els.err.textContent = "";
//     }

//     async function calc() {
//         clearError();
//         const payload = {
//             cost: +els.cost.value,
//             salvage_value: els.salvage.value === "" ? 0 : +els.salvage.value,
//             life_years: +els.life.value,
//             method: els.method.value,
//             ddb_switch_to_sl: els.ddbSwitch.value === "true",
//             round: +els.round.value,
//         };

//         try {
//             const res = await fetch(API_DEPR, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     Accept: "application/json",
//                 },
//                 body: JSON.stringify(payload),
//             });
//             if (!res.ok) throw new Error(await res.text());
//             const data = await res.json();

//             els.depr_sum.textContent = money(data.totals.depr_sum);
//             els.end_book_value.textContent = money(data.totals.end_book_value);

//             els.tableBody.innerHTML = (data.schedule || [])
//                 .map(
//                     (r) => `
//         <tr>
//           <td style="text-align:left">${r.year}</td>
//           <td>${money(r.depreciation)}</td>
//           <td>${money(r.accumulated)}</td>
//           <td>${money(r.book_value)}</td>
//           <td style="text-align:left">${r.note ?? ""}</td>
//         </tr>
//       `
//                 )
//                 .join("");
//         } catch (e) {
//             showError(e.message);
//         }
//     }

//     const deb = (fn, ms = 200) => {
//         let t;
//         return (...a) => {
//             clearTimeout(t);
//             t = setTimeout(() => fn(...a), ms);
//         };
//     };
//     ["input", "change"].forEach((evt) => {
//         Object.values(els).forEach((el) => {
//             if (el && (el.tagName === "INPUT" || el.tagName === "SELECT"))
//                 el.addEventListener(evt, deb(calc, 150));
//         });
//     });

//     calc();
// })();
