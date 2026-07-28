@props([
    'title'    => null,
    'subtitle' => null,
    'backUrl'  => null,
    'backLabel'=> 'Kembali',
])

<div class="flex items-start justify-between mb-6">
    <div>
        @if($title)
            <h1 class="text-lg font-semibold text-slate-800">{{ $title }}</h1>
        @endif
        @if($subtitle)
            <p class="text-sm text-slate-500 mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="flex items-center space-x-3">
        {{ $actions ?? '' }}

        @if($backUrl)
            <a href="{{ $backUrl }}"
                class="inline-flex items-center space-x-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>{{ $backLabel }}</span>
            </a>
        @endif
    </div>
</div>
