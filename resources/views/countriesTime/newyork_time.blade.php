<x-app
    title="'New York Time Now – What Time Is It in New York?'"
    key="'View New York time now and compare it with your local time using our online time converter. Find out the current time in New York City, USA, and see how it differs from your timezone instantly.'"
    des="'Check New York current time instantly with our live time calculator. View NYC time now, compare time zones, and convert your local time to New York easily.'" />



<div class="bg-emerald-50 text-black dark:bg-slate-900 text-white">

    <div class="w-full min-h-[70vh] py-10 flex flex-col lg:flex-row items-center justify-center gap-16 text-center">
        <!-- New York Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4">New York (US)</h3>
            <div class="dial" id="ny-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="ny-day" class="font-bold "></p>
                <p id="ny-date"></p>
                <p id="ny-time" class="text-xl font-semibold"></p>
            </div>
        </div>
        <div class="text-black text-5xl dark:text-white"> = </div>

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

    </div>


    <!-- SEO TEXT SECTION -->
    <div class="w-full max-w-3xl mx-auto mt-12 p-6 bg-yellow-100/30 rounded-xl shadow border border-yellow-300 dark:text-gray-100 dark:bg-slate-600/50 dark:border-slate-700/40">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 dark:text-gray-100">About New York Current Time</h2>
        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            New York runs on Eastern Time (ET), which can be either Eastern Standard Time (EST) or Eastern Daylight Time (EDT) depending on the season.
            If you need to check the <strong>current time in New York</strong>, compare time differences, or convert your local time to New York time, this online calculator makes it quick and accurate.
        </p>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Knowing the correct New York time is especially useful for international business, online meetings, stock market timings, travel planning, and communication with friends or family living in New York City.
            Our tool provides a live clock updated in real-time, ensuring you always get the most accurate NYC time.
        </p>

        <p class="text-gray-800 leading-relaxed dark:text-gray-200">
            Use this tool anytime you need to find <strong>New York time now</strong>, check the <strong>time difference between New York and your country</strong>, or convert your local time to match New York's Eastern Time zone.
        </p>
    </div>
</div>



<script>
    /* ✅ Detect user timezone */
    const localTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("local-title").textContent = `Your Local Time (${localTZ})`;

    /* ✅ clock definitions */
    const clocks = [{
            dialId: "local-dial",
            tz: localTZ,
            prefix: "local"
        },
        {
            dialId: "ny-dial",
            tz: "America/New_York",
            prefix: "ny"
        }
    ];

    const clockObjects = {};

    /* ✅ Create numbers + hands */
    function createClockElements(dialEl) {
        const size = dialEl.clientWidth;
        const center = size / 2;
        const radius = center - 28;

        // numbers
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

        // hands
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

    /* ✅ Create clocks */
    clocks.forEach(c => {
        const dial = document.getElementById(c.dialId);
        const els = createClockElements(dial);
        clockObjects[c.prefix] = {
            ...c,
            dial,
            ...els
        };
    });

    /* ✅ Update analog + digital time */
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