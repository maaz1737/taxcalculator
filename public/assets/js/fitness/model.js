$(document).ready(function () {
    const $modal = $("#calcModal");
    const $backdrop = $("#calcBackdrop");
    const $panel = $("#calcPanel");
    const $titleEl = $("#calcTitle");
    const $content = $("#calcContent");
    const $closeBtn = $("#calcCloseBtn");

    // Demo form HTML (you can replace it with dynamic content later)
    const demoFormHTML = `
      <form id="demo-bmi" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium">Height (cm)</label>
            <input type="number" name="height" placeholder="175" class="mt-1 w-full rounded-lg border border-slate-200 bg-white/70 p-2.5 outline-none focus:ring-2 focus:ring-brand dark:bg-slate-900/60 dark:border-slate-700">
          </div>
          <div>
            <label class="block text-sm font-medium">Weight (kg)</label>
            <input type="number" name="weight" placeholder="70" class="mt-1 w-full rounded-lg border border-slate-200 bg-white/70 p-2.5 outline-none focus:ring-2 focus:ring-brand dark:bg-slate-900/60 dark:border-slate-700">
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="text-sm text-slate-500">Result: <span id="bmiOut" class="font-semibold text-slate-800 dark:text-slate-100">—</span></div>
          <button type="submit" class="rounded-xl px-4 py-2 border border-transparent bg-brand text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-brand">Calculate</button>
        </div>
      </form>
    `;

    // ----------------------------
    // Open Modal
    // ----------------------------
    function openModal({ title, html }) {
        $titleEl.text(title || "Calculator");
        $content.html(html || demoFormHTML);

        // Prevent body scroll while modal is open
        $("body").addClass("overflow-hidden");

        $modal.removeClass("hidden");

        requestAnimationFrame(() => {
            $backdrop.removeClass("opacity-0");
            $panel.removeClass("opacity-0 scale-95 translate-y-3");
        });

        setTimeout(() => {
            const $firstInput = $content
                .find("input, select, textarea, button")
                .first();
            if ($firstInput.length) $firstInput.trigger("focus");
        }, 320);

        $(document).on("keydown.modal", escHandler);
        $(document).on("focus.modal", trapFocus, true);

        initDemoForm();
    }

    function closeModal() {
        $backdrop.addClass("opacity-0");
        $panel.addClass("opacity-0 scale-95 translate-y-3");

        setTimeout(() => {
            $modal.addClass("hidden");
            $content.empty();
            $("body").removeClass("overflow-hidden"); // ✅ restore scroll
            $(document).off("keydown.modal");
            $(document).off("focus.modal", trapFocus, true);
        }, 300);
    }

    // ----------------------------
    // Handlers
    // ----------------------------
    function escHandler(e) {
        if (e.key === "Escape") closeModal();
    }

    function trapFocus(e) {
        if (!$modal[0].contains(e.target)) {
            e.stopPropagation();
            const $focusable = $modal.find(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            if ($focusable.length) $focusable.first().focus();
        }
    }

    // ----------------------------
    // Demo Form Logic
    // ----------------------------
    function initDemoForm() {
        const $form = $("#demo-bmi");
        const $out = $("#bmiOut");

        $form.on("submit", function (e) {
            e.preventDefault();
            const h = parseFloat($form.find("[name=height]").val()) / 100;
            const w = parseFloat($form.find("[name=weight]").val());

            if (!h || !w) {
                $out.text("Enter valid numbers");
                return;
            }

            const bmi = (w / (h * h)).toFixed(1);
            $out.text(bmi);
        });
    }

    // ----------------------------
    // Event bindings
    // ----------------------------
    $(document).on("click", "[data-open-form]", function (e) {
        e.preventDefault();
        const $trigger = $(this);
        const title = $trigger.data("title") || "Calculator";

        openModal({
            title,
            html: demoFormHTML, // replace with AJAX-loaded content if needed
        });
    });

    $closeBtn.on("click", closeModal);
    $backdrop.on("click", closeModal);
});
