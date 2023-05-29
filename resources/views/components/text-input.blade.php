@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-red-500 p-2 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm']) !!}>
