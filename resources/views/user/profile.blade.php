<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-slot name="slot">     
            <div class="text-center">

                    <!-- message error -->
                @if ($errors->any())
                    <div class="py-20 text-left">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <img src="{{ asset( 'storage/cross.png' ) }}" width="35%" height="auto">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                                    <!-- Change Name -->
                <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'Name' => $Name ?? ''])}}">
                                        @csrf
                                        <x-label> Name :  {{ $user->name }}  </x-label>
                                        <x-input id="Name" name="Name" placeholder="Nickname" required/>
                                        <br><x-button>Change</x-button>
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
                                        action="{{ route('updateMe', ['id' => $user->id, 'Image' => $Image ?? ''])}}">
                                        @csrf
                                        <x-label> Image : </x-label>
                                       
                                        <div style="display:flex; justify-content:space-around; text-align:center;margin:auto;"> 
                                            <div></div>
                                            @if(!empty($user->image))
                                                <img src="{{ asset( 'storage/' . $user->image ) }}"  width="20%" height="auto">
                                            @else
                                                <img src="{{ asset( 'storage/defaultUser.jpg') }}" width="20%" height="auto">
                                            @endif <div></div>
                                        </div>
                                        <x-input  type="file" id="Image" name="Image" />
                                        <br><x-button>Change</x-button>
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
                                        action="{{ route('updateMe', ['id' => $user->id, 'Email' => $Email ?? ''])}}">
                                        @csrf
                                        <x-label> Email :  {{ $user->email }}  </x-label>
                                        <x-input type="email" id="Email" name="Email" placeholder="your@email.ch" required/>
                                        <br> <x-button>Change</x-button>
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
                                        action="{{ route('updateMe', ['id' => $user->id, 'Birthday' => $Birthday ?? ''])}}">
                                        @csrf
                                        <x-label value=" Birthday : {{ $user->birthday }} ({{ $user->getAge($user->birthday)}} years old)"/>
                                        <x-input type="date"  min='{{ $user->getMaxAge()}}' max='{{ $user->getMinAge()}}' id="Birthday" name="Birthday" placeholder="11/11/1111" required/>                      
                                        <br>   <x-button>Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <!-- Change Interessed by -->
                    <div class="py-3" >
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'InteressedBy' => $InteressedBy ?? ''])}}">
                                        @csrf
                                        <x-label value=" Interessed by : {{ $user->interessedBy }}"/>
                                            @inject('gender', 'App\Models\Gender')
                                            <select class="form-control" id="InteressedBy" name="InteressedBy" >
                                            <option value="{{  $gender::WOMAN }}">{{  $gender::WOMAN }}</option>
                                                <option value="{{  $gender::MAN }}">{{  $gender::MAN }}</option>
                                                <option value="{{  $gender::OLDMAN }}">{{  $gender::OLDMAN }}</option>
                                                <option value="{{  $gender::OLDWOMAN }}">{{  $gender::OLDWOMAN }}</option>
                                                <option value="{{  $gender::OTHER }}">{{  $gender::OTHER }}</option>
                                                <option value="{{  $gender::OLDOTHER }}">{{  $gender::OLDOTHER }}</option>   
                                            </select><br>
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
                                        action="{{ route('updateMe', ['id' => $user->id, 'Gender' => $Gender ?? ''])}}">
                                        @csrf
                                        <x-label value=" Gender : {{ $user->gender }}"/>
                                            @inject('gender', 'App\Models\Gender')
                                            <select class="form-control" id="Gender" name="Gender" >
                                                <option value="{{  $gender::WOMAN }}">{{  $gender::WOMAN }}</option>
                                                <option value="{{  $gender::MAN }}">{{  $gender::MAN }}</option>
                                                <option value="{{  $gender::OLDMAN }}">{{  $gender::OLDMAN }}</option>
                                                <option value="{{  $gender::OLDWOMAN }}">{{  $gender::OLDWOMAN }}</option>
                                                <option value="{{  $gender::OTHER }}">{{  $gender::OTHER }}</option>
                                                <option value="{{  $gender::OLDOTHER }}">{{  $gender::OLDOTHER }}</option>       
                                                
                                            </select><br>
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
                                        action="{{ route('updateMe', ['id' => $user->id, 'Password' => $ConfirmePassword ?? '', 'ConfirmePassword' => $ConfirmePassword ?? ''])}}">
                                        @csrf
                                        <x-label> New password  </x-label>
                                        <x-input type="password" id="Password" name="Password" placeholder="New password" required/>
                                        <x-label> Confirme password  </x-label>
                                        <x-input type="password" id="ConfirmePassword" name="ConfirmePassword" placeholder="Confirme password" required/>
                                        <br><x-button>Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </x-slot>
</x-app-layout>
