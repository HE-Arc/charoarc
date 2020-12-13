<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Your Match in details') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
        <table class="py-2 " style="display:flex; justify-content:space-around;text-align:center;margin:auto; width:95%;margin-top: 5%; ">
            <tr>
                    <td  style="width:50%;height:auto;margin:0 auto;">
                        <img src="{{__(asset( 'storage/'. $image))}}" alt="target image" >
                    </td>        
            
                <td style="text-align:right;">
                    <table class="py-2 " style="text-align:center;margin:auto;width:45%;margin-top: 5%; ">
                    <tr><td>Name : {{$name}}</td></tr>
                    <tr><td>Age : {{$age}}</td></tr>
                    <tr><td>Matched on : {{$date}}</td></tr>
                    <tr><td>Email : {{$mail}}</td></tr>
                    </table>        
                </td>
            </tr>
        </table>
        <form class="text-center" method="GET" action="{{route('matchs')}}">
            <input type ="submit" value="Back" style="background-color:purple; border-radius: 9px;" ></input>
        </form>
    @endif 
    </x-slot>
</x-app-layout>