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

    .try {
        width: 50vw;
        height: 75vh;
    }

    /* Backdrop when calculator is enlarged */
    .backdrop {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(6px);
        z-index: 60;
    }
</style>

<div class="relative">
    <button id="small-icon"
        class="fixed bottom-2 block sm:hidden right-[4%] text-[24px] px-1 py-1 text-black dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none"
        aria-label="Close" style="z-index: 9999999999999 !important;"><img width="60px" src="http://quickcalculateit.com/images/staticimages/logo_2.png" alt=""></button>
</div>

<div class="relative outer">
    <div id="draggableIcon"
        class="fixed bottom-[0%] right-1 w-64 z-[65] cursor-move select-none hidden sm:block">

        <!-- minimize -->
        <div class="relative">
            <button id="minimize"
                class="absolute top-7 right-[8%] text-[24px] px-1 py-1 text-black dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none"
                aria-label="Close" style="z-index: 9999999999999 !important;">-</button>
        </div>

        <!-- outer bezel -->
        <div class="popup-content hide block w-full  p-3 sm:p-4 rounded-2xl shadow-2xl
              bg-gray-400/90 dark:bg-gray-700/90">
            <!-- inner plate -->
            <div class="rounded-2xl p-4 shadow-inner
                bg-gray-100 dark:bg-gray-800 h-full">

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
                        class="calc-btn absolute left-2 top-2 w-10 h-10 rounded-lg shadow
                       bg-orange-400 text-white  font-bold
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
                <div class="grid grid-cols-4  gap-3">
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
</div>


<div id="bigCalculator"
    class="fixed z-[65] hidden w-[90vw] sm:w-[75vw] lg:w-[55vw] max-w-[550px] 
           h-[80vh] bg-gray-200 dark:bg-gray-800 rounded-2xl shadow-2xl p-4 
           overflow-hidden flex flex-col justify-between"
    style="top:50%; left:50%; transform:translate(-50%, -50%)">

    <!-- Header -->
    <div class="flex justify-between items-center mb-3 px-1">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">Big Calculator</h2>
        <button id="closeBigCalc"
            class="px-2 text-[22px] hidden sm:block text-black dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none"
            aria-label="Close">×</button>
        <button id="smallclose"
            class="px-2 text-[22px] block sm:hidden text-black dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none"
            aria-label="Close">×</button>
    </div>

    <!-- Screen -->
    <div class="relative mb-4 flex-shrink-0">
        <button id="btn-clear"
            class="calc-btn absolute left-2 top-2 w-10 h-10 sm:w-12 sm:h-12 rounded-lg shadow 
                   bg-orange-400 text-white font-bold hover:bg-orange-500 
                   focus:ring-2 focus:ring-orange-300">C</button>
        <div id="bigCalcScreen"
            class="h-14 sm:h-16 w-full rounded-xl pl-14 pr-3 flex items-center justify-end overflow-hidden
                   text-right text-xl sm:text-2xl font-semibold bg-sky-50 text-slate-900
                   dark:bg-slate-900 dark:text-slate-50 shadow-inner">
            0
        </div>
    </div>

    <!-- Keypad -->
    <div class="grid grid-cols-4 gap-3 sm:gap-4 mt-auto">
        <!-- Numbers -->
        <div class="col-span-3 w-full">
            <div class="grid grid-cols-3 gap-3 sm:gap-4 place-items-center">
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">7</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">8</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">9</button>

                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">4</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">5</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">6</button>

                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">1</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">2</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">3</button>

                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">0</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">(</button>
                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">)</button>

                <button class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-sky-100 text-slate-900 font-bold hover:bg-sky-200 dark:bg-slate-700 dark:text-white">.</button>
                <button id="btn-equals-big"
                    class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-500 text-white text-xl font-bold hover:bg-emerald-600 shadow">=</button>
                <button class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-400 text-emerald-950 font-extrabold hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50">÷</button>
            </div>
        </div>

        <!-- Operators -->
        <div class="col-span-1 flex flex-col gap-3 sm:gap-4 items-center justify-between">
            <button id="delete-big" class="calc-btn w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-amber-300 text-gray-900 font-semibold hover:bg-amber-400">Del</button>
            <button class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-400 text-emerald-950 font-extrabold hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50">Ac</button>
            <button class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-400 text-emerald-950 font-extrabold hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50">×</button>
            <button class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-400 text-emerald-950 font-extrabold hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50">−</button>
            <button class="calc-btn operator w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-emerald-400 text-emerald-950 font-extrabold hover:bg-emerald-500 dark:bg-emerald-500 dark:text-emerald-50">+</button>
        </div>
    </div>
</div>









<script>
    const icon = document.getElementById("draggableIcon");

    let isDragging = false;
    let disableDrag = false;
    let offsetX, offsetY;

    icon.addEventListener("mousedown", (e) => {
        if (disableDrag) return;
        isDragging = true;
        offsetX = e.clientX - icon.getBoundingClientRect().left;
        offsetY = e.clientY - icon.getBoundingClientRect().top;
        icon.style.transition = "none"; // stop smoothness while dragging
    });

    document.addEventListener("mousemove", (e) => {
        if (!isDragging || disableDrag) return;
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

    let minimize = $("#minimize");
    let calculator = $(".hide");
    let closeBigCalc = $("#closeBigCalc");

    function miniFun() {
        const calculatorIconHtml =
            '<img src="http://quickcalculateit.com/images/staticimages/logo_2.png" alt="Calculator" class="w-20 h-20">';

        if (calculator.hasClass("block")) {
            calculator.removeClass("block").addClass("hidden");
            minimize.empty().append(calculatorIconHtml);
            minimize.removeClass("absolute");

            $(icon)
                .removeClass("w-64")
                .addClass("w-25 text-end")
                .css({
                    top: "",
                    left: ""
                })
                .addClass("bottom-2 right-[0px]");
            disableDrag = true;
        } else {
            calculator.removeClass("hidden").addClass("block");
            minimize.empty().append("-");
            minimize.addClass("absolute");

            $(icon)
                .removeClass("w-25 bottom-2 right-[0px]")
                .addClass("w-64");
            disableDrag = false;
        }
    }

    minimize.on("click", miniFun);

    let bigBtn = $("#bigger");
    let bigCalculator = $("#bigCalculator");
    let isBig = false;
    let backdrop;

    function bigFun() {

        console.log('data');
        if (bigCalculator.hasClass('hidden')) {
            bigCalculator.removeClass('hidden').addClass('block');
            icon.style.display = 'none';
            $('body').css('overflow', 'hidden');
            backdrop = $('<div class="fixed inset-0 bg-black/40 backdrop-blur-md z-[60]"></div>');
            $('body').append(backdrop);

        }
    }


    $('#small-icon').on('click', bigFun);


    closeBigCalc.on('click', function() {
        if (bigCalculator.hasClass('block')) {
            bigCalculator.removeClass('block').addClass('hidden');
            icon.style.display = 'block'
            $('body').css('overflow', '');
            if (backdrop) {
                backdrop.remove();
                backdrop = null;
            }

        }
    });

    $('#smallclose').on('click', function() {
        if (bigCalculator.hasClass('block')) {
            bigCalculator.removeClass('block').addClass('hidden');
            $('body').css('overflow', '');
            if (backdrop) {
                backdrop.remove();
                backdrop = null;
            }

        }
    });

    bigBtn.on("click", bigFun);
</script>