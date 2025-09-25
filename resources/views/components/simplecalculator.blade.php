        <div id="draggableIcon"
            class="fixed bottom-[45%] w-64 right-5 w-12 h-12 dark:text-white z-[65]  shadow-lg cursor-move select-none">
            <div style="position: relative;">
                <button id="minimize"
                    style="position: absolute;top:13px;right:7%"
                    class="px-3 py-5 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none text-[20px]" aria-label="Close"> -
                </button>
            </div>
            <div class="popup-content hide bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full p-6 sm:p-8">
                <div class="flex items-center justify-between px-2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Calculator</h2>
                    <div>
                        <button id="bigger" class="px-2 mx-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none" aria-label="Close"> ⛶
                        </button>
                    </div>


                </div>
                <!-- Calculator Form -->
                <div class="mt-4">
                    <!-- Display Screen -->
                    <div id="calc-screen" class="w-full h-12 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white text-right p-2 rounded-lg mb-4 overflow-hidden">
                        0
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <!-- LEFT SIDE (Numbers + Brackets + Dot) -->
                        <div class="col-span-3">
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Row 1 -->
                                <button class="calc-btn" id="btn-7">7</button>
                                <button class="calc-btn" id="btn-8">8</button>
                                <button class="calc-btn" id="btn-9">9</button>

                                <!-- Row 2 -->
                                <button class="calc-btn" id="btn-4">4</button>
                                <button class="calc-btn" id="btn-5">5</button>
                                <button class="calc-btn" id="btn-6">6</button>

                                <!-- Row 3 -->
                                <button class="calc-btn" id="btn-1">1</button>
                                <button class="calc-btn" id="btn-2">2</button>
                                <button class="calc-btn" id="btn-3">3</button>

                                <!-- Row 4 -->
                                <button class="calc-btn" id="btn-0">0</button>
                                <button class="calc-btn" id="btn-open">(</button>
                                <button class="calc-btn" id="btn-close">)</button>

                                <!-- Row 5 -->
                                <button class="calc-btn" id="btn-dot">.</button>
                            </div>
                        </div>

                        <!-- RIGHT SIDE (Clear + Operators + Delete + Equals) -->
                        <div class="col-span-1 flex flex-col">
                            <!-- Top: Clear -->
                            <button id="btn-clear" class="w-full bg-red-500 text-white p-2 rounded-lg mb-2">C</button>

                            <!-- Middle: Operators -->
                            <div class="flex flex-col gap-2 flex-1">
                                <!-- Delete Button (Updated) -->
                                <button id="delete" class="bg-yellow-400 text-gray-900 hover:bg-yellow-500 focus:outline-none p-2 rounded-lg">
                                    Del
                                </button>
                                <button class="calc-btn operator" id="btn-div">/</button>
                                <button class="calc-btn operator" id="btn-mul">*</button>
                                <button class="calc-btn operator" id="btn-sub">-</button>
                                <button class="calc-btn operator" id="btn-add">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Equals Button -->
                    <div class="mt-4">
                        <button class="calc-btn equals w-full bg-red-500 text-white p-2 rounded-lg" id="btn-equals">=</button>
                    </div>

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
                    $('#minimize').css({
                        right: '2%'
                    });

                } else {
                    $('#minimize').css({
                        right: '7%'
                    });
                    $("#bigger").text("⛶");

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
                        color: 'white',
                        fontSize: '16px'
                    });
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
                        color: 'rgb(218 228 230)',
                        fontSize: '22px'


                    });


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