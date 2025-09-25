(() => {
    const modal = document.getElementById("calcModal");
    const backdrop = document.getElementById("calcBackdrop");
    const panel = document.getElementById("calcPanel");
    const titleEl = document.getElementById("calcTitle");
    const content = document.getElementById("calcContent");
    const closeBtn = document.getElementById("calcCloseBtn");

    // Hard-coded demo form (replace this with your own form later)
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
    <script>
      (function(){
        const f = document.getElementById('demo-bmi');
        const out = document.getElementById('bmiOut');
        f.addEventListener('submit', function(e){
          e.preventDefault();
          const h = parseFloat(f.height.value)/100;
          const w = parseFloat(f.weight.value);
          if(!h || !w){ out.textContent = 'Enter valid numbers'; return; }
          const bmi = (w/(h*h)).toFixed(1);
          out.textContent = bmi;
        });
      })();
    <\/script>
  `;

    function openModal({ title, html }) {
        titleEl.textContent = title || "Calculator";
        content.innerHTML = html || demoFormHTML;

        modal.classList.remove("hidden");
        // animate in
        requestAnimationFrame(() => {
            backdrop.classList.remove("opacity-0");
            panel.classList.remove("opacity-0", "scale-95", "translate-y-3");
        });

        // focus the first input after animation
        setTimeout(() => {
            const firstInput = content.querySelector(
                "input, select, textarea, button"
            );
            if (firstInput)
                firstInput.focus({
                    preventScroll: true,
                });
        }, 320);

        // ESC to close
        document.addEventListener("keydown", escHandler);
        // basic focus trap
        document.addEventListener("focus", trapFocus, true);
    }

    function closeModal() {
        // animate out
        backdrop.classList.add("opacity-0");
        panel.classList.add("opacity-0", "scale-95", "translate-y-3");
        setTimeout(() => {
            modal.classList.add("hidden");
            content.innerHTML = "";
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
            const focusable = modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            if (focusable.length) focusable[0].focus();
        }
    }

    // open on any card click
    document.addEventListener("click", (e) => {
        const trigger = e.target.closest("[data-open-form]");
        if (!trigger) return;
        e.preventDefault();
        const title = trigger.getAttribute("data-title") || "Calculator";
        // If you want to fetch the real form by URL later, use fetch() here.
        openModal({
            title,
            html: demoFormHTML,
        });
    });

    // close handlers
    closeBtn.addEventListener("click", closeModal);
    backdrop.addEventListener("click", closeModal);
})();
