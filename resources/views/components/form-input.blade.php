@props([
    'label'       => null,
    'name'        => null,
    'type'        => 'text',
    'value'       => null,
    'placeholder' => '',
    'required'    => false,
    'help'        => null,
    'readonly'    => false,
    'bag'         => 'default',
])

@php
    $hasError = $errors->getBag($bag)->has($name);
    $inputClass = "w-full px-3.5 py-2.5 text-sm border rounded-lg transition-colors
        focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-400"
        . ($hasError ? ' border-red-400 bg-red-50' : ' border-slate-300 hover:border-slate-400')
        . ($readonly ? ' bg-slate-50 cursor-not-allowed' : ' bg-white');
@endphp

<div {{ $attributes->only('class')->merge(['class' => '']) }}>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes->except(['class', 'label', 'name', 'type', 'value', 'placeholder', 'required', 'help', 'readonly', 'bag']) }}
        class="{{ $inputClass }}"
    >

    @if($hasError)
        <p class="mt-1 text-xs text-red-500">{{ $errors->getBag($bag)->first($name) }}</p>
    @elseif($help)
        <p class="mt-1 text-xs text-slate-400">{{ $help }}</p>
    @endif
</div>
