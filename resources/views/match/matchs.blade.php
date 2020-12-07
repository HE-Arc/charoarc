<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matchs') }}
        </h2>
    </x-slot>
    <table class="table alignment:center">
    <tr>
    <td>{{ __('Your Target') }}</td>
    <td>{{ __('Status') }}</td>
    </tr>
    @foreach($userMatchs as $singleMatch)
    <tr>
    <td>{{__( $singleMatch->getName2())}}</td>
    <td>{{__($singleMatch->getMatchStatus())}}</td>
    </tr>
    @endforeach 
    </table>
</x-app-layout>

