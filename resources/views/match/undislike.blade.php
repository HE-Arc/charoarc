<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Revert Dislike') }}
        </h2>
    </x-slot>
    <x-slot name="slot"> 
    @if(Auth::check())
            @foreach($usersDisliked as $uD)
                <?php  echo $uD->asHTMLRowUnDislike();?>
            @endforeach
    @endif 
    </x-slot>
</x-app-layout>