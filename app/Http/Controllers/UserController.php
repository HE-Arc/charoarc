<?php
    namespace App\Http\Controllers;


    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    

    class UserController extends Controller
    {
        public function profile()
        {
            $user = User::allUser();
            return view('user.profile', ["user"=>$user, "isList"=>'true']);
        }

        public function myprofile($id)
        {
            $user = User::getUserById($id);
            
            return view('user.profile', ["user"=>$user, "isList"=>'true']);
        }

        public function updateMe2()
        {
            $id= Input::get('id');
            $htmlName='toto';
            User::updateUserName($id, $htmlName);
            return view('user.updateOK');
        }

        public function updateMe(Request $request)
        {    
            $id = 1;
            //$id = $request->input('id');        
            $user = User::getUserById($id);
            $htmlName = $request->input('htmlName');
            
            $user = User::updateUserName($id, $htmlName);
            //return redirect()->route('myprofile', ['id' => $id]);
            
             return view('user.updateOK',["debugRequest"=>$request]);

        }
        
    }