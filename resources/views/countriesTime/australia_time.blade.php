<x-app
    title="'Sydney Time Now – What Time Is It in Sydney, Australia?'"
    key="'View Sydney time now and compare it with your local time using our online time converter. Find out the current time in Sydney, Australia, and see how it differs from your timezone instantly.'"
    des="'Check Sydney current time instantly with our live time calculator. View Sydney time now, compare time zones, and convert your local time to Australia/Sydney easily.'" />



<div class="bg-emerald-50 text-black dark:bg-slate-900 text-white">
    <div class="w-full min-h-[70vh] py-10 flex flex-col lg:flex-row items-center justify-center gap-16 text-center">

        <!-- Sydney Time -->
        <div class="bg-yellow-50 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-yellow-300 w-[320px] dark:bg-slate-600/50 dark:border-slate-700">
            <h3 class="text-xl font-bold text-emerald-800 dark:text-gray-200 mb-4">Sydney 🇦🇺</h3>
            <div class="dial" id="syd-dial"></div>

            <div class="mt-4 text-emerald-800 dark:text-white space-y-1">
                <p id="syd-day" class="font-bold"></p>
                <p id="syd-date"></p>
                <p id="syd-time" class="text-xl font-semibold"></p>
            </div>
        </div>

        <div class="text-black text-xl dark:text-white"> = </div>

        <!-- Local Time -->
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

    <!-- ✅ SEO TEXT SECTION FOR SYDNEY -->
    <div class="w-full max-w-3xl mx-auto mt-12 p-6 bg-yellow-100/30 rounded-xl shadow border border-yellow-300 dark:text-gray-100 dark:bg-slate-600/50 dark:border-slate-700/40">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 dark:text-gray-100">About Sydney Current Time</h2>
        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Sydney, Australia operates on Australian Eastern Time, which includes Australian Eastern Standard Time (AEST) and Australian Eastern Daylight Time (AEDT) during daylight saving months. If you need to check the <strong>current time in Sydney</strong>, this online clock provides accurate and real-time results based on the official Australia/Sydney timezone.
        </p>

        <p class="text-gray-800 leading-relaxed mb-4 dark:text-gray-200">
            Sydney time is especially important for international business, travel planning, forex trading, sports events, and communication with family or friends living in New South Wales. With our live Sydney clock, you can easily compare your local time with Sydney, helping you schedule calls or meetings without confusion.
        </p>

        <p class="text-gray-800 leading-relaxed dark:text-gray-200">
            Use this tool to find <strong>Sydney time now</strong>, check the <strong>time difference between Sydney and your location</strong>, or convert your local time to match Australia/Sydney timezone instantly.
        </p>
    </div>
</div>

<script>
    const localTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("local-title").textContent = `Your Local Time (${localTZ})`;

    const clocks = [{
            dialId: "local-dial",
            tz: localTZ,
            prefix: "local"
        },
        {
            dialId: "syd-dial",
            tz: "Australia/Sydney",
            prefix: "syd"
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

<x-appfooter />