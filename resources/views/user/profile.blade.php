<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="padding:1em;">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-slot name="slot">     
            <div class="text-center" style="display: flex;
    flex-wrap: wrap;
    justify-content: center;">

                    <!-- message error -->
                @if ($errors->any())
                    <div class="py-20 text-left">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <div style="display:flex; justify-content:space-around; text-align:center;margin:auto;">
                                        <p></p>    
                                        <img src="{{ asset( 'storage/cross.png' ) }}" width="20%" height="auto">
                                        <p></p>
                                    </div>
                                    <div style="display:flex; justify-content:space-around; text-align:center;margin:auto;">
                                        <p></p>    
                                        @foreach ($errors->all() as $error)
                                                <li>{{ __($error) }}</li>
                                        @endforeach
                                        <p></p>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                                    <!-- Change Name -->
                <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'Name' => $Name ?? ''])}}">
                                        @csrf
                                        <x-label> Name :  {{ $user->name }}  </x-label>
                                        <x-input class="text-center" id="Name" name="Name" placeholder="Nickname" required/>
                                        <br><x-button>Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                            <!-- Change Image -->
                <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'Image' => $Image ?? ''])}}">
                                        @csrf
                                        <x-label> Picture : </x-label>
                                       
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
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'Email' => $Email ?? ''])}}">
                                        @csrf
                                        <x-label> Email :  {{ $user->email }}  </x-label>
                                        <x-input class="text-center" type="email" id="Email" name="Email" placeholder="your@email.ch" required/>
                                        <br><x-button class="pt-5">Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                    <!-- change phone  -->
                    <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'phone' => $phone ?? ''])}}">
                                        @csrf
                                        <x-label> Phone  :  {{ $user->phone }}  </x-label>
                                        <x-input  class="text-center" id="phone" name="phone" placeholder="+336XXXXXXXX" required/>
                                        <br><x-button class="pt-5">Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <!-- Change birthday -->
                    <div class="py-3">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'Birthday' => $Birthday ?? ''])}}">
                                        @csrf
                                        <x-label value=" Birthday : {{ $user->birthday }} ({{ $user->getAge($user->birthday)}} years old)"/>
                                        <x-input class="text-center" type="date"  min='{{ $user->getMaxAge()}}' max='{{ $user->getMinAge()}}' id="Birthday" name="Birthday" placeholder="11/11/1111" required/>                      
                                        <br>   <x-button>Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <!-- Change Interessed by -->
                    <div class="py-3" >
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'InteressedBy' => $InteressedBy ?? ''])}}">
                                        @csrf
                                        <x-label value=" Interested by : {{ $user->interessedBy }}"/>
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
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
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
                            <div class="bg-gray-200 overflow-hidden shadow-md sm:rounded-lg">
                                <div class="p-6 bg-gray-200 border-b border-gray-200">
                                    <form  method="post" enctype="multipart/form-data" 
                                        action="{{ route('updateMe', ['id' => $user->id, 'CurrentPassword' => $CurrentPassword ?? '','Password' => $Password ?? '', 'ConfirmePassword' => $ConfirmePassword ?? ''])}}">
                                        @csrf
                                        <x-label> Current password  </x-label>
                                        <x-input class="text-center" type="password" id="CurrentPassword" name="CurrentPassword" placeholder="Current Password" required/>
                                        <x-label> New password  </x-label>
                                        <x-input class="text-center" type="password" id="Password" name="Password" placeholder="New password" required/>
                                        <x-label> Confirm password  </x-label>
                                        <x-input class="text-center" type="password" id="ConfirmePassword" name="ConfirmePassword" placeholder="Confirme password" required/>
                                        <br><x-button>Change</x-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </x-slot>
</x-app-layout>
