<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Matchs') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
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
                    <td  style="width:auto;height:35%;margin:0 auto;">
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
                    <td  style="width:auto;height:40%;margin:0 auto;">
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
        <form class="text-center" method="GET" action="{{route('matchs')}}">
            <input type ="submit" value="Refresh" style="background-color:yellow; border-radius: 9px;" ></input>
        </form>
        
        @if(!empty($userMatchs))
            <script type="text/javascript">
                    $(document).ready(function() {
                    $('[data-toggle="toggle"]').change(function(){
                        $(this).parents().next('.hide').toggle();
                        });
                    });
            </script>
            <table class="py-2 " style="text-align:center;margin:auto; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
                <thead>
                    <tr style="border-bottom: 5px solid #5b596e;">
                    <td>{{ __('Your Target') }}</td>
                    <td>{{ __('Status') }}</td>
                    <td></td>
                    </tr>
                </thead>
                <?php  echo App\Models\Match::asHtmlTableRowAll($userMatchs);?>
            </table>
        @else
            <p class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6" 
                style="border-bottom: 2px solid #342f61; text-align:center;margin:auto;width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">No matchs yet !</p>
        @endif     
    @endif 
    </x-slot>
</x-app-layout>