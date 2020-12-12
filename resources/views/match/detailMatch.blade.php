<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Match') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
    <table class="py-2 " style="display:flex; justify-content:space-around;
    text-align:center;margin:auto; width:95%;margin-top: 5%; ">
        
        <!-- DISPLAY ONE Match -->

    @endif 
    </x-slot>
</x-app-layout>