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
            $id = $request->input('id');
            $user = User::getUserById($id);

            if ($request->has('inName')) 
            {
                $name = $request->input('inName');
                User::updateUserName($id, $name);
            }
            if ($request->has('inBirthday')) 
            {
                $birthday = $request->input('inBirthday');
                User::updateUserBirthday($id, $birthday);
            }
            if ($request->has('inEmail')) 
            {
                $email = $request->input('inEmail');
                User::updateUserEmail($id, $email);
            }
            if ($request->has('inGender')) 
            {
                $gender = $request->input('inGender');
                User::updateUserGender($id, $gender);
            }
            if ($request->has('inInteressedBy')) 
            {
                $interessedBy = $request->input('inInteressedBy');
                User::updateUserInteressedBy($id, $interessedBy);
            }
            if ($request->has('inPassword', 'inConfirmePassword')) 
            {
                $password = $request->input('inPassword');
                $confirmePassword = $request->input('inConfirmePassword');
                User::updateUserPassword($id, $password, $confirmePassword);
            }
            if ($request->hasFile('inImage'))
            {
                $request->validate(['inImage' => 'required|image|max:2048']);
                $path = $request->inImage->store('public');
                $image = $request->inImage->hashName();

                Storage::delete('public/'. $user->image);
                User::updateUserImage($id, $image);
            }
        
            return redirect()->route('profile');

            //DEBUG PAGE -> use this and comment the redirection return
            //return view('user.debugPage',["debugRequest"=>$request]);

        } 
    }