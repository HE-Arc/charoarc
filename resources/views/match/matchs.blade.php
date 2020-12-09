<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matchs') }}
        </h2>
    <table class="py-2 " style="display:flex; justify-content:space-around;
    text-align:center;margin:auto;height:40%; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
        <tr>
        <td>
            <form>
                <input type="hidden" value=''></input>
                <input type ="submit" value="Dislike" style=" float:left;background-color:red; border-radius: 9px;" ></input>
            </form>
            <!-- <button  style=" float:left;background-color:red;">Dislike</button> -->
        </td>
        <td  style="width:75%;height:70%;margin:0 auto;">
        @if($proposedMatch !=null)
            <img src="{{__(asset( 'storage/' . $proposedMatch->getUserImagebyId($proposedMatch->getTargetUserId(Auth::id()))))}}" alt="target image">
        @else
            <img src="https://github.com/HE-Arc/charoarc/wiki/images/default.png" alt="no targe then default message">
        @endif
        </td>
            <td>
                <form>
                    <input type="hidden" value=''></input>
                    <input type ="submit" value="Like" style=" float:right;background-color:green; border-radius: 9px;" ></input>
                </form>
                    <!---<button style=" float:right;background-color:green;">Like</button>-->
            </td>
        </tr>
    </table>
    @if(!empty($userMatchs))
    <table class="py-2 " style="text-align:center;margin:auto; width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">
        <tr style="border-bottom: 5px solid #5b596e;">
        <td>{{ __('Your Target') }}</td>
        <td>{{ __('Status') }}</td>
        </tr>
       
        @foreach($userMatchs as $singleMatch)
         <tr class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6">
        <td>{{__( $singleMatch->getUserNameFromId(Auth::id()))}}</td>
        <td>{{__($singleMatch->getMatchStatus())}}</td>
        </tr>
        @endforeach 
        
    </table>
    @else
    <p class="py-3 p-6 bg-white border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6" 
         style="border-bottom: 2px solid #342f61; text-align:center;margin:auto;width:95%;margin-top: 5%;  box-shadow: 8px 8px 12px #5b596e;">No matchs yet !</p>
    @endif     
    </x-slot>
</x-app-layout>