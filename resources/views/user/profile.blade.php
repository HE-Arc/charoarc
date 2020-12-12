<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
                            <!-- Change Name -->
   <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inName' => $inName ?? ''])}}">
                        @csrf
                        <x-label> Name :  {{ $user->name }}  </x-label>
                        <x-input id="inName" name="inName" placeholder="Nickname" required/>
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                               <!-- Change Image -->
   <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inImage' => $inImage ?? 'toto'])}}">
                        @csrf
                        <x-label> Image : </x-label>
                        @if(!empty($user->image))
                            <img src="{{ asset( 'storage/' . $user->image ) }}" width="100" height="100">
                        @else
                            <svg width="100" height="100" viewBox="0 0 20 20">
                                <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"/>
						    </svg>
                        @endif
                        <x-input  type="file" id="inImage" name="inImage" />
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                             <!-- Change Email -->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inEmail' => $inEmail ?? ''])}}">
                        @csrf
                        <x-label> Email :  {{ $user->email }}  </x-label>
                        <x-input type="email" id="inEmail" name="inEmail" placeholder="your@email.ch" required/>
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                        <!-- Change birthday -->
      <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inBirthday' => $inBirthday ?? ''])}}">
                        @csrf
                        <x-label value=" Birthday : {{ $user->birthday }} ({{ $user->getAge($user->birthday)}} years old)"/>
                        <x-input type="date"  min='{{ $user->getMaxAge()}}' max='{{ $user->getMinAge()}}' id="inBirthday" name="inBirthday" placeholder="11/11/1111" required/>                      
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                        <!-- Change Interessed by -->
      <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inInteressedBy' => $inInteressedBy ?? ''])}}">
                        @csrf
                        <x-label value=" Interessed by : {{ $user->interessedBy }}"/>
                            @inject('gender', 'App\Models\Gender')
                            <select class="form-control" id="inInteressedBy" name="inInteressedBy" >
                                <option value="{{ $gender::WOMAN }}">{{  $gender::WOMAN }}</option>
                                <option value="{{ $gender::MAN }}">{{  $gender::MAN }}</option>
                            </select>
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                        <!-- Change Gender -->
      <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inGender' => $inGender ?? ''])}}">
                        @csrf
                        <x-label value=" Gender : {{ $user->gender }}"/>
                            @inject('gender', 'App\Models\Gender')
                            <select class="form-control" id="inGender" name="inGender" >
                                <option value="{{  $gender::WOMAN }}">{{  $gender::WOMAN }}</option>
                                <option value="{{  $gender::MAN }}">{{  $gender::MAN }}</option>
                        
                                
                            </select>
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                                <!-- Change Password -->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form  method="post" enctype="multipart/form-data" 
                        action="{{ route('updateMe', ['id' => $user->id, 'inPassword' => $inConfirmePassword ?? '', 'inConfirmePassword' => $inConfirmePassword ?? ''])}}">
                        @csrf
                        <x-label> New password  </x-label>
                        <x-input type="password" id="inPassword" name="inPassword" placeholder="New password" required/>
                        <x-label> Confirme password  </x-label>
                        <x-input type="password" id="inConfirmePassword" name="inConfirmePassword" placeholder="Confirme password" required/>
                        <x-button>Change</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
