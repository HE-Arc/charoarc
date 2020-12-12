<x-app-layout>
    <x-slot name="header">
    @if(Auth::check())
    <table class="py-2 " style="display:flex; justify-content:space-around;
    text-align:center;margin:auto; width:95%;margin-top: 5%; ">
        <tr>
        @if($matchToAnswerId !=null || $newMatchUserId !=null)
        <td>
             
            <form method="POST" action="{{route('dislike')}}"> 
            @csrf
                <input type="hidden" name="matchToAnswerId" value="{{$matchToAnswerId}}"></input>
                <input type="hidden" name="newMatchUserId" value="{{$newMatchUserId}}"></input>
                <input type ="submit" value="Dislike" style=" float:left;background-color:red; border-radius: 9px;" ></input>
            </form>
        </td>
        <td  style="width:auto;height:50%;margin:0 auto;">
            <img src="{{__(asset( 'storage/'. $image))}}" alt="target image" >
        </td>
            <td >
            <form method="POST" action="{{route('like')}}">
            @csrf
                <input type="hidden" name="matchToAnswerId" value="{{$matchToAnswerId}}"></input>
                <input type="hidden" name="newMatchUserId" value="{{$newMatchUserId}}"></input>
                <input type ="submit" value="Like" style=" float:right;background-color:green; border-radius: 9px;" ></input>
                </form>
            </td>
            @else
            <td  style="width:auto;height:50%;margin:0 auto;">
            <img src="{{__(asset( 'storage/default.png'))}}" alt="target image" >
            </td>
            @endif
            
        </tr>
        @if($name !=null)
        <tr style="text-align:center;">
        <td></td>
        <td>{{__($name)}}</td>
        <td></td>
        </tr>
        @endif
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
                <td>{{__( $singleMatch->getUserNameTargetFromIdLogged(Auth::id()))}}</td>
                <td>{{__($singleMatch->getMatchTextStatus())}}</td>
                </tr>
            @endif
        @endforeach 
        
    </table>
    @else
    <p class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6" 
         style="border-bottom: 2px solid #342f61; text-align:center;margin:auto;width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">No matchs yet !</p>
    @endif     
    @endif 
    </x-slot>
</x-app-layout>