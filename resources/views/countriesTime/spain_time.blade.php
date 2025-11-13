<x-app
    :title="'Spain Time Now – Current Time in Madrid | Live Spain Time Zone Converter'"
    :titleTwitter="'Spain Time Now – Live Madrid Time'"
    :des="'Check the current time in Spain (Madrid) with our live online clock. View Spain local time, compare your time zone with Madrid, and convert your local time to Spain time instantly and accurately.'"
    :key="'Spain time now, current time in Madrid, Madrid time now, Spain timezone, Spain local time, time in Madrid, Spain time converter, live Spain clock, Spain time difference, world clock Madrid, Europe/Madrid time, Central European Time, convert local time to Spain, online Spain time zone converter'" />

<div class="bg-emerald-50 text-black dark:bg-slate-900 text-white">
    <div class="w-full min-h-[70vh] py-10 flex flex-col lg:flex-row items-center justify-center gap-16 text-center">

        <!-- SPAIN TIME -->
        <div
            class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4">Spain 🇪🇸 (Madrid)</h3>
            <div class="dial" id="spain-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="spain-day" class="font-bold"></p>
                <p id="spain-date"></p>
                <p id="spain-time" class="text-xl font-semibold"></p>
            </div>
        </div>

        <div class="text-black text-5xl dark:text-white"> = </div>

        <!-- LOCAL TIME -->
        <div
            class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 id="local-title" class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4"></h3>
            <div class="dial" id="local-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="local-day" class="font-bold"></p>
                <p id="local-date"></p>
                <p id="local-time" class="text-xl font-semibold"></p>
            </div>
        </div>

    </div>

    <!-- ✅ SEO CONTENT SECTION -->
    <div
        class="w-full max-w-3xl mx-auto mt-12 p-6 bg-yellow-100/30 rounded-xl shadow border border-yellow-300 dark:text-gray-100 dark:bg-slate-600/50 dark:border-slate-700/40">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 dark:text-gray-100">About Spain Current Time (Madrid Time)</h2>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            The <strong>current time in Spain</strong> follows <strong>Central European Time (CET, UTC+1)</strong> during standard time
            and <strong>Central European Summer Time (CEST, UTC+2)</strong> during daylight saving time. Madrid, the capital city of Spain, observes this same time zone.
        </p>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            This live clock displays the <strong>exact time in Madrid</strong>, updated every second. Compare <strong>Spain time with your local time</strong>
            easily, making it ideal for travelers, global meetings, or those staying connected with friends or family in Spain.
        </p>

        <p class="text-gray-800 leading-relaxed dark:text-gray-200">
            Whether you need to schedule calls, plan travel, or just know <strong>what time it is in Spain right now</strong>,
            this real-time <strong>Spain time zone converter</strong> keeps you informed with the latest date, day, and time in Madrid.
        </p>
    </div>
</div>

<x-appfooter />

<script>
    const localTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("local-title").textContent = `Your Local Time (${localTZ})`;

    const clocks = [{
            dialId: "local-dial",
            tz: localTZ,
            prefix: "local"
        },
        {
            dialId: "spain-dial",
            tz: "Europe/Madrid",
            prefix: "spain"
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
        const now = new Date();
        const formatter = new Intl.DateTimeFormat("en-GB", {
            timeZone: tz,
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false
        });

        const parts = formatter.formatToParts(now);
        const map = {};
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
            document.getElementById(`${clk.prefix}-day`).textContent = local.toLocaleDateString("en-GB", {
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