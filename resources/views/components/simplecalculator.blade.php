<style>
    /* Shared micro-interaction */
    .calc-btn,
    #btn-clear,
    #delete {
        transition: background-color .15s ease, box-shadow .15s ease, transform .12s ease;
        will-change: transform, box-shadow, background-color;
    }

    .calc-btn:hover,
    #btn-clear:hover,
    #delete:hover {
        box-shadow: 0 10px 24px rgba(0, 0, 0, .20);
    }

    .calc-btn:active,
    #btn-clear:active,
    #delete:active {
        transform: translateY(1px);
    }

    .calc-btn:focus-visible,
    #btn-clear:focus-visible,
    #delete:focus-visible {
        outline: none;
        box-shadow:
            0 10px 24px rgba(0, 0, 0, .20),
            0 0 0 3px rgba(55, 128, 245, 0.35);
        /* sky ring */
    }

    /* Number / dot / bracket keys (sky in light, slate in dark) */
    .calc-btn.bg-sky-100:hover {
        background-color: rgb(191 219 254);
    }

    /* sky-200 */
    .dark .calc-btn.dark\:bg-slate-700:hover {
        background-color: rgb(71 85 105);
    }

    /* slate-600 */

    /* Operator column (emerald) – you already had hover, this just lifts it a bit */
    .calc-btn.operator:hover {
        box-shadow: 0 10px 24px rgba(0, 0, 0, .22);
    }

    .dark .calc-btn.operator:hover {
        filter: brightness(1.06);
    }

    /* Equals (emerald) – gentle brighten on hover */
    #btn-equals:hover {
        filter: brightness(1.06);
    }

    /* Clear (orange) & Delete (amber) – subtle lift already has color hover in your classes */
    #btn-clear:hover,
    #delete:hover {
        transform: translateY(0);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .24);
    }

    /* Screen cursor cue when any key is hovered */
    .grid .calc-btn:hover~#calc-screen,
    .grid .calc-btn:hover+#calc-screen {
        cursor: default;
    }
</style>

<div id="draggableIcon"
    class="fixed bottom-[0%] right-1 w-64 z-[65] cursor-move select-none hidden sm:block">

    <!-- minimize -->
    <div class="relative">
        <button id="minimize"
            class="absolute top-3 right-[5%] text-[24px] px-3 py-5 text-black dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none"
            aria-label="Close">-</button>
    </div>

    <!-- outer bezel -->
    <div class="popup-content hide w-full p-3 sm:p-4 rounded-2xl shadow-2xl
              bg-gray-400/90 dark:bg-gray-700/90">
        <!-- inner plate -->
        <div class="rounded-2xl p-4 shadow-inner
                bg-gray-100 dark:bg-gray-800">

            <!-- header row -->
            <div class="flex items-center justify-between px-1 mb-2">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Calculator</h2>
                <button id="bigger"
                    class="px-2 mx-1 text-[20px] text-gray-800 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 focus:outline-none"
                    aria-label="Maximize">⛶</button>
            </div>

            <!-- Screen (with orange C inside) -->
            <div class="relative mb-4">
                <button id="btn-clear"
                    class="absolute left-2 top-2 w-10 h-10 rounded-lg shadow
                       bg-orange-400 text-white font-bold
                       hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-300">
                    C
                </button>
                <div id="calc-screen"
                    class="h-14 w-full rounded-xl pl-14 pr-3 flex items-center justify-end overflow-hidden
                    text-right text-xl font-semibold
                    bg-sky-50 text-slate-900
                    dark:bg-slate-900 dark:text-slate-50">
                    0
                </div>
            </div>

            <!-- Keypad -->
            <div class="grid grid-cols-4 gap-3">
                <!-- LEFT: numbers -->
                <div class="col-span-3">
                    <div class="grid grid-cols-3 gap-3">
                        <!-- row 1 -->
                        <button class="calc-btn w-10 h-10 rounded-full shadow
                           bg-sky-100 text-slate-900 font-bold
                           dark:bg-slate-700 dark:text-slate-100" id="btn-7">7</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow
                           bg-sky-100 text-slate-900 font-bold
                           dark:bg-slate-700 dark:text-slate-100" id="btn-8">8</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow
                           bg-sky-100 text-slate-900 font-bold
                           dark:bg-slate-700 dark:text-slate-100" id="btn-9">9</button>

                        <!-- row 2 -->
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-4">4</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-5">5</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-6">6</button>

                        <!-- row 3 -->
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-1">1</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-2">2</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-3">3</button>

                        <!-- row 4 -->
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-0">0</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-open">(</button>
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-close">)</button>


                        <!-- dot -->
                        <button class="calc-btn w-10 h-10 rounded-full shadow bg-sky-100 text-slate-900 font-bold dark:bg-slate-700 dark:text-slate-100" id="btn-dot">.</button>
                        <button></button>
                        <button id="btn-equals"
                            class="calc-btn equals w-10 h-10 rounded-full shadow
                       bg-emerald-500 text-white text-xl font-bold
                       hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-300">=</button>
                    </div>
                </div>

                <!-- RIGHT: operator column -->
                <div class="col-span-1 flex flex-col gap-3 items-stretch">
                    <!-- Delete (small amber circle) -->
                    <button id="delete"
                        class="calc-btn w-10 h-10 self-center rounded-full shadow
                         bg-amber-300 text-gray-900 font-semibold
                         hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300">
                        Del
                    </button>
                    <button class="calc-btn operator w-10 h-10 self-center rounded-full shadow
                         bg-emerald-400 text-emerald-950 font-extrabold
                         hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50" id="btn-div">÷</button>
                    <button class="calc-btn operator w-10 h-10 self-center rounded-full shadow
                         bg-emerald-400 text-emerald-950 font-extrabold
                         hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50" id="btn-mul">×</button>
                    <button class="calc-btn operator w-10 h-10 self-center rounded-full shadow
                         bg-emerald-400 text-emerald-950 font-extrabold
                         hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50" id="btn-sub">−</button>
                    <button class="calc-btn operator w-10 h-10 self-center rounded-full shadow
                         bg-emerald-400 text-emerald-950 font-extrabold
                         hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50" id="btn-add">+</button>
                </div>
            </div>

            <!-- equals: wide green pill (feel like the image’s big green key) -->


            <!-- brand strip -->
            <!-- <p class="mt-3 text-center text-[11px] tracking-[.25em]
                text-gray-500 dark:text-gray-300">
                www.online-calculator.com
            </p> -->
        </div>
    </div>
</div>




<script>
    const icon = document.getElementById("draggableIcon");

    let isDragging = false;
    let offsetX, offsetY;

    icon.addEventListener("mousedown", (e) => {
        isDragging = true;
        offsetX = e.clientX - icon.getBoundingClientRect().left;
        offsetY = e.clientY - icon.getBoundingClientRect().top;
        icon.style.transition = "none"; // stop smoothness while dragging


    });

    document.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        const x = e.clientX - offsetX;
        const y = e.clientY - offsetY;
        icon.style.left = x + "px";
        icon.style.top = y + "px";
        icon.style.position = "fixed";
    });

    document.addEventListener("mouseup", () => {
        isDragging = false;
        icon.style.transition = "all 0.2s ease";
    });

    let large = false;
    let minimized = false;

    function applySizeFromState() {

        $("#draggableIcon").removeClass("w-[40vw] h-[60vh]");
        $("#calc-screen").removeClass("h-16");
        $(".calc-btn").removeClass("px-1 py-1 mx-4 my-2");

        if (large) {

            $("#draggableIcon").addClass("w-[40vw] h-[60vh]");
            $("#calc-screen").addClass("h-16");
            $(".calc-btn").addClass("px-1 py-1 mx-4 my-1");
            $("#bigger").text("✕");
            $('.calc-btn').removeClass('h-10 w-10');
            $('.calc-btn').addClass('h-16 w-16');
            $('#minimize').css({
                right: '2%'
            });

        } else {
            $('#minimize').css({
                right: '5%'
            });
            $("#bigger").text("⛶");
            $('.calc-btn').removeClass('h-16 w-16');

            $('.calc-btn').addClass('h-10 w-10');


        }
    }

    $('#bigger').on('click', function() {

        large = !large;
        applySizeFromState();
    });

    $('#minimize').on('click', function() {
        const $popup = $(".hide");

        if ($popup.is(":visible")) {

            minimized = true;
            $popup.slideUp(300);

            $(this).text("open calculator").css({
                top: '0%',
                right: '50%',
                transform: 'translate(50%,-10%)',
                position: 'absolute',
                fontSize: '16px'
            });
            $(this).addClass('text-white');
            //   $(this).html('<img src="assets/images/calculator-icon-png.webp" alt="open">').css({
            //                     top: '',
            //                     right: '',
            //                     transform: '',
            //                     position: 'absolute',
            //                     width: '200px',
            //                     height: '200px'
            //                 });

            $("#draggableIcon").css({
                backgroundColor: "#0740a8ff",
                borderRadius: '10px',
                height: '50px',
                width: '300px'
            });

        } else {

            minimized = false;
            $popup.slideDown(300);

            $(this).css({
                top: '',
                right: '',
                transform: 'none',
            });

            $(this).text("-").css({
                right: '4%',
                top: '13px',
                fontSize: '22px'


            });

            $(this).removeClass('text-white');
            $(this).addClass('text-dark dark:text-white');

            $("#draggableIcon").css({
                backgroundColor: "",
                borderRadius: "",
                height: "",
                width: ""
            });


            applySizeFromState();
        }
    });
</script>