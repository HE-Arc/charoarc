<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Your Match in details') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
        <table class="py-2 " style="display:flex;flex-wrap: wrap; justify-content:space-around;text-align:center;margin:auto; width:95%;margin-top: 5%; ">
            <tr>   
                    <td  style="width:50%;height:auto;margin:0 auto;">
                        <img class="rounded"  src="{{__(asset( 'storage/'. $image))}}" alt="target image" style="width: auto;height: 40%;">
                    </td>     
                    <td>
                    <table class="py-2 " style="text-align:center;margin:auto;width:45%;margin-top: 5%; ">
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        Name : {{$name}}</td></tr>
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        Age : {{$age}}</td></tr>
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        <div style="text-align:center;width:fit-content; width:auto;" >Description : <br>{{$description}}</div>
                    </td></tr>
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        Matched on : {{$date}}</td></tr>
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        Email : {{$mail}}</td></tr>
                    <tr><td  style="text-align:center; width:45%;word-wrap: break-word; border-radius: 1em;" class="py-2 bg-gray-300 rounded">
                        Phone : {{$phone}}</td></tr>
                    </table>        
                </td>
            </tr>
        </table>
        <form class="text-center" method="GET" action="{{route('matchs')}}">
            <input type ="submit" value="Back" style="background-color:#bd64ed; border-radius: 9px;" ></input>
        </form>
    @endif 
    </x-slot>
</x-app-layout>