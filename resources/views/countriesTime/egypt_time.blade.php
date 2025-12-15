<x-app
    title="Current Time in Egypt - Cairo Time Now"
    key="View current time in Egypt and Cairo now. Compare Egypt time with your local timezone using our instant online converter. Eastern European Time (EET) live clock."
    des="Check Egypt time now instantly with our live Cairo clock and time converter. Compare time zones, convert local time to Egypt EET, and see the difference."
    titleTwitter="Current Time in Egypt Now - Cairo Clock" />


<div class="bg-emerald-50 text-black dark:bg-slate-900 dark:text-white">

    <div class="w-full min-h-[70vh] py-10 flex flex-col lg:flex-row items-center justify-center gap-16 text-center">

        <!-- User Local Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 id="local-title" class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4"></h3>
            <div class="dial" id="local-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="local-day" class="font-bold"></p>
                <p id="local-date"></p>
                <p id="local-time" class="text-xl font-semibold"></p>
            </div>
        </div>

        <div class="text-black text-5xl dark:text-white"> = </div>

        <!-- Egypt Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4">
                Egypt (Cairo)
            </h3>
            <div class="dial" id="eg-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="eg-day" class="font-bold"></p>
                <p id="eg-date"></p>
                <p id="eg-time" class="text-xl font-semibold"></p>
            </div>
        </div>

    </div>

    <!-- SEO TEXT SECTION -->
    <div class="w-full max-w-3xl mx-auto mt-12 p-6 bg-yellow-100/30 rounded-xl shadow border border-yellow-300 dark:text-gray-100 dark:bg-slate-600/50 dark:border-slate-700/40">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 dark:text-gray-100">
            About Egypt Current Time
        </h2>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Egypt follows Eastern European Time (EET), which is UTC +2.
            Egypt observes daylight saving time during certain months, switching to Eastern European Summer Time (EEST, UTC +3).
        </p>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Knowing the current time in Egypt is essential for international business,
            travel planning, online meetings, and communication with people living in Cairo and other Egyptian cities.
            This live clock updates in real time to give you the most accurate Egypt time now.
        </p>

        <p class="text-gray-800 leading-relaxed dark:text-gray-200">
            Use this tool to check the current time in Egypt, compare it with your local time,
            or instantly convert your time to match Egypt's timezone.
        </p>
    </div>
</div>

<script>
    /* ✅ Detect user timezone */
    const localTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("local-title").textContent = `Your Local Time (${localTZ})`;

    /* ✅ Clock definitions */
    const clocks = [{
            dialId: "local-dial",
            tz: localTZ,
            prefix: "local"
        },
        {
            dialId: "eg-dial",
            tz: "Africa/Cairo",
            prefix: "eg"
        }
    ];

    const clockObjects = {};

    /* ✅ Create clock numbers & hands */
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

    /* ✅ Convert target timezone to JS Date */
    function getDateInTimeZone(tz) {
        const now = new Date();

        const formatter = new Intl.DateTimeFormat("en-US", {
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

    /* ✅ Initialize clocks */
    clocks.forEach(c => {
        const dial = document.getElementById(c.dialId);
        const els = createClockElements(dial);

        clockObjects[c.prefix] = {
            ...c,
            dial,
            ...els
        };
    });

    /* ✅ Update clocks */
    function update() {
        Object.values(clockObjects).forEach(clk => {
            const time = getDateInTimeZone(clk.tz);

            const h = time.getHours();
            const m = time.getMinutes();
            const s = time.getSeconds();

            clk.hour.style.transform = `translate(-50%, -100%) rotate(${(h % 12) * 30 + m * 0.5}deg)`;
            clk.minute.style.transform = `translate(-50%, -100%) rotate(${m * 6 + s * 0.1}deg)`;
            clk.second.style.transform = `translate(-50%, -100%) rotate(${s * 6}deg)`;

            document.getElementById(`${clk.prefix}-time`).textContent = time.toLocaleTimeString();
            document.getElementById(`${clk.prefix}-date`).textContent = time.toLocaleDateString();
            document.getElementById(`${clk.prefix}-day`).textContent = time.toLocaleDateString("en-US", {
                weekday: "long"
            });
        });
    }

    setInterval(update, 1000);
    update();

    /* ✅ Fix duplicated hands on resize */
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

<x-appfooter />