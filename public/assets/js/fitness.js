

// (function ($) {
//     const API = "/api/v1/fitness/bmi";
//     const $form = $("#bmi-form");
//     const $saving = $("#saving");
//     const $error = $("#error");

//     const show = ($el, on = true) => $el.toggleClass("hidden", !on);
//     const fnum = new Intl.NumberFormat("en-US", { maximumFractionDigits: 2 });

//     function payload() {
//         return {
//             units: $("#units").val(),
//             height: parseFloat($("#height").val() || "0"),
//             weight: parseFloat($("#weight").val() || "0"),
//         };
//     }

//     function render(res) {
//         $("#bmi").text(fnum.format(res.bmi || 0));
//         $("#category").text(res.category || "—");
//         $("#w_min").text(
//             fnum.format(res.healthy_weight_range?.min || 0) + " kg"
//         );
//         $("#w_max").text(
//             fnum.format(res.healthy_weight_range?.max || 0) + " kg"
//         );

//         const $n = $("#notes").empty();
//         (res.notes || []).forEach((n) => $n.append(`<li>${n}</li>`));
//     }

//     function call(p) {
//         show($saving, true);
//         show($error, false);
//         return $.ajax({
//             url: API,
//             method: "POST",
//             data: JSON.stringify(p),
//             contentType: "application/json",
//             dataType: "json",
//         }).always(() => show($saving, false));
//     }

//     $form.on("submit", function (e) {
//         e.preventDefault();
//         console.log("this");

//         call(payload())
//             .done(render)
//             .fail((xhr) => {
//                 let msg = "Request failed";
//                 if (xhr.responseJSON?.message || xhr.responseJSON?.error) {
//                     msg = xhr.responseJSON.message || xhr.responseJSON.error;
//                 }
//                 $error.text(msg);
//                 show($error, true);
//             });
//     });

//     // auto-run once
//     $form.trigger("submit");
// })(jQuery);
