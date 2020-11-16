@props(['disabled' => false, 'type' => 'text'])
<input type="{{$type}}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>