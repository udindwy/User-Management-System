@props([
    'action'      => '',
    'method'      => 'GET',
    'placeholder' => 'Cari...',
    'searchName'  => 'search',
    'resetRoute'  => null,
])

<form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}"
    class="p-4 border-b border-slate-100">
    @if(strtoupper($method) !== 'GET') @csrf @endif

    <div class="flex flex-col sm:flex-row gap-3">

        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="{{ $searchName }}" value="{{ request($searchName) }}"
                placeholder="{{ $placeholder }}"
                class="w-full pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-lg
                    focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-400 transition-colors">
        </div>

        {{ $slot }}

        <button type="submit"
            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
            Filter
        </button>

        @if($resetRoute && request()->hasAny([$searchName]))
            <a href="{{ $resetRoute }}"
                class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                Reset
            </a>
        @endif
    </div>
</form>
