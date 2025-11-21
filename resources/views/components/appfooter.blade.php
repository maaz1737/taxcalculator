 <div class="pt-16 bg-emerald-50 dark:bg-slate-900/70"></div>
 <footer class="border-t border-slate-200/60 bg-emerald-800 dark:bg-slate-900/70 text-white dark:border-slate-800">
     <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 grid gap-8 md:grid-cols-4">
         <div>
             <div class="flex items-center gap-2 mb-3">
                 <img width="65px" src=" {{ asset('images/staticimages/logo_2.png') }}" alt="calculator Logo" />
                 <span class="font-extrabold text-yellow-500 dark:text-yellow-300">QuickCalculateIt</span>
             </div>
             <p class="text-sm text-gray-100 dark:text-slate-400 ">Calculate smarter—instantly. Fitness, finance, converters, and more.</p>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Sitemap</h4>
             <ul class="space-y-2 text-sm">
                 <li><a href="{{ url('/') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Home</a></li>
                 <li><a href="{{ url('/calculators') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Calculators</a></li>
                 <li><a href="{{ url('/categories') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Categories</a></li>
                 <li><a href="{{ url('/docs') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Docs</a></li>
                 <li><a href="{{ url('/pricing') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Pricing</a></li>
             </ul>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Categories</h4>
             <ul class="space-y-2 text-sm">
                 <li><a href="{{ url('/categories/fitness') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Fitness</a></li>
                 <li><a href="{{ url('/categories/finance') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Finance</a></li>
                 <li><a href="{{ url('/categories/converters') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Converters</a></li>
                 <li><a href="{{ url('/categories/health') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Health</a></li>
                 <li><a href="{{ url('/categories/utilities') }}" class="hover:text-emerald-100 hover:[text-shadow:0_0_6px_#34d399] transition">Utilities</a></li>
             </ul>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Newsletter</h4>
             <form class="space-y-2">
                 <input type="email" placeholder="you@example.com" class="w-full search rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm outline-none ring-1 ring-transparent focus:ring-brand/30 dark:bg-slate-800 dark:border-slate-700">
                 <button class="w-full rounded-xl bg-yellow-600 px-4 py-2 text-white text-sm hover:bg-yellow-700 transition">Subscribe</button>
             </form>
             <div class="mt-4 text-xs text-slate-500">&copy; {{ date('Y') }} [BRAND]. All rights reserved.</div>
         </div>
     </div>
 </footer>

 <script>
     // Theme toggle (localStorage)
     (function() {
         const root = document.documentElement;
         const btn = document.getElementById('themeToggle');
         const key = 'theme';
         const set = m => {
             m === 'dark' ? root.classList.add('dark') : root.classList.remove('dark');
             localStorage.setItem(key, m);
             btn.textContent = m === 'dark' ? '☀️' : '🌙';
         }
         const init = () => set(localStorage.getItem(key) || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
         btn.addEventListener('click', () => set(root.classList.contains('dark') ? 'light' : 'dark'));
         init();
     })();
 </script>


 <script src=" {{ asset('js/header.js') }}" defer></script>
 <script src="{{ asset('js/filter.js') }}" defer></script>
 <script src=" {{ asset('js/simplecalculator.js') }}" defer></script>
 <script src=" {{ asset('js/area.js') }}" defer></script>
 <script src=" {{ asset('js/weight.js') }}" defer></script>
 <script src=" {{ asset('js/volume.js') }}" defer></script>
 <script src=" {{ asset('js/temperature.js') }}" defer></script>
 <script src=" {{ asset('js/time.js') }}" defer></script>
 <script src=" {{ asset('js/length.js') }}" defer></script>
 <script src=" {{ asset('js/taxcalculation.js') }}" defer></script>
 <script src=" {{ asset('js/rent.js') }}" defer></script>
 <script src=" {{ asset('js/salary.js') }}" defer></script>
 <script src=" {{ asset('js/mortgage.js') }}" defer></script>
 <script src=" {{ asset('js/depreciation.js') }}" defer></script>
 <script src=" {{ asset('js/simplecalculator.js') }}" defer></script>
 <script src="{{ asset('js/scientificCalculator.js') }}" defer></script>




 @if (request()->routeIs('age.*'))
 <script src="{{ asset('js/ageCalculation.js') }}" defer></script>
 @endif

 @if (request()->routeIs('dayCounter.*'))
 <script src="{{ asset('js/dayCounter.js') }}" defer></script>
 @endif


 </body>

 </html>