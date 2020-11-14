<?php
    namespace App\Http\Controllers;

    use App\Models\Person;

    class PersonController extends Controller
    {
        public function index()
        {
            $person = Person::allPerson();
            return view('person.index', ["person"=>$person]);
        }
        public function getPersonByName($name)
        {
            $per = Person::getPersonByName($name);
            return view('person.profile', ["per"=>$per]);
        }
        public function hhh()
        {
           return 0;// $email = DB::table('users')->where('name', 'John')->value('email');
        }

        /**
         * Create a new flight instance.
         *
         * @param  Request  $request
         * @return Response
         */
        public function store(Request $request)
        {
            // Validate the request...

           // $flight = new Flight;

            //$flight->name = $request->name;

            //$flight->save();
        }
    }