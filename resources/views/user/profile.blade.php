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
