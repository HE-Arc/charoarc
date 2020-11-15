<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>


   <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                   <x-label> Name :  {{ $user->name }}  </x-label>
                   <x-label> @php($toto = $user->getName())
                   {{$toto}} <<<<<<
                       </x-label>
                        
                    
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'htmlName' => $inNameName ?? 'marchePas'])}}">
                    @csrf
                  
                     <x-input id="inNameId" name="inNameName"  value="fuck">
                    @csrf
                    </x-input>

                    <x-button> 
                    Change
                    </x-button>
                    </form>
                
                    
                </div>
            </div>
        </div>
    </div>

    

  <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p>Mail adresse :  {{ $user->email }} </p>
                    New email: <x-input/>
                    
                </div>
            </div>
        </div>
    </div>
  

</x-app-layout>
