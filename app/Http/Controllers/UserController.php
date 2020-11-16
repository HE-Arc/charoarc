<?php
    namespace App\Http\Controllers;


    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
   

    class UserController extends Controller
    {
        public function profile()
        {
            $id=Auth::id();
            $user = User::getUserById($id);
            return view('user.profile', ["user"=>$user]);
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
            if ($request->has('inEmail')) 
            {
                $email = $request->input('inEmail');
                User::updateUserEmail($id, $email);
            }
            if ($request->has('inPassword', 'inConfirmePassword')) 
            {
                $password = $request->input('inPassword');
                $confirmePassword = $request->input('inConfirmePassword');
                User::updateUserPassword($id, $password, $confirmePassword);
            }
        
            return redirect()->route('profile');

            //DEBUG PAGE -> use this and comment the redirection return
            //return view('user.debugPage',["debugRequest"=>$request]);

        } 
    }