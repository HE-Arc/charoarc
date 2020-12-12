<?php
    namespace App\Http\Controllers;

    use App\Models\User;
    use Storage;
    
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;

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
           
            if ($request->has('inName')) 
            {
                $request->validate(['inName' => 'required|min:3|max:50']);
                $name = $request->input('inName');
                User::updateUserName($id, $name);
            }
            if ($request->has('inBirthday')) 
            {
                $request->validate(['inBirthday' => 'required|date']);
                $birthday = $request->input('inBirthday');
                User::updateUserBirthday($id, $birthday);
            }
            if ($request->has('inEmail')) 
            {
                $request->validate(['inEmail' => 'required|email|unique:users,email']);
                $email = $request->input('inEmail');
                User::updateUserEmail($id, $email);
            }
            if ($request->has('inGender')) 
            {
                $request->validate(['inGender' => 'required|string']);
                $gender = $request->input('inGender');
                User::updateUserGender($id, $gender);
            }
            if ($request->has('inInteressedBy')) 
            {
                $request->validate(['inInteressedBy' => 'required|string']);
                $interessedBy = $request->input('inInteressedBy');
                User::updateUserInteressedBy($id, $interessedBy);
            }
            if ($request->has('inPassword', 'inConfirmePassword')) 
            {
                 $request->validate([
                    'inPassword' => 'min:6|required_with:inConfirmePassword|same:inConfirmePassword',/*|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/*//* !!! we are all too lazy to apply this during an exercise !!!*/
                    'inConfirmePassword' => 'min:6' ]);
                $password = $request->input('inPassword');
                $confirmePassword = $request->input('inConfirmePassword');
                User::updateUserPassword($id, $password);
            }
            if ($request->hasFile('inImage'))
            {
                $request->validate(['inImage' => 'required|image|max:2048']);
                $path = $request->inImage->store('public');
                $image = $request->inImage->hashName();
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