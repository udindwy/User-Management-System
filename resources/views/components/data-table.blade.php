@props([
    'title'   => null,
    'empty'   => 'Tidak ada data ditemukan.',
    'rows'    => null,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden']) }}>

    @if(isset($header))
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            @if($title)
                <h3 class="text-sm font-semibold text-slate-700">{{ $title }}</h3>
            @endif
            {{ $header }}
        </div>
    @endif

    @isset($filters)
        {{ $filters }}
    @endisset

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            @isset($thead)
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        {{ $thead }}
                    </tr>
                </thead>
            @endisset

            <tbody class="divide-y divide-slate-100">
                @if(isset($rows) && $rows->isEmpty())
                    <tr>
                        <td colspan="99" class="px-5 py-10 text-center">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-sm text-slate-400">{{ $empty }}</p>
                        </td>
                    </tr>
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>

    @isset($footer)
        <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50">
            {{ $footer }}
        </div>
    @endisset

</div>
