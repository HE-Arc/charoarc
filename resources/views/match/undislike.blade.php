<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Revert Dislike') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
        <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <script type="text/javascript">
                $(document).ready(function(){
                setTimeout(function(){$("#message").hide();}, 2500);});
            </script>
            <div id="message" style="display:flex; justify-content:space-around;
            text-align:center;color : white; background-color : purple">
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            </div>
            @endif
        @endforeach
        </div> <!-- end .flash-message -->
        @if(!empty($usersDisliked->toArray()))
            <table class="py-2 bg-gray-400 rounded " style="text-align:center;margin:auto; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
               <thead>
                    <tr style="border-bottom: 5px solid #5b596e;display:flex; justify-content:space-around;
        text-align:center;"> 
                        <td></td>
                        <td>User Name</td>
                        <td></td>
                        <td>Picture</td>
                        <td></td>
                        <td>Revert Dislike</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersDisliked as $uD)
                    <tr style="display:flex; justify-content:space-around;padding-top: 1em;">
                        <td  style="overflow: hidden;width:15%;">{{__($uD->name)}}</td>
                        <td style="display:flex; justify-content:center;
        text-align:center;padding-bottom: 1em;width:15%;">
                            <img style="width:30%; height:auto" class="rounded" src="{{__(asset( 'storage/'. $uD->getImage()))}}" alt="target image" >
                        </td>
                        <td width="15%">
                            <form method="post" action="{{route('undislikeUpdate')}}">
                               @csrf
                                <input type="hidden" name="userId" value="{{__($uD->id)}}"></input>
                                <input type ="submit" value="Revert" style="color:white;background-color: #342f61; border-radius: 9px;" ></input>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6" 
            style="border-bottom: 2px solid #342f61; text-align:center;margin:auto;width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">{{__('Nothing to revert yet !')}}</p>
        
        @endif
                
    @endif 
    </x-slot>
</x-app-layout>