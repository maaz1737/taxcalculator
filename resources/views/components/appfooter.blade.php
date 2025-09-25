 <footer class="mt-16 border-t border-slate-200/60 dark:border-slate-800">
     <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 grid gap-8 md:grid-cols-4">
         <div>
             <div class="flex items-center gap-2 mb-3">
                 <div class="h-8 w-8 rounded-xl bg-brand/10 text-brand grid place-items-center font-extrabold">≡</div>
                 <span class="font-extrabold">[BRAND]</span>
             </div>
             <p class="text-sm text-slate-600 dark:text-slate-400">Calculate smarter—instantly. Fitness, finance, converters, and more.</p>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Sitemap</h4>
             <ul class="space-y-2 text-sm">
                 <li><a href="{{ url('/') }}" class="hover:text-brand">Home</a></li>
                 <li><a href="{{ url('/calculators') }}" class="hover:text-brand">Calculators</a></li>
                 <li><a href="{{ url('/categories') }}" class="hover:text-brand">Categories</a></li>
                 <li><a href="{{ url('/docs') }}" class="hover:text-brand">Docs</a></li>
                 <li><a href="{{ url('/pricing') }}" class="hover:text-brand">Pricing</a></li>
             </ul>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Categories</h4>
             <ul class="space-y-2 text-sm">
                 <li><a href="{{ url('/categories/fitness') }}" class="hover:text-brand">Fitness</a></li>
                 <li><a href="{{ url('/categories/finance') }}" class="hover:text-brand">Finance</a></li>
                 <li><a href="{{ url('/categories/converters') }}" class="hover:text-brand">Converters</a></li>
                 <li><a href="{{ url('/categories/health') }}" class="hover:text-brand">Health</a></li>
                 <li><a href="{{ url('/categories/utilities') }}" class="hover:text-brand">Utilities</a></li>
             </ul>
         </div>

         <div>
             <h4 class="mb-3 font-semibold">Newsletter</h4>
             <form class="space-y-2">
                 <input type="email" placeholder="you@example.com" class="w-full rounded-xl border border-slate-200 bg-white/70 px-3 py-2 text-sm outline-none ring-1 ring-transparent focus:ring-brand/30 dark:bg-slate-800 dark:border-slate-700">
                 <button class="w-full rounded-xl bg-brand px-4 py-2 text-white text-sm hover:bg-blue-600 transition">Subscribe</button>
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

 @stack('scripts')





 </body>

 </html>