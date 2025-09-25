(function () {
    // Modal open/close logic for Mortgage Calculator
    const openMortgageCalculatorBtn = document.getElementById(
        "openPopupMortgageCalculator"
    );
    const closeMortgageCalculatorBtn = document.getElementById(
        "closePopupMortgageCalculator"
    );
    const overlayMortgageCalculator = document.getElementById(
        "popupMortgageCalculator"
    );

    function openModal() {
        overlayMortgageCalculator.classList.remove("hidden"); // Show the modal
        overlayMortgageCalculator.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden"; // Disable scrolling when modal is open
    }

    // Function to close the modal
    function closeModal() {
        overlayMortgageCalculator.classList.add("hidden"); // Hide the modal
        overlayMortgageCalculator.setAttribute("aria-hidden", "true");
        document.body.style.overflow = ""; // Re-enable scrolling when modal is closed
    }

    // Event listener to open the modal when the "Open" button is clicked
    openMortgageCalculatorBtn.addEventListener("click", openModal);

    // Event listener to close the modal when the "Close" button is clicked
    closeMortgageCalculatorBtn.addEventListener("click", closeModal);

    // Close modal if clicking outside of the modal content
    overlayMortgageCalculator.addEventListener("click", (e) => {
        if (e.target === overlayMortgageCalculator) closeModal();
    });

    // Close modal with 'Escape' key
    window.addEventListener("keydown", (e) => {
        if (
            e.key === "Escape" &&
            !overlayMortgageCalculator.classList.contains("hidden")
        )
            closeModal();
    });

    // Ensure the modal is hidden on page load (this should already be the case)
    document.addEventListener("DOMContentLoaded", function () {
        overlayMortgageCalculator.classList.add("hidden"); // Ensure modal is hidden on page load
    });

    // Fetching elements for Mortgage Calculator
    const elPrice = document.getElementById("mortgage_price");
    const elDownAmount = document.getElementById("mortgage_down_amount");
    const elYears = document.getElementById("mortgage_years");
    const elAprPercent = document.getElementById("mortgage_apr_percent");
    const elAnnualPropertyTax = document.getElementById(
        "mortgage_annual_property_tax"
    );
    const elAnnualHomeInsurance = document.getElementById(
        "mortgage_annual_home_insurance"
    );
    const elPmiPercent = document.getElementById("mortgage_pmi_percent");
    const elHoaMonthly = document.getElementById("mortgage_hoa_monthly");
    const elStartDate = document.getElementById("mortgage_start_date");
    const elError = document.getElementById("mortgage_error");
    const elMonthlyTotal = document.getElementById("mortgage_monthly_total");
    const elMonthlyPI = document.getElementById("mortgage_monthly_PI");
    const elMonthlyTax = document.getElementById("mortgage_monthly_tax");
    const elMonthlyIns = document.getElementById("mortgage_monthly_ins");
    const elMonthlyPmi = document.getElementById("mortgage_monthly_pmi");
    const elMonthlyHoa = document.getElementById("mortgage_monthly_hoa");
    const elLoanAmount = document.getElementById("mortgage_loan_amount");
    const elTotalInterest = document.getElementById("mortgage_total_interest");
    const elPayoffDate = document.getElementById("mortgage_payoff_date");
    const elTableBody = document.getElementById("mortgage_tableBody");

    // Show error message
    function showError(msg) {
        elError.textContent = msg;
        elError.style.display = "block";
    }

    // Clear error message
    function clearError() {
        elError.style.display = "none";
        elError.textContent = "";
    }

    async function fetchJson(url, params) {
        const csrf = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        const res = await fetch(url, {
            method: "POST", // Ensure it's a POST request
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrf || "",
            },
            body: JSON.stringify(params), // Pass the params as the request body
        });

        if (!res.ok) {
            const data = await res.json(); // Parse the error response
            throw new Error(data.message || "HTTP " + res.status);
        }

        return res.json(); // Parse JSON response
    }

    // Update conversion result and table
    async function update() {
        clearError();

        // Validate fields before sending the request
        const price = parseFloat(elPrice.value);
        const years = parseInt(elYears.value);
        const aprPercent = parseFloat(elAprPercent.value);

        if (Number.isNaN(price)) return showError("Price is required.");
        if (Number.isNaN(years)) return showError("Years is required.");
        if (Number.isNaN(aprPercent))
            return showError("APR Percent is required.");

        const payload = {
            price: price,
            down_amount: parseFloat(elDownAmount.value),
            years: years,
            apr_percent: aprPercent,
            annual_property_tax: parseFloat(elAnnualPropertyTax.value),
            annual_home_insurance: parseFloat(elAnnualHomeInsurance.value),
            pmi_percent: elPmiPercent.value
                ? parseFloat(elPmiPercent.value)
                : null,
            hoa_monthly: elHoaMonthly.value
                ? parseFloat(elHoaMonthly.value)
                : null,
            start_date: elStartDate.value,
        };

        try {
            const data = await fetchJson("v1/finance/mortgage", payload);
            elMonthlyTotal.textContent = data.monthly_total;
            elMonthlyPI.textContent = data.monthly_PI;
            elMonthlyTax.textContent = data.monthly_tax;
            elMonthlyIns.textContent = data.monthly_ins;
            elMonthlyPmi.textContent = data.monthly_pmi;
            elMonthlyHoa.textContent = data.monthly_hoa;
            elLoanAmount.textContent = data.loan_amount;
            elTotalInterest.textContent = data.total_interest;
            elPayoffDate.textContent = data.payoff_date || "—";

            // Limit the number of rows to the number of months based on years input
            const maxRows = years * 12; // 12 months per year
            const limitedSchedule = data.schedule.slice(0, maxRows);

            elTableBody.innerHTML = limitedSchedule
                .map(
                    (r) => `
                <tr>
                    <td>${r.index}</td>
                    <td>${r.date}</td>
                    <td>${r.payment}</td>
                    <td>${r.interest}</td>
                    <td>${r.principal}</td>
                    <td>${r.balance}</td>
                    <td>${r.pmi}</td>
                    <td>${r.tax}</td>
                    <td>${r.ins}</td>
                    <td>${r.hoa}</td>
                    <td>${r.total_monthly}</td>
                </tr>
            `
                )
                .join("");
        } catch (e) {
            showError(e.message);
        }
    }

    // Debounce function for input changes
    const debounce = (fn, ms = 150) => {
        let t;
        return (...a) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...a), ms);
        };
    };

    // Add event listeners for the value changes
    ["input", "change"].forEach((evt) => {
        [
            elPrice,
            elDownAmount,
            elYears,
            elAprPercent,
            elAnnualPropertyTax,
            elAnnualHomeInsurance,
            elPmiPercent,
            elHoaMonthly,
            elStartDate,
        ].forEach((el) => {
            if (el && el.tagName === "INPUT") {
                el.addEventListener(evt, debounce(update, 150));
            }
        });
    });

    update();
})();

// (function () {
//     const q = (id) => document.getElementById(id);
//     const els = {
//         price: q("price"),
//         down_amount: q("down_amount"),
//         down_percent: q("down_percent"),
//         years: q("years"),
//         apr_percent: q("apr_percent"),
//         annual_property_tax: q("annual_property_tax"),
//         annual_home_insurance: q("annual_home_insurance"),
//         pmi_percent: q("pmi_percent"),
//         hoa_monthly: q("hoa_monthly"),
//         start_date: q("start_date"),
//         err: q("error"),
//         monthly_total: q("monthly_total"),
//         monthly_PI: q("monthly_PI"),
//         monthly_tax: q("monthly_tax"),
//         monthly_ins: q("monthly_ins"),
//         monthly_pmi: q("monthly_pmi"),
//         monthly_hoa: q("monthly_hoa"),
//         loan_amount: q("loan_amount"),
//         total_interest: q("total_interest"),
//         payoff_date: q("payoff_date"),
//         tableBody: q("tableBody"),
//     };

//     function showError(msg) {
//         els.err.textContent = msg;
//         els.err.style.display = "block";
//     }
//     function clearError() {
//         els.err.style.display = "none";
//         els.err.textContent = "";
//     }
//     const money = (n) =>
//         Number(n).toLocaleString(undefined, {
//             style: "currency",
//             currency: "USD",
//         });

//     async function calc() {
//         clearError();
//         const payload = {
//             price: +els.price.value,
//             down_amount:
//                 els.down_amount.value === "" ? null : +els.down_amount.value,
//             down_percent:
//                 els.down_percent.value === "" ? null : +els.down_percent.value,
//             years: +els.years.value,
//             apr_percent: +els.apr_percent.value,
//             annual_property_tax:
//                 els.annual_property_tax.value === ""
//                     ? null
//                     : +els.annual_property_tax.value,
//             annual_home_insurance:
//                 els.annual_home_insurance.value === ""
//                     ? null
//                     : +els.annual_home_insurance.value,
//             pmi_percent:
//                 els.pmi_percent.value === "" ? null : +els.pmi_percent.value,
//             hoa_monthly:
//                 els.hoa_monthly.value === "" ? null : +els.hoa_monthly.value,
//             start_date:
//                 els.start_date.value === "" ? null : els.start_date.value,
//         };

//         try {
//             const res = await fetch(API_MORTGAGE, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     Accept: "application/json",
//                 },
//                 body: JSON.stringify(payload),
//             });
//             if (!res.ok) throw new Error(await res.text());
//             const data = await res.json();

//             els.monthly_total.textContent = money(data.monthly_total);
//             els.monthly_PI.textContent = money(data.monthly_PI);
//             els.monthly_tax.textContent = money(data.monthly_tax);
//             els.monthly_ins.textContent = money(data.monthly_ins);
//             els.monthly_pmi.textContent = money(data.monthly_pmi);
//             els.monthly_hoa.textContent = money(data.monthly_hoa);
//             els.loan_amount.textContent = money(data.loan_amount);
//             els.total_interest.textContent = money(data.total_interest);
//             els.payoff_date.textContent = data.payoff_date || "—";

//             els.tableBody.innerHTML = data.schedule
//                 .map(
//                     (r) =>
//                         `<tr>
//           <td>${r.index}</td>
//           <td style="text-align:left">${r.date}</td>
//           <td>${money(r.payment)}</td>
//           <td>${money(r.interest)}</td>
//           <td>${money(r.principal)}</td>
//           <td>${money(r.balance)}</td>
//           <td>${money(r.pmi)}</td>
//           <td>${money(r.tax)}</td>
//           <td>${money(r.ins)}</td>
//           <td>${money(r.hoa)}</td>
//           <td>${money(r.total_monthly)}</td>
//         </tr>`
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
//             if (el && el.tagName === "INPUT")
//                 el.addEventListener(evt, deb(calc, 150));
//         });
//     });

//     calc();
// })();
