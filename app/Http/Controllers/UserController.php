<?php
    namespace App\Http\Controllers;

    use App\Models\User;
    use Storage;
    
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class UserController extends Controller
    {
        public function profile()
        {
            if(Auth::check())
            {
                $id=Auth::id();
                $user = User::getUserById($id);
                return view('user.profile', ["user"=>$user]);
            }
            return redirect()->route('login');
        }

        public function update(Request $request)
        {    
            $request->validate(['id' => 'required|exists:App\Models\User,id']);
            $id = $request->input('id');
           
            if ($request->has('Name')) 
            {
                $request->validate(['Name' => 'required|min:3|max:50']);
                $name = $request->input('Name');
                User::updateUserName($id, $name);
            }
            if ($request->has('Birthday')) 
            {
                $request->validate(['Birthday' => 'required|date']);
                $birthday = $request->input('Birthday');
                User::updateUserBirthday($id, $birthday);
            }
            if ($request->has('Email')) 
            {
                $request->validate(['Email' => 'required|email|unique:users,email']);
                $email = $request->input('Email');
                User::updateUserEmail($id, $email);
            }
            if ($request->has('Gender')) 
            {
                $request->validate(['Gender' => 'required|string']);
                $gender = $request->input('Gender');
                User::updateUserGender($id, $gender);
            }
            if ($request->has('InteressedBy')) 
            {
                $request->validate(['InteressedBy' => 'required|string']);
                $interessedBy = $request->input('InteressedBy');
                User::updateUserInteressedBy($id, $interessedBy);
            }
            if ($request->has('CurrentPassword','Password', 'ConfirmePassword')) 
            {
                 $request->validate([
                     'CurrentPassword'=>'min:6|required',
                    'Password' => 'min:6|required_with:ConfirmePassword|same:ConfirmePassword',/*|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/*//* !!! we are all too lazy to apply this during an exercise !!!*/
                    'ConfirmePassword' => 'min:6' ]);
                $currentPassword=$request->input('CurrentPassword');
                $password = $request->input('Password');
                if (Hash::check($currentPassword, Auth::user()->password)) {
                    User::updateUserPassword($id, $password);
                }
            }
            if ($request->hasFile('Image'))
            {
                $request->validate(['Image' => 'required|image|max:2048']);
                $path = $request->Image->store('public');
                $image = $request->Image->hashName();
                //del old img
                $user = User::getUserById($id);
                if($user->image != "defaultUser.jpg")
                {
                    Storage::delete('public/'. $user->image);
                }
                //update new img
                User::updateUserImage($id, $image);
            }
        
            return redirect()->route('profile');

            //DEBUG PAGE -> use this and comment the redirection return
            //return view('user.debugPage',["debugRequest"=>$request]);

        } 
    }