@props(['disabled' => false, 'textOnBtn' => 'change'])
<input type="text" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>