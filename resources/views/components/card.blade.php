    @props(['featured'])

    <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 ">
        @foreach($featured as $f)
        <div
            class=" filter-card rounded-2xl border border-slate-200 bg-white p-5 shadow-card transition hover:-translate-y-0.5 hover:shadow-lg dark:bg-slate-800 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center rounded-full border px-2 py-0.5 text-xs text-slate-600 dark:text-slate-300 dark:border-slate-700">{{ $f['tag'] }}</span>
            </div>
            <div class="mt-3 font-semibold">{{ $f['title'] }}</div>
            <div class="text-sm text-slate-600 dark:text-slate-400">{{ $f['summary'] }}</div>
            <button id="{{$f['id']}}" data-modal-target="{{$f['data']}}" class="mt-4 text-brand text-sm">{{ $f['name'] }} →</button>
        </div>
        @endforeach
    </div>
    </section>