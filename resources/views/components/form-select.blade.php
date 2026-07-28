@props([
    'label'       => null,
    'name'        => null,
    'options'     => [],
    'selected'    => null,
    'placeholder' => 'Pilih...',
    'required'    => false,
    'help'        => null,
    'bag'         => 'default',
])

@php
    $hasError = $errors->getBag($bag)->has($name);
    $selectClass = "w-full px-3.5 py-2.5 text-sm border rounded-lg transition-colors bg-white
        focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-400"
        . ($hasError ? ' border-red-400 bg-red-50' : ' border-slate-300 hover:border-slate-400');
@endphp

<div {{ $attributes->only('class')->merge(['class' => '']) }}>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1.5">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->except(['class', 'label', 'name', 'options', 'selected', 'placeholder', 'required', 'help', 'bag']) }}
        class="{{ $selectClass }}"
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" @selected(old($name, $selected) == $optValue)>
                {{ $optLabel }}
            </option>
        @endforeach

        {{ $slot ?? '' }}
    </select>

    @if($hasError)
        <p class="mt-1 text-xs text-red-500">{{ $errors->getBag($bag)->first($name) }}</p>
    @elseif($help)
        <p class="mt-1 text-xs text-slate-400">{{ $help }}</p>
    @endif
</div>
