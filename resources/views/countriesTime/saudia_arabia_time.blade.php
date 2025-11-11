<x-app
    :title="'Saudi Arabia Time Now – Current Time in Saudi Arabia (Riyadh) | Live Saudi Time Zone Converter'"
    :titleTwitter="'Saudi Arabia Time Now – Live Riyadh Time'"
    :des="'Check the current time in Saudi Arabia (Riyadh) with our live online clock. View Saudi local time, compare your time zone with Riyadh, see KSA daylight saving rules, and convert your local time instantly.'"
    :key="'Saudi Arabia time now, Riyadh time now, KSA time, Saudi timezone, current time in Riyadh, time in Saudi Arabia, Saudi time converter, live Saudi clock, KSA time difference, world clock Saudi, Asia/Riyadh time, Gulf time now'" />

<div class="bg-emerald-50 text-black dark:bg-slate-900 text-white">
    <div class="w-full min-h-[70vh] py-10 flex flex-col lg:flex-row items-center justify-center gap-16 text-center">

        <!-- Saudi Arabia Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4">Saudi Arabia 🇸🇦 (Riyadh)</h3>
            <div class="dial" id="sa-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="sa-day" class="font-bold"></p>
                <p id="sa-date"></p>
                <p id="sa-time" class="text-xl font-semibold"></p>
            </div>
        </div>

        <div class="text-black text-5xl dark:text-white"> = </div>

        <!-- Local Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 id="local-title" class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4"></h3>
            <div class="dial" id="sa-local-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="sa-local-day" class="font-bold"></p>
                <p id="sa-local-date"></p>
                <p id="sa-local-time" class="text-xl font-semibold"></p>
            </div>
        </div>

    </div>

    <!-- ✅ SEO TEXT SECTION FOR SAUDI ARABIA -->
    <div class="w-full max-w-3xl mx-auto mt-12 p-6 bg-yellow-100/30 rounded-xl shadow border border-yellow-300 dark:text-gray-100 dark:bg-slate-600/50 dark:border-slate-700/40">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 dark:text-gray-100">About Saudi Arabia Current Time (Riyadh Time)</h2>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Saudi Arabia uses Arabia Standard Time (AST), which is UTC +03:00.
            The country does not observe daylight saving time, so <strong>Saudi Arabia time now</strong> remains constant throughout the year. This tool gives you the <strong>current time in Saudi Arabia (Riyadh)</strong> with live accuracy.
        </p>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Saudi time is important for business meetings, travel planning, Gulf trading hours, airline schedules, and live prayer times. Use this converter to compare <strong>Saudi Arabia time vs your local time</strong> easily.
        </p>

        <p class="text-gray-800 leading-relaxed dark:text-gray-200">
            This live clock provides real-time updates, including current day, date, and full 24-hour or 12-hour format for Riyadh time.
        </p>
    </div>
</div>

<x-appfooter />

<script>
    const localTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("local-title").textContent = `Your Local Time (${localTZ})`;

    const clocks = [{
            dialId: "sa-local-dial",
            tz: localTZ,
            prefix: "sa-local"
        },
        {
            dialId: "sa-dial",
            tz: "Asia/Riyadh",
            prefix: "sa"
        }
    ];

    const clockObjects = {};

    function createClockElements(dialEl) {
        const size = dialEl.clientWidth;
        const center = size / 2;
        const radius = center - 28;

        for (let i = 1; i <= 12; i++) {
            const angle = (i * 30 - 90) * Math.PI / 180;
            const x = center + Math.cos(angle) * radius;
            const y = center + Math.sin(angle) * radius;

            const num = document.createElement("div");
            num.className = "num";
            num.style.left = `${x - 16}px`;
            num.style.top = `${y - 16}px`;
            num.textContent = i;
            dialEl.appendChild(num);
        }

        const hour = document.createElement("div");
        hour.className = "hand hour";

        const minute = document.createElement("div");
        minute.className = "hand minute";

        const second = document.createElement("div");
        second.className = "hand second";

        const dot = document.createElement("div");
        dot.className = "center-dot";

        dialEl.appendChild(hour);
        dialEl.appendChild(minute);
        dialEl.appendChild(second);
        dialEl.appendChild(dot);

        return {
            hour,
            minute,
            second
        };
    }

    function getDateInTimeZone(tz) {
        let now = new Date();
        let formatter = new Intl.DateTimeFormat("en-US", {
            timeZone: tz,
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false
        });

        let parts = formatter.formatToParts(now);
        let map = {};
        parts.forEach(p => map[p.type] = p.value);

        return new Date(`${map.year}-${map.month}-${map.day}T${map.hour}:${map.minute}:${map.second}`);
    }

    clocks.forEach(c => {
        const dial = document.getElementById(c.dialId);
        const els = createClockElements(dial);
        clockObjects[c.prefix] = {
            ...c,
            dial,
            ...els
        };
    });

    function update() {
        Object.values(clockObjects).forEach(clk => {
            const local = getDateInTimeZone(clk.tz);

            const h = local.getHours();
            const m = local.getMinutes();
            const s = local.getSeconds();

            clk.hour.style.transform = `translate(-50%, -100%) rotate(${(h % 12) * 30 + m * 0.5}deg)`;
            clk.minute.style.transform = `translate(-50%, -100%) rotate(${m * 6 + s * 0.1}deg)`;
            clk.second.style.transform = `translate(-50%, -100%) rotate(${s * 6}deg)`;

            document.getElementById(`${clk.prefix}-time`).textContent = local.toLocaleTimeString();
            document.getElementById(`${clk.prefix}-date`).textContent = local.toLocaleDateString();
            document.getElementById(`${clk.prefix}-day`).textContent = local.toLocaleDateString("en-US", {
                weekday: "long"
            });
        });
    }

    setInterval(update, 1000);
    update();

    window.addEventListener("resize", () => {
        Object.values(clockObjects).forEach(clk => {
            clk.dial.querySelectorAll(".num, .hand, .center-dot").forEach(el => el.remove());
            const els = createClockElements(clk.dial);
            clk.hour = els.hour;
            clk.minute = els.minute;
            clk.second = els.second;
        });
    });
</script>