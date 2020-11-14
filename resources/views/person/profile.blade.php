@extends('layout.app')
@section('content')
<!-- Begin page content -->
<main role="main" class="container mt-5">
    <h1 class="mt-5">Profile page</h1>
    <p class="lead">show the profile</p>
    <table class="table">
        <tr>
            <td>
               <b> id </b>
            </td>
            <td>
               <b> nickname </b>
            </td>
            <td>
               <b> age </b>
            </td>
        </tr>
        
         <tr>
            <td>
                {{$person->id}}
            </td>
            <td>
                {{$person->nickname}}
            </td>
             <td>
                {{$person->age}}
            </td>
        </tr>
    </table>
</main>
@endsection
