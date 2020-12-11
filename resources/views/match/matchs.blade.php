<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matchs') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
    <table class="py-2 " style="display:flex; justify-content:space-around;
    text-align:center;margin:auto;height:40%; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
        <tr>
        @if($matchToAnswerId !=null || $newMatchUserId !=null)
        <td>
            <form method="POST" action="{{route('likeDislikeMatch')}}">
                @csrf
                {{ Form::hidden('invisibleLike', '[$matchToAnswerId,$newMatchUserId]') }}
                <input type ="submit" value="Dislike" style=" float:left;background-color:red; border-radius: 9px;" ></input>
            </form>
        </td>
        @endif
        <td  style="width:75%;height:70%;margin:0 auto;">
            <img src="{{__(asset( 'storage/'. $image))}}" alt="target image">
        </td>
            @if($matchToAnswerId !=null || $newMatchUserId !=null)
            <td>
            <form method="POST" action="{{route('likeDislikeMatch')}}">
                @csrf
                {{ Form::hidden('invisibleDislike', '[$matchToAnswerId,$newMatchUserId]') }}
                <input type ="submit" value="Like" style=" float:right;background-color:green; border-radius: 9px;" ></input>
                </form>
            </td>
            @endif
        </tr>
    </table>
    @if(!empty($userMatchs))
    <table class="py-2 " style="text-align:center;margin:auto; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
        <tr style="border-bottom: 5px solid #5b596e;">
        <td>{{ __('Your Target') }}</td>
        <td>{{ __('Status') }}</td>
        </tr>
       
        @foreach($userMatchs as $singleMatch)
            @if($singleMatch->toBeDisplayed(Auth::id()))
                <tr class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6">
                <td>{{__( $singleMatch->getUserNameFromId(Auth::id()))}}</td>
                <td>{{__($singleMatch->getMatchTextStatus())}}</td>
                </tr>
            @endif
        @endforeach 
        
    </table>
    @else
    <p class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6" 
         style="border-bottom: 2px solid #342f61; text-align:center;margin:auto;width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">No matchs yet !</p>
    @endif     
    </x-slot>
</x-app-layout>