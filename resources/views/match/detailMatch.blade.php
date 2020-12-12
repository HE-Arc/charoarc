<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Your Match in details') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
    <table class="py-2 " style="display:flex; justify-content:space-around;
    text-align:center;margin:auto; width:95%;margin-top: 5%; ">
        
        <!-- DISPLAY ONE Match -->
        <table>
            <td>
            <tr><img src="$image" alt="user image"></tr>
            <tr>$name</tr>
            </td>
            <td>
                <tr>$age</tr>
                <tr>$mail</tr>
                <tr>$date</tr>
            </td>
        </table>
    @endif 
    </x-slot>
</x-app-layout>