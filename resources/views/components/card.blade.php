    @props(['featured'])

    <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($featured as $f)
        <div
            class="filter-card group rounded-2xl border border-yellow-300 bg-yellow-100/30 p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_4px_20px_rgba(250,204,21,0.4)] hover:border-yellow-400 hover:bg-yellow-100/60 dark:bg-slate-800 dark:border-slate-700 dark:hover:border-blue-400 dark:hover:shadow-[0_4px_20px_rgba(59,130,246,0.4)] cursor-pointer"
            data-modal-target="{{ $f['data'] }}" id="{{ $f['id'] }}">
            <div class="flex items-center justify-between">
                <span
                    class="inline-flex items-center rounded-full border border-1 border-yellow-600 px-2 py-0.5 text-sm text-emerald-700 dark:text-slate-300 dark:border-slate-600">{{ $f['tag'] }}</span>
            </div>
            <h1 class="mt-3 font-semibold text-lg">{{ $f['title'] }}</h1>
            <button data-modal-target="{{ $f['data'] }}"
                class="mt-2 text-brand text-sm group-hover:underline text-emerald-600 dark:text-blue-600">{{ $f['name'] }} →</button>
        </div>
        @endforeach
    </div>
    </section>