@props([
    'title'       => null,
    'description' => null,
    'footer'      => false,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-slate-200 shadow-sm']) }}>

    @if($title || $description)
        <div class="px-6 py-4 border-b border-slate-100">
            @if($title)
                <h3 class="text-sm font-semibold text-slate-800">{{ $title }}</h3>
            @endif
            @if($description)
                <p class="text-xs text-slate-500 mt-0.5">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @isset($actions)
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end space-x-3">
            {{ $actions }}
        </div>
    @endisset

</div>
